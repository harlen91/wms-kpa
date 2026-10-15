<?php

namespace App\Http\Controllers;

use App\Exports\BenangExport;
use App\Exports\HisBenangExport;
use App\Exports\KeluarBenangExport;
use App\Models\Benang;
use App\Models\HisBenang;
use App\Models\KeluarBenang;
use App\Models\Kodebenang;
use App\Models\Lotextruder;
use App\Models\Spesifikasi;
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
use PhpParser\Node\Expr\Cast\String_;
use PhpParser\Node\Stmt\Return_;

class BenangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->orderBy('benang.created_at', 'desc')
            ->get();
        return view('benang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kode'] = Kodebenang::all();
        $data['lot'] = Lotextruder::all();
        $data['spesifikasi'] = Spesifikasi::all();
        return view('benang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function retur()
    {
        return view('benang.retur');
    }
    public function pretur(Request $request)
    {
        $request->validate([
            'idbenang' => 'required'
        ], [
            'idbenang.required' => 'ID Benang Tidak Boleh Kosong!'
        ]);
        $id = $request->idbenang;
        $cari = KeluarBenang::find($id);
        if ($cari) {
            $cari->forceDelete();
            Benang::withTrashed()->where('id_benang', $id)->restore();

            session()->flash('success', 'Benang Berhasil Diretur!');
            return redirect()->route('benang.retur');
        } else {
            session()->flash('error', 'ID Benang Tidak Ditemukan!');
            return redirect()->route('benang.retur');
        }
    }
    public function keluar()
    {
        $data['benang'] = KeluarBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'keluar_benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'keluar_benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'keluar_benang.id_lotextruder')
            ->orderBy('keluar_benang.created_at', 'desc')
            ->get();
        return view('benang.keluar', $data);
    }
    public function delkeluar(Request $request, $id)
    {
        $keluar = KeluarBenang::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data Keluar Benang!');
        return redirect()->route('benang');
    }
    public function delhiskeluar(Request $request, $id)
    {
        $keluar = HisBenang::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data History Keluar Benang!');
        return redirect()->route('benang.history');
    }
    public function cari(Request $request)
    {
        $id = $request->idbenang;
        $cari = Benang::find($request->idbenang);
        // dd($cari->id_spesifikasi);
        if ($cari) {
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
            $label = Label::create($id)->setTextColor(new Color(255, 0, 0));

            $result = $writer->write($qrCode, null, $label);
            $datauri = $result->getDataUri();
            $tanggal = date('Y/m/d');
            $jam = date('H:i:s');
            KeluarBenang::create([
                'id_benangkeluar' => $id,
                'id_kodebenang' => $cari->id_kodebenang,
                'id_spesifikasi' => $cari->id_spesifikasi,
                'id_lotextruder' => $cari->id_lotextruder,
                'id' => $cari->id,
                'qty_benang' => $cari->qty_benang,
                'tgl_benang' => $cari->tgl_benang,
                'jam_benang' => $cari->jam_benang,
                'tgl_keluar' => $tanggal,
                'jam_keluar' => $jam,
                'bruto' => $cari->bruto,
                'berat_palet' => $cari->berat_palet,
                'berat_keranjang_satuan' => $cari->berat_keranjang_satuan,
                'jumlah_keranjang_palet' => $cari->jumlah_keranjang_palet,
                'total_berat_keranjang_palet' => $cari->total_berat_keranjang_palet,
                'berat_bobin_satuan' => $cari->berat_bobin_satuan,
                'banyak_bobin_keranjang' => $cari->banyak_bobin_keranjang,
                'total_banyakbobin_palet' => $cari->total_banyakbobin_palet,
                'total_beratbobin_palet' => $cari->total_beratbobin_palet,
                'neto' => $cari->neto,
                'no_palet' => $cari->no_palet,
                'berat_aktual' => $cari->berat_aktual,
                'qrcode' => $datauri,
            ]);
            $x = Benang::find($id);
            $x->delete();

            // $data['kode'] = Kodebenang::all();
            // $data['lot'] = Lotextruder::all();
            // $data['spesifikasi'] = Spesifikasi::all();
            // $data['benang'] = KeluarBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', "=", "keluar_benang.id_spesifikasi")
            //     ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_benang.id_kodebenang')
            //     ->join('users', 'users.id', '=', 'keluar_benang.id')
            //     ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'keluar_benang.id_lotextruder')
            //     ->where(['id_benangkeluar' => $request->idbenang])
            //     ->get();
            // return view('benang.cari', $data);
            return redirect()->route('benang.keluar');
        } else {
            $request->session()->flash('error', 'ID Benang Tidak Ditemukan!');
            return redirect()->route('benang.keluar');
        }
    }
    public function proses(Request $request)
    {
        $id = $request->idbenang;
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
        $label = Label::create($id)->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, null, $label);
        $datauri = $result->getDataUri();
        $jam = date('H:i:s');
        KeluarBenang::create([
            'id_benangkeluar' => $id,
            'id_kodebenang' => $request->idkodebenang,
            'id_spesifikasi' => $request->idspesifikasi,
            'id_lotextruder' => $request->idlot,
            'id' => $request->iduser,
            'qty_benang' => $request->qty,
            'tgl_benang' => $request->tanggal,
            'jam_benang' => $jam,
            'bruto' => $request->brutto,
            'berat_palet' => $request->beratpalet,
            'berat_keranjang_satuan' => $request->beratsatuan,
            'jumlah_keranjang_palet' => $request->jumlah,
            'total_berat_keranjang_palet' => $request->totalberat,
            'berat_bobin_satuan' => $request->beratbobin,
            'banyak_bobin_keranjang' => $request->bobin,
            'total_banyakbobin_palet' => $request->banyakbobin,
            'total_beratbobin_palet' => $request->totalbobin,
            'neto' => $request->netto,
            'no_palet' => $request->pallet,
            'berat_aktual' => $request->aktual,
            'qrcode' => $datauri,
        ]);
        $x = Benang::find($id);
        $x->delete();
        $request->session()->flash('success', 'Benang Berhasil Dikeluarkan!');
        return redirect()->route('benang');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required',
                'lot' => 'required',
                'spesifikasi' => 'required',
                'qty' => 'required',
                'tanggal' => 'required',
                'bobin' => 'required',
                'brutto' => 'required',
                'netto' => 'required',
                'pallet' => 'required',
                'beratpalet' => 'required',
                'beratsatuan' => 'required',
                'totalberat' => 'required',
                'beratbobin' => 'required',
                'totalbobin' => 'required',
                'jumlah' => 'required',
                'aktual' => 'required',
            ],
            [
                'kode.required' => 'Kode Benang Tidak Boleh Kosong!',
                'lot.required' => 'Lotextruder Tidak Boleh Kosong!',
                'spesifikasi.required' => 'Spesifikasi Tidak Boleh Kosong!',
                'qty.required' => 'Qty Tidak Boleh Kosong!',
                'tanggal.required' => 'Tanggal Tidak Boleh Kosong!',
                'bobin.required' => 'Banyak Bobin Tidak Boleh Kosong!',
                'brutto.required' => 'Brutto Tidak Boleh Kosong!',
                'netto.required' => 'Berat Netto Tidak Boleh Kosong!',
                'pallet.required' => 'Nomor Pallet Tidak Boleh Kosong!',
                'beratpalet.required' => 'Berat Palet Tidak Boleh Kosong!',
                'jumlah.required' => 'Jumlah Keranjang Tidak Boleh Kosong!',
                'beratsatuan.required' => 'Berat Satuan Keranjang Tidak Boleh Kosong!',
                'beratbobin.required' => 'Berat Satuan Bobin Tidak Boleh Kosong!',
                'totalberat.required' => 'Total Berat Keranjang Tidak Boleh Kosong!',
                'totalbobin.required' => 'Total Berat Bobin Tidak Boleh Kosong!',
                'aktual.required' => 'Berat Aktual Tidak Boleh Kosong!',
            ],
        );
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
        $label = Label::create($id)->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, null, $label);
        $datauri = $result->getDataUri();
        $jam = date('H:i:s');
        // $pallet = $request->pallet;
        // $lot = $request->lot . "/" . $pallet;
        // dd($lot);
        Benang::create([
            'id_benang' => $id,
            'id_kodebenang' => $request->kode,
            'id_spesifikasi' => $request->spesifikasi,
            'id_lotextruder' => $request->lot,
            'id' => auth()->user()->id,
            'qty_benang' => $request->qty,
            'tgl_benang' => $request->tanggal,
            'jam_benang' => $jam,
            'bruto' => $request->brutto,
            'berat_palet' => $request->beratpalet,
            'berat_keranjang_satuan' => $request->beratsatuan,
            'jumlah_keranjang_palet' => $request->jumlah,
            'total_berat_keranjang_palet' => $request->totalberat,
            'berat_bobin_satuan' => $request->beratbobin,
            'banyak_bobin_keranjang' => $request->bobin,
            'total_banyakbobin_palet' => $request->banyakbobin,
            'total_beratbobin_palet' => $request->totalbobin,
            'neto' => $request->netto,
            'no_palet' => $request->pallet,
            'berat_aktual' => $request->aktual,
            'qrcode' => $datauri,
        ]);
        HisBenang::create([
            'id_benang' => $id,
            'id_kodebenang' => $request->kode,
            'id_spesifikasi' => $request->spesifikasi,
            'id_lotextruder' => $request->lot,
            'id' => auth()->user()->id,
            'qty_benang' => $request->qty,
            'tgl_benang' => $request->tanggal,
            'jam_benang' => $jam,
            'bruto' => $request->brutto,
            'berat_palet' => $request->beratpalet,
            'berat_keranjang_satuan' => $request->beratsatuan,
            'jumlah_keranjang_palet' => $request->jumlah,
            'total_berat_keranjang_palet' => $request->totalberat,
            'berat_bobin_satuan' => $request->beratbobin,
            'banyak_bobin_keranjang' => $request->bobin,
            'total_banyakbobin_palet' => $request->banyakbobin,
            'total_beratbobin_palet' => $request->totalbobin,
            'neto' => $request->netto,
            'no_palet' => $request->pallet,
            'berat_aktual' => $request->aktual,
            'qrcode' => $datauri,
        ]);
        $request->session()->flash('success', 'Berhasil Simpan!');
        // if ($akses == 'user benang') {
        //     // return redirect()->route('benang.create');
        //     return redirect()->route('benang.show', $id);
        // }
        return redirect()->route('benang');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->where('benang.id_benang', $id)
            ->get();
        return view('benang.show', $data);
    }
    public function cetak(string $id)
    {
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->where('benang.id_benang', $id)
            ->get();
        return view('benang.cetak', $data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['kode'] = Kodebenang::all();
        $data['lot'] = Lotextruder::all();
        $data['spesifikasi'] = Spesifikasi::all();
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->where('benang.id_benang', $id)
            ->get();
        return view('benang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jam = date('H:i:s');
        $benang = Benang::find($id);
        $hisbenag = HisBenang::find($id);
        $pallet = $request->pallet;
        $benang->update([
            'id_kodebenang' => $request->kode,
            'id_spesifikasi' => $request->spesifikasi,
            'id_lotextruder' => $request->lot,
            'id' => auth()->user()->id,
            'qty_benang' => $request->qty,
            'tgl_benang' => $request->tanggal,
            'jam_benang' => $jam,
            'bruto' => $request->brutto,
            'berat_palet' => $request->beratpalet,
            'berat_keranjang_satuan' => $request->beratsatuan,
            'jumlah_keranjang_palet' => $request->jumlah,
            'total_berat_keranjang_palet' => $request->totalberat,
            'berat_bobin_satuan' => $request->beratbobin,
            'banyak_bobin_keranjang' => $request->bobin,
            'total_banyakbobin_palet' => $request->banyakbobin,
            'total_beratbobin_palet' => $request->totalbobin,
            'neto' => $request->netto,
            'no_palet' => $request->pallet,
            'berat_aktual' => $request->aktual,
        ]);
        $hisbenag->update([
            'id_kodebenang' => $request->kode,
            'id_spesifikasi' => $request->spesifikasi,
            'id_lotextruder' => $request->lot,
            'id' => auth()->user()->id,
            'qty_benang' => $request->qty,
            'tgl_benang' => $request->tanggal,
            'jam_benang' => $jam,
            'bruto' => $request->brutto,
            'berat_palet' => $request->beratpalet,
            'berat_keranjang_satuan' => $request->beratsatuan,
            'jumlah_keranjang_palet' => $request->jumlah,
            'total_berat_keranjang_palet' => $request->totalberat,
            'berat_bobin_satuan' => $request->beratbobin,
            'banyak_bobin_keranjang' => $request->bobin,
            'total_banyakbobin_palet' => $request->banyakbobin,
            'total_beratbobin_palet' => $request->totalbobin,
            'neto' => $request->netto,
            'no_palet' => $request->pallet,
            'berat_aktual' => $request->aktual
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('benang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $benang = Benang::find($id);
        $hisbenang = HisBenang::find($id);
        $hisbenang->delete();
        $benang->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('benang');
    }
    public function clear()
    {
        $benang = KeluarBenang::whereNotNull('id_benangkeluar')->delete();
        session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('benang.laporank');
    }
    public function history()
    {
        $data['tanggal1'] = '0';
        $data['tanggal2'] = '0';
        $data['jam1'] = '0';
        $data['jam2'] = '0';
        $data['benang'] = Cache::remember('benang', 3600, function () {
            return HisBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'history_benang.id_spesifikasi')
                ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_benang.id_kodebenang')
                ->join('users', 'users.id', '=', 'history_benang.id')
                ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'history_benang.id_lotextruder')
                ->get();
        });
        return view('benang.history', $data);
    }
    public function hexcel(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        return Excel::download(new HisBenangExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data history benang.xlsx');
    }
    public function filterh(Request $request)
    {
        $request->validate(
            [
                'tanggal1' => 'required',
                'jam1' => 'required',
                'tanggal2' => 'required',
                'jam2' => 'required',
            ],
            [
                'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam1.required' => 'Jam Tidak Boleh Kosong!',
                'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam2.required' => 'Jam Tidak Boleh Kosong!',
            ],
        );
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        $g1 = $tanggal1 . ' ' . $jam1;
        $g2 = $tanggal2 . ' ' . $jam2;

        $data['tanggal1'] = $tanggal1;
        $data['jam1'] = $request->jam1;
        $data['tanggal2'] = $tanggal2;
        $data['jam2'] = $request->jam2;
        $data['benang'] = HisBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'history_benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'history_benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'history_benang.id_lotextruder')
            ->whereBetween('history_benang.created_at', [$g1, $g2])
            ->orderBy('history_benang.created_at', 'asc')
            ->get();
        return view('benang.filterh', $data);
    }
    public function laporan()
    {
        $data['tanggal1'] = '0';
        $data['tanggal2'] = '0';
        $data['jam1'] = '0';
        $data['jam2'] = '0';
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->get();
        return view('benang.laporan', $data);
    }
    public function laporank()
    {
        $data['tanggal1'] = '0';
        $data['tanggal2'] = '0';
        $data['jam1'] = '0';
        $data['jam2'] = '0';
        $data['benang'] = KeluarBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'keluar_benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'keluar_benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'keluar_benang.id_lotextruder')
            ->get();
        return view('benang.laporan_keluar', $data);
    }
    public function filter(Request $request)
    {
        $request->validate(
            [
                'tanggal1' => 'required',
                'jam1' => 'required',
                'tanggal2' => 'required',
                'jam2' => 'required',
            ],
            [
                'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam1.required' => 'Jam Tidak Boleh Kosong!',
                'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam2.required' => 'Jam Tidak Boleh Kosong!',
            ],
        );
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        $g1 = $tanggal1 . ' ' . $jam1;
        $g2 = $tanggal2 . ' ' . $jam2;

        $data['tanggal1'] = $tanggal1;
        $data['jam1'] = $request->jam1;
        $data['tanggal2'] = $tanggal2;
        $data['jam2'] = $request->jam2;
        $data['benang'] = Benang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'benang.id_lotextruder')
            ->whereBetween('benang.created_at', [$g1, $g2])
            ->orderBy('benang.created_at', 'asc')
            // ->where('tgl_benang', '<=', $tanggal2)
            // ->whereBetween('jam_benang', [$jam1, $jam2])
            // ->where('jam_benang', '<=', $jam2)
            // ->where('jam_benang', 'like', '%' . $jam . '%')
            ->get();
        return view('benang.filter', $data);
    }
    public function filterk(Request $request)
    {
        $request->validate(
            [
                'tanggal1' => 'required',
                'jam1' => 'required',
                'tanggal2' => 'required',
                'jam2' => 'required',
            ],
            [
                'tanggal1.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam1.required' => 'Jam Tidak Boleh Kosong!',
                'tanggal2.required' => 'Tanggal Tidak Boleh Kosong!',
                'jam2.required' => 'Jam Tidak Boleh Kosong!',
            ],
        );
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        $g1 = $tanggal1 . ' ' . $jam1;
        $g2 = $tanggal2 . ' ' . $jam2;

        $data['tanggal1'] = $tanggal1;
        $data['jam1'] = $request->jam1;
        $data['tanggal2'] = $tanggal2;
        $data['jam2'] = $request->jam2;
        $data['benang'] = KeluarBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', '=', 'keluar_benang.id_spesifikasi')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_benang.id_kodebenang')
            ->join('users', 'users.id', '=', 'keluar_benang.id')
            ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'keluar_benang.id_lotextruder')
            ->whereBetween('keluar_benang.created_at', [$g1, $g2])
            ->orderBy('keluar_benang.created_at', 'asc')
            ->get();
        return view('benang.filter_keluar', $data);
    }
    public function excel(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        return Excel::download(new BenangExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data benang.xlsx');
    }
    public function excelk(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        return Excel::download(new KeluarBenangExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data benang keluar.xlsx');
    }
}
