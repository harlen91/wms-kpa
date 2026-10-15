<?php

namespace App\Http\Controllers;

use App\Exports\HisRollExport;
use App\Exports\KeluarRollExport;
use App\Exports\RollExport;
use App\Models\CircularLoom;
use App\Models\HisRoll;
use App\Models\KeluarRoll;
use App\Models\Kodebenang;
use App\Models\Lotextruder;
use App\Models\MachineLoom;
use App\Models\Roll;
use App\Models\Specroll;
use App\Models\User;
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
use Maatwebsite\Excel\Facades\Excel;
use OuterIterator;
use PDO;
use PhpParser\Node\Expr\Cast\String_;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->orderBy('roll.created_at', 'desc')
            ->get();
        return view('roll.index', $data);
    }
    public function gagal()
    {
        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->where('status_roll', 'Gagal')
            ->get();
        return view('roll.gagal', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function getspek(string $id)
    {
        // $id = $request->spek;
        $spekroll = Specroll::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $spekroll
        ]);
    }
    public function getcircular(string $id)
    {
        $tanggal = date('Y/m/d');
        $x = $id;
        $circular = CircularLoom::all();
        foreach ($circular as $data):
            echo "<option value='" . $data->id_circular . "'>" . $data->nama_circular . '/' . $tanggal . '/' . auth()->user()->shift . '/' . $x . "</option>";
        endforeach;
    }
    public function create()
    {
        $data['users'] = User::all();
        $data['lot'] = Lotextruder::all();
        $data['benang'] = Kodebenang::all();
        $data['specroll'] = Specroll::all();
        $data['machine_loom'] = MachineLoom::all();
        $data['circular'] = CircularLoom::all();
        return view('roll.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'machine' => 'required',
                'timbang' => 'required',
                'operator' => 'required',
                'benang' => 'required',
                'lot' => 'required',
                'spekroll' => 'required',
                'circular' => 'required',
                'denier' => 'required',
                'densitas' => 'required',
                'lebar_standart' => 'required',
                'lebar_aktual' => 'required',
                'panjang_standart' => 'required',
                'panjang_aktual' => 'required',
                'berat_standart_meter' => 'required',
                'berat_standart_roll' => 'required',
                'papercore' => 'required',
                'brutto' => 'required',
                'netto' => 'required',
                'rberatmasuk0' => 'required',
                'rberatmasuk3' => 'required',
                'catatan' => 'required'
            ],
            [
                'machine.required' => 'Nomor Machine Loom Tidak Boleh Kosong!',
                'timbang.required' => 'Petugas Timbang Tidak Boleh Kosong!',
                'operator.required' => 'Operator ML Tidak Boleh Kosong!',
                'benang.required' => 'Spesifikasi Benang Tidak Boleh Kosong!',
                'lot.required' => 'Lot Extruder Tidak Boleh Kosong!',
                'spekroll.required' => 'Spesifikasi Roll Tidak Boleh Kosong!',
                'circular.required' => 'Circular Loom Tida Boleh Kosong!',
                'denier.required' => 'Denier Tidak Boleh Kosong!',
                'densitas.required' => 'Densitas Tidak Boleh Kosong!',
                'lebar_standart.required' => 'Lebar Standart Roll TIdak Boleh Kosong!',
                'lebar_aktual.required' => 'Lebar Aktual Roll Tidak Boleh Kosong!',
                'panjang_standart.required' => 'Panjang Standart Roll Tidak Boleh Kosong!',
                'panjang_aktual.required' => 'Panjang Aktual Roll Tidak Boleh Kosong!',
                'berat_standart_meter.required' => 'Berat Standar/Meter Tidak Boleh Kosong!',
                'berat_standart_roll.required' => 'Berat Standar/Roll Tidak Boleh Kosong!',
                'papecore.required' => 'Paper Core Tidak Boleh Kosong!',
                'brutto.required' => 'Brutto Tidak Boleh Kosong!',
                'netto.required' => 'Netto Tidak Boleh Kosong!',
                'rberatmasuk0.required' => 'Range Berat Masuk(0%) Tidak Boleh Kosong!',
                'rberatmasuk3.required' => 'Range Berat Masuk(3%) Tidak Boleh Kosong!',
                'catatan.required' => 'Catatan Tidak Boleh Kosong!'
            ]
        );
        $akses = auth()->user()->akses;
        $id = time();
        $rberatmasuk0 = $request->rberatmasuk0;
        $netto = $request->netto;
        // if ($rberatmasuk0 < $netto) {
        //     $status = "Gagal";
        // } else {
        //     $status = "Masuk";
        // }

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
        Roll::create([
            'id_roll' => $id,
            'id' => auth()->user()->id,
            'id_machineloom' => $request->machine,
            'id_specroll' => $request->spekroll,
            'id_kodebenang' => $request->benang,
            'lotextruder' => $request->lot,
            'id_circular' => $request->circular,
            'tgl_roll' => $tanggal,
            'jam_roll' => $jam,
            'petugas_timbang' => $request->timbang,
            'operator_ml' => $request->operator,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'lebar_standart_roll' => $request->lebar_standart,
            'lebar_aktual_roll' => $request->lebar_aktual,
            'panjang_standart_roll' => $request->panjang_standart,
            'panjang_aktual_roll' => $request->panjang_aktual,
            'berat_standart_meter' => $request->berat_standart_meter,
            'berat_standart_roll' => $request->berat_standart_roll,
            'paper_core' => $request->papercore,
            'brutto' => $request->brutto,
            'netto' => $request->netto,
            'range_berat_masuk_0' => $request->rberatmasuk0,
            'range_berat_masuk_3' => $request->rberatmasuk3,
            'waste' => $request->waste,
            'catatan' => $request->catatan,
            // 'status_roll' => $status,
            'qrcode_roll' => $datauri
        ]);
        HisRoll::create([
            'id_roll' => $id,
            'id' => auth()->user()->id,
            'id_machineloom' => $request->machine,
            'id_specroll' => $request->spekroll,
            'id_kodebenang' => $request->benang,
            'lotextruder' => $request->lot,
            'id_circular' => $request->circular,
            'tgl_roll' => $tanggal,
            'jam_roll' => $jam,
            'petugas_timbang' => $request->timbang,
            'operator_ml' => $request->operator,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'lebar_standart_roll' => $request->lebar_standart,
            'lebar_aktual_roll' => $request->lebar_aktual,
            'panjang_standart_roll' => $request->panjang_standart,
            'panjang_aktual_roll' => $request->panjang_aktual,
            'berat_standart_meter' => $request->berat_standart_meter,
            'berat_standart_roll' => $request->berat_standart_roll,
            'paper_core' => $request->papercore,
            'brutto' => $request->brutto,
            'netto' => $request->netto,
            'range_berat_masuk_0' => $request->rberatmasuk0,
            'range_berat_masuk_3' => $request->rberatmasuk3,
            'waste' => $request->waste,
            'catatan' => $request->catatan,
            'qrcode_roll' => $datauri
        ]);
        $request->session()->flash('success', 'Berhasil Disimpan!');
        // if ($akses == "user roll") {
        //     return redirect()->route('roll.show', $id);
        // }
        return redirect()->route('roll');
    }

    /**
     * Display the specified resource.
     */
    public function keluar()
    {
        $data['roll'] = KeluarRoll::join('users', 'users.id', '=', 'keluar_roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'keluar_roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'keluar_roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'keluar_roll.id_circular')
            ->orderBy('keluar_roll.created_at', 'desc')
            ->get();
        return view('roll.keluar', $data);
    }
    public function delkeluar(Request $request, $id)
    {
        $keluar = KeluarRoll::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data Keluar Roll!');
        return redirect()->route('roll');
    }
    public function delhiskeluar(Request $request, $id)
    {
        $keluar = HisRoll::find($id);
        $keluar->delete();
        $request->session()->flash('success', 'Berhasil Hapus Data History Keluar Rolls!');
        return redirect()->route('roll.history');
    }
    public function retur()
    {
        return view('roll.retur');
    }
    public function pretur(Request $request)
    {
        $request->validate([
            'idroll' => 'required'
        ], [
            'idroll.required' => 'ID Roll Tidak Boleh Kosong!'
        ]);
        $id = $request->idroll;
        $cari = KeluarRoll::find($id);
        if ($cari) {
            $cari->forceDelete();
            Roll::withTrashed()->where('id_roll', $id)->restore();

            session()->flash('success', 'Roll Berhasil Diretur!');
            return redirect()->route('roll.retur');
        } else {
            session()->flash('error', 'ID Roll Tidak Ditemukan!');
            return redirect()->route('roll.retur');
        }
    }
    public function cari(Request $request)
    {
        $cari = Roll::find($request->idroll);
        if ($cari) {
            $tanggal = date('Y/m/d');
            $jam = date('H:i:s');
            KeluarRoll::create([
                'id_rollkeluar' => $request->idroll,
                'id' => $cari->id,
                'id_machineloom' => $cari->id_machineloom,
                'id_specroll' => $cari->id_specroll,
                'id_kodebenang' => $cari->id_kodebenang,
                'lotextruder' => $cari->lotextruder,
                'id_circular' => $cari->id_circular,
                'tgl_roll' => $cari->tgl_roll,
                'jam_roll' => $cari->jam_roll,
                'tgl_keluar' => $tanggal,
                'jam_keluar' => $jam,
                'petugas_timbang' => $cari->petugas_timbang,
                'operator_ml' => $cari->operator_ml,
                'denier' => $cari->denier,
                'densitas' => $cari->densitas,
                'lebar_standart_roll' => $cari->lebar_standart_roll,
                'lebar_aktual_roll' => $cari->lebar_aktual_roll,
                'panjang_standart_roll' => $cari->panjang_standart_roll,
                'panjang_aktual_roll' => $cari->panjang_aktual_roll,
                'berat_standart_meter' => $cari->berat_standart_meter,
                'berat_standart_roll' => $cari->berat_standart_roll,
                'paper_core' => $cari->paper_core,
                'brutto' => $cari->brutto,
                'netto' => $cari->netto,
                'range_berat_masuk_0' => $cari->range_berat_masuk_0,
                'range_berat_masuk_3' => $cari->range_berat_masuk_3,
                'waste' => $cari->waste,
                'hasil_perkalian' => $cari->hasil_perkalian,
            ]);

            $roll = Roll::find($request->idroll);
            $roll->delete();

            // $data['roll'] = KeluarRoll::join('users', 'users.id', '=', 'keluar_roll.id')
            //     ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_roll.id_kodebenang')
            //     ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'keluar_roll.lotextruder')
            //     ->join('specroll', 'specroll.id_specroll', '=', 'keluar_roll.id_specroll')
            //     ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'keluar_roll.id_machineloom')
            //     ->join('circular_loom', 'circular_loom.id_circular', '=', 'keluar_roll.id_circular')
            //     ->where(['id_rollkeluar' => $request->idroll])
            //     ->get();
            // return view('roll.cari', $data);
            return redirect()->route('roll.keluar');
        } else {
            $request->session()->flash('error', 'ID Roll Tidak Ditemukan!');
            return redirect()->route('roll.keluar');
        }
    }
    public function proses(Request $request)
    {
        $tanggal = date('Y/m/d');
        $jam = date('H:i:s');
        KeluarRoll::create([
            'id_rollkeluar' => $request->idroll,
            'id' => $request->iduser,
            'id_machineloom' => $request->idmachine,
            'id_specroll' => $request->idspekroll,
            'id_kodebenang' => $request->idkodebenang,
            'lotextruder' => $request->idlot,
            'id_circular' => $request->idcircular,
            'tgl_roll' => $tanggal,
            'jam_roll' => $jam,
            'petugas_timbang' => $request->timbang,
            'operator_ml' => $request->operator,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'lebar_standart_roll' => $request->lebar_standart,
            'lebar_aktual_roll' => $request->lebar_aktual,
            'panjang_standart_roll' => $request->panjang_standart,
            'panjang_aktual_roll' => $request->panjang_aktual,
            'berat_standart_meter' => $request->berat_standart_meter,
            'berat_standart_roll' => $request->berat_standart_roll,
            'paper_core' => $request->papercore,
            'brutto' => $request->brutto,
            'netto' => $request->netto,
            'range_berat_masuk_0' => $request->rberatmasuk0,
            'range_berat_masuk_3' => $request->rberatmasuk3,
            'waste' => $request->waste,
        ]);

        $roll = Roll::find($request->idroll);
        $roll->delete();

        $request->session()->flash('success', 'Roll Berhasil Keluar');
        return redirect()->route('roll');
    }
    public function show(string $id)
    {
        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->where(['id_roll' => $id])
            ->get();
        return view('roll.show', $data);
    }
    public function cetak(string $id)
    {
        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->where(['id_roll' => $id])
            ->get();
        return view('roll.cetak', $data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {

        $x = Roll::find($id);
        if ($x) {
            $data['users'] = User::all();
            $data['lot'] = Lotextruder::all();
            $data['benang'] = Kodebenang::all();
            $data['specroll'] = Specroll::all();
            $data['machine_loom'] = MachineLoom::all();
            $data['circular'] = CircularLoom::all();
            $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
                ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
                ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
                ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
                ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
                ->where(['id_roll' => $id])
                ->get();
            return view('roll.edit', $data);
        } else {
            $request->session()->flash('error', 'Data Tidak Ditemukan!');
            return redirect()->route('roll');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roll = Roll::find($id);
        $hisroll = HisRoll::find($id);
        $tanggal = date('Y/m/d');
        $jam = date('H:i:s');
        $rberatmasuk0 = $request->rberatmasuk0;
        $netto = $request->netto;
        if ($rberatmasuk0 < $netto) {
            $status = "Gagal";
        } else {
            $status = "Masuk";
        }
        $roll->update([
            'id' => auth()->user()->id,
            'id_machineloom' => $request->machine,
            'id_specroll' => $request->spekroll,
            'id_kodebenang' => $request->benang,
            'lotextruder' => $request->lot,
            'id_circular' => $request->circular,
            'tgl_roll' => $tanggal,
            'jam_roll' => $jam,
            'petugas_timbang' => $request->timbang,
            'operator_ml' => $request->operator,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'lebar_standart_roll' => $request->lebar_standart,
            'lebar_aktual_roll' => $request->lebar_aktual,
            'panjang_standart_roll' => $request->panjang_standart,
            'panjang_aktual_roll' => $request->panjang_aktual,
            'berat_standart_meter' => $request->berat_standart_meter,
            'berat_standart_roll' => $request->berat_standart_roll,
            'paper_core' => $request->papercore,
            'brutto' => $request->brutto,
            'netto' => $request->netto,
            'range_berat_masuk_0' => $request->rberatmasuk0,
            'range_berat_masuk_3' => $request->rberatmasuk3,
            'waste' => $request->waste,
            'catatan' => $request->catatan,
            'status_roll' => $status,
        ]);
        if ($hisroll) {
            $hisroll->update([
                'id' => auth()->user()->id,
                'id_machineloom' => $request->machine,
                'id_specroll' => $request->spekroll,
                'id_kodebenang' => $request->benang,
                'lotextruder' => $request->lot,
                'id_circular' => $request->circular,
                'tgl_roll' => $tanggal,
                'jam_roll' => $jam,
                'petugas_timbang' => $request->timbang,
                'operator_ml' => $request->operator,
                'denier' => $request->denier,
                'densitas' => $request->densitas,
                'lebar_standart_roll' => $request->lebar_standart,
                'lebar_aktual_roll' => $request->lebar_aktual,
                'panjang_standart_roll' => $request->panjang_standart,
                'panjang_aktual_roll' => $request->panjang_aktual,
                'berat_standart_meter' => $request->berat_standart_meter,
                'berat_standart_roll' => $request->berat_standart_roll,
                'paper_core' => $request->papercore,
                'brutto' => $request->brutto,
                'netto' => $request->netto,
                'range_berat_masuk_0' => $request->rberatmasuk0,
                'range_berat_masuk_3' => $request->rberatmasuk3,
                'waste' => $request->waste,
                'catatan' => $request->catatan,
                'status_roll' => $status,
            ]);
        }
        $request->session()->flash('success', 'Berhasil diubah!');
        return redirect()->route('roll');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $roll = Roll::find($id);
        $hisroll = HisRoll::find($id);

        if ($hisroll) {
            $hisroll->delete();
        }
        if ($roll) {
            $roll->delete();
        }

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('roll');
    }
    public function clear()
    {
        $benang = KeluarRoll::whereNotNull('id_rollkeluar')->delete();
        session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('roll.laporank');
    }
    public function history()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['roll'] = HisRoll::join('users', 'users.id', '=', 'history_roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'history_roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'history_roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'history_roll.id_circular')
            ->get();
        return view('roll.history', $data);
    }
    public function hexcel(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new HisRollExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data history roll.xlsx');
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

        $data['roll'] = HisRoll::join('users', 'users.id', '=', 'history_roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'history_roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'history_roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'history_roll.id_circular')
            ->whereBetween('history_roll.created_at', [$g1, $g2])
            ->orderBy('history_roll.created_at', 'asc')
            ->get();
        return view('roll.filterh', $data);
    }
    public function laporan()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->get();
        return view('roll.laporan', $data);
    }
    public function laporank()
    {
        $data['tanggal1'] = "0";
        $data['jam1'] = "0";
        $data['tanggal2'] = "0";
        $data['jam2'] = "0";
        $data['roll'] = KeluarRoll::join('users', 'users.id', '=', 'keluar_roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'keluar_roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'keluar_roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'keluar_roll.id_circular')
            ->get();
        return view('roll.laporan_keluar', $data);
    }
    public function excel(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new RollExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data roll.xlsx');
    }
    public function excelk(Request $request)
    {
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $jam1 = $request->jam1;
        $jam2 = $request->jam2;
        // echo $tanggal . " " . $jam;
        return Excel::download(new KeluarRollExport($tanggal1, $tanggal2, $jam1, $jam2), 'laporan data roll keluar.xlsx');
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

        $data['roll'] = Roll::join('users', 'users.id', '=', 'roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
            ->whereBetween('roll.created_at', [$g1, $g2])
            ->orderBy('roll.created_at', 'asc')
            ->get();
        return view('roll.filter', $data);
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
        $data['roll'] = KeluarRoll::join('users', 'users.id', '=', 'keluar_roll.id')
            ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'keluar_roll.id_kodebenang')
            ->join('specroll', 'specroll.id_specroll', '=', 'keluar_roll.id_specroll')
            ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'keluar_roll.id_machineloom')
            ->join('circular_loom', 'circular_loom.id_circular', '=', 'keluar_roll.id_circular')
            ->whereBetween('keluar_roll.created_at', [$g1, $g2])
            ->orderBy('keluar_roll.created_at', 'asc')
            ->get();
        return view('roll.filter_keluar', $data);
    }
    public function scan()
    {
        return view('roll.scan');
    }
}
