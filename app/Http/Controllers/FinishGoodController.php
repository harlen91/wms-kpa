<?php

namespace App\Http\Controllers;

use App\Exports\FgoodExport;
use App\Exports\HisFgoodExport;
use App\Exports\KeluarFinishGoodExport;
use App\Models\BallPress;
use App\Models\CircularLoomFg;
use App\Models\Cutting;
use App\Models\DenierProduk;
use App\Models\DensitasProduk;
use App\Models\FinishGood;
use App\Models\HisFgood;
use App\Models\KeluarFinishGood;
use App\Models\specproduk;
use App\Models\WarnaJahitan;
use Illuminate\Http\Request;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class FinishGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['finish'] = Cache::remember('fgood.all', 30, function () {
            return FinishGood::join('users', 'users.id', '=', 'finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                ->orderBy('finish_good.created_at', 'desc')
                ->get();
        });
        return view('fgood.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['specproduk'] = specproduk::all();
        return view('fgood.create', $data);
    }
    public function getproduk(string $id)
    {
        $spekproduk = specproduk::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $spekproduk
        ]);
    }
    public function getdensitas(string $id)
    {
        $densitas = DensitasProduk::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $densitas
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'specproduk' => 'required',
            'densitas' => 'required',
            'denier' => 'required',
            'jumlah_ikatan_perball' => 'required',
            'lot_ball' => 'required',
            'brutto' => 'required'
        ], [
            'specproduk.required' => 'Spesifikasi Produk Tidak Boleh Kosong!',
            'densitas.required' => 'Densitas Produk Tidak Boleh Kosong!',
            'denier.required' => 'Denier Produk Tidak Boleh Kosong!',
            'lot_ball.required' => 'Lot Ball Press Tidak Boleh Kosong!',
            'jumlah_ikatan_perball.required' => 'Jumlah Ikatan/ball Tidak Boleh Kosong!',
            'brutto.required' => 'Brutto Tidak Boleh Kosong!'
        ]);
        $akses = auth()->user()->akses;
        $id = time();
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create($id)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(__DIR__ . '/assets/symfony.png')
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true);

        // Create generic label
        $label = Label::create($id)
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, null, $label);
        $datauri = $result->getDataUri();
        $tanggal = date('Y/m/d');
        $jam = date('H:i:s');
        $fgood = FinishGood::create([
            'id_finish' => $id,
            'id' => auth()->user()->id,
            'id_specproduk' => $request->specproduk,
            'tgl_fg' => $tanggal,
            'jam_fg' => $jam,
            'lot_ball_press' => htmlspecialchars($request->lot_ball, ENT_QUOTES, 'UTF-8'),
            'jumlah_ikatan_perball' => $request->jumlah_ikatan_perball,
            'brutto' => $request->brutto,
            'qr_fg' => $datauri
        ]);
        HisFgood::create([
            'id_finish' => $id,
            'id' => auth()->user()->id,
            'id_specproduk' => $request->specproduk,
            'tgl_fg' => $tanggal,
            'jam_fg' => $jam,
            'jumlah_ikatan_perball' => $request->jumlah_ikatan_perball,
            'lot_ball_press' => htmlspecialchars($request->lot_ball, ENT_QUOTES, 'UTF-8'),
            'brutto' => $request->brutto,
            'qr_fg' => $datauri
        ]);
        Cache::forget('fgood.all');
        $request->session()->flash('success', 'Berhasil Disimpan!');

        return redirect()->route('fgood');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['circular'] = CircularLoomfg::all();
        $data['cutting'] = Cutting::all();
        $data['ballpress'] = BallPress::all();
        $data['specproduk'] = specproduk::all();
        $data['densitas'] = DensitasProduk::all();
        $data['denier'] = DenierProduk::all();
        $data['warna'] = WarnaJahitan::all();
        $data['finish'] = FinishGood::join('users', 'users.id', '=', 'finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
            ->where(['id_finish' => $id])
            ->get();
        return view('fgood.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $cari = FinishGood::find($id);
        if ($cari) {
            $data['circular'] = CircularLoomFg::all();
            $data['cutting'] = Cutting::all();
            $data['ballpress'] = BallPress::all();
            $data['specproduk'] = specproduk::all();
            $data['densitas'] = DensitasProduk::all();
            $data['denier'] = DenierProduk::all();
            $data['warna'] = WarnaJahitan::all();
            $data['finish'] = FinishGood::join('users', 'users.id', '=', 'finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                ->where(['id_finish' => $id])
                ->get();
            return view('fgood.edit', $data);
        } else {
            $request->session()->flash('error', 'Data Tidak Ditemukan!');
            return redirect()->route('fgood');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tanggal = date('Y/m/d');
        $jam = date('H:i:s');
        $finish = FinishGood::find($id);
        $finish->update([
            'id_finish' => $id,
            'id' => auth()->user()->id,
            'id_specproduk' => $request->specproduk,
            'tgl_fg' => $tanggal,
            'jam_fg' => $jam,
            'jumlah_ikatan_perball' => $request->jumlah_ikatan_perball,
            'lot_ball_press' => htmlspecialchars($request->lot_ball, ENT_QUOTES, 'UTF-8'),
            'brutto' => $request->brutto
        ]);
        $hisfinish = HisFgood::find($id);
        $hisfinish->update([
            'id_finish' => $id,
            'id' => auth()->user()->id,
            'id_specproduk' => $request->specproduk,
            'lot_ball_press' => htmlspecialchars($request->lot_ball, ENT_QUOTES, 'UTF-8'),
            'tgl_fg' => $tanggal,
            'jam_fg' => $jam,
            'jumlah_ikatan_perball' => $request->jumlah_ikatan_perball,
            'brutto' => $request->brutto
        ]);
        Cache::forget('fgood.all');
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('fgood');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $finish = FinishGood::find($id);
        Cache::forget('fgood.all');
        $hisfinish = HisFgood::find($id);
        $hisfinish->delete();
        $finish->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('fgood');
    }
    public function clear()
    {
        $benang = KeluarFinishGood::whereNotNull('id_finishkeluar')->delete();
        session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('fgood.laporank');
    }
    public function cetak(string $id)
    {
        $data['finish'] = FinishGood::join('users', 'users.id', '=', 'finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
            ->where(['id_finish' => $id])
            ->get();
        return view('fgood.cetak', $data);
    }
    public function retur()
    {
        return view('fgood.retur');
    }
    public function pretur(Request $request)
    {
        $request->validate([
            'idfinish' => 'required'
        ], [
            'idfinish.required' => 'ID Finish Good Tidak Boleh Kosong!'
        ]);
        $id = $request->idfinish;
        $cari = KeluarFinishGood::find($id);
        if ($cari) {
            $cari->forceDelete();
            FinishGood::withTrashed()->where('id_finish', $id)->restore();
            session()->flash('success', 'Finish Good Berhasil Diretur!');
            return redirect()->route('fgood.retur');
        } else {
            session()->flash('error', 'ID Finish Good Tidak Ditemukan!');
            return redirect()->route('fgood.retur');
        }
    }
    public function keluar()
    {
        $data['finish'] = Cache::remember('fgood.keluar', 60, function () {
            return KeluarFinishGood::join('users', 'users.id', '=', 'keluar_finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'keluar_finish_good.id_specproduk')->orderBy('tgl_keluar', 'desc')->get();
        });

        return view('fgood.keluar', $data);
    }
    public function delkeluar(Request $request, $id)
    {
        $keluar = KeluarFinishGood::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data Finish Good!');
        return redirect()->route('fgood');
    }
    public function delhiskeluar(Request $request, $id)
    {
        $keluar = HisFgood::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data Finish Good!');
        return redirect()->route('fgood');
    }
    public function cari(Request $request)
    {
        $cari = FinishGood::find($request->idfinish);
        if ($cari) {
            $tanggal = date('Y/m/d');
            $jam = date('H:i:s');
            KeluarFinishGood::create([
                'id_finishkeluar' => $request->idfinish,
                'id' => $cari->id,
                'id_specproduk' => $cari->id_specproduk,
                'tgl_fg' => $cari->tgl_fg,
                'jam_fg' => $cari->jam_fg,
                'tgl_keluar' => $tanggal,
                'jam_keluar' => $jam,
                'jumlah_ikatan_perball' => $cari->jumlah_ikatan_perball,
                'brutto' => $cari->brutto,
            ]);

            $keluar = FinishGood::find($request->idfinish);
            $keluar->delete();
            return redirect()->route('fgood.keluar');
        } else {
            $request->session()->flash('error', 'ID Benang Tidak Ditemukan!');
            return redirect()->route('fgood.keluar');
        }
    }
    public function proses(Request $request)
    {
        $tanggal = date('Y/m/d');
        $jam = date('H:i:s');
        KeluarFinishGood::create([
            'id_finishkeluar' => $request->idfgood,
            'id' => $request->user,
            'id_specproduk' => $request->specproduk,
            'tgl_fg' => $tanggal,
            'jam_fg' => $jam,
            'brutto' => $request->brutto
        ]);
        Cache::forget('fgood.keluar');
        $keluar = FinishGood::find($request->idfgood);
        $keluar->delete();

        $request->session()->flash('success', 'Berhasil Dikeluarkan!');
        return redirect()->route('fgood');
    }
    public function history()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['finish'] = Cache::remember('fgood.history', 60, function () {
            return HisFgood::join('users', 'users.id', '=', 'history_finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'history_finish_good.id_specproduk')
                ->get();
        });

        return view('fgood.history', $data);
    }
    public function excelh(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new HisFgoodExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data history finish good.xlsx');
    }
    public function filterh(Request $request)
    {
        $request->validate([
            'tanggal1' => 'required',
            'jam1' => 'required',
            'tanggal2' => 'required',
            'jam2' => 'required'
        ], [
            'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam1.required' => 'Jam Tidak Bole Kosong!',
            'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam2.required' => 'Jam Tidak Bole Kosong!'
        ]);
        $data['tanggal1'] = $request->tanggal1;
        $data['tanggal2'] = $request->tanggal2;
        $data['jam1'] = $request->jam1;
        $data['jam2'] = $request->jam2;
        $g1 = $request->tanggal1 . " " . $request->jam1;
        $g2 = $request->tanggal2 . " " . $request->jam2;
        $data['finish'] = HisFgood::join('users', 'users.id', '=', 'history_finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'history_finish_good.id_specproduk')
            ->whereBetween('history_finish_good.created_at', [$g1, $g2])
            ->orderBy('history_finish_good.created_at', 'asc')
            ->get();
        return view('fgood.filterh', $data);
    }
    public function laporan()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['finish'] = Cache::remember('fgood.all', 60, function () {
            return FinishGood::join('users', 'users.id', '=', 'finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                ->get();
        });

        return view('fgood.laporan', $data);
    }
    public function laporank()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['finish'] = KeluarFinishGood::join('users', 'users.id', '=', 'keluar_finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'keluar_finish_good.id_specproduk')
            ->get();
        return view('fgood.laporan_keluar', $data);
    }
    public function filter(Request $request)
    {
        $request->validate([
            'tanggal1' => 'required',
            'jam1' => 'required',
            'tanggal2' => 'required',
            'jam2' => 'required'
        ], [
            'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam1.required' => 'Jam Tidak Bole Kosong!',
            'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam2.required' => 'Jam Tidak Bole Kosong!'
        ]);
        $data['tanggal1'] = $request->tanggal1;
        $data['tanggal2'] = $request->tanggal2;
        $data['jam1'] = $request->jam1;
        $data['jam2'] = $request->jam2;
        $g1 = $request->tanggal1 . " " . $request->jam1;
        $g2 = $request->tanggal2 . " " . $request->jam2;
        $data['finish'] = FinishGood::join('users', 'users.id', '=', 'finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
            ->whereBetween('finish_good.created_at', [$g1, $g2])
            ->orderBy('finish_good.created_at', 'asc')
            ->get();
        return view('fgood.filter', $data);
    }
    public function filterk(Request $request)
    {
        $request->validate([
            'tanggal1' => 'required',
            'jam1' => 'required',
            'tanggal2' => 'required',
            'jam2' => 'required'
        ], [
            'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam1.required' => 'Jam Tidak Bole Kosong!',
            'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
            'jam2.required' => 'Jam Tidak Bole Kosong!'
        ]);
        $data['tanggal1'] = $request->tanggal1;
        $data['tanggal2'] = $request->tanggal2;
        $data['jam1'] = $request->jam1;
        $data['jam2'] = $request->jam2;
        $g1 = $request->tanggal1 . " " . $request->jam1;
        $g2 = $request->tanggal2 . " " . $request->jam2;
        $data['finish'] = KeluarFinishGood::join('users', 'users.id', '=', 'keluar_finish_good.id')
            ->join('specproduk', 'specproduk.id_specproduk', '=', 'keluar_finish_good.id_specproduk')
            ->whereBetween('keluar_finish_good.created_at', [$g1, $g2])
            ->orderBy('keluar_finish_good.created_at', 'asc')
            ->get();
        return view('fgood.filter_keluar', $data);
    }

    public function excel(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new FgoodExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data finish good.xlsx');
    }
    public function excelk(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new KeluarFinishGoodExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data finish good keluar.xlsx');
    }
    public function scan()
    {
        return view('fgood.scan');
    }
}
