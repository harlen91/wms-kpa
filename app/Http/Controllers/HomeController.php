<?php

namespace App\Http\Controllers;

use App\Models\Kodebenang;
use App\Models\Prodi;
use App\Models\specproduk;
use App\Models\Specroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Models\Benang;
use App\Models\Roll;
use App\Models\FinishGood;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = auth()->user()->akses;
        if ($role == 'admin') {
            $data = Cache::remember('admin_dashboard_data', 60, function () {
                $kodebenang = Kodebenang::all();
                $specroll = Specroll::all();
                $specproduk = specproduk::all();

                // KPI Cards Data
                $card_yarn_weight = Benang::sum('neto');
                $card_yarn_palets = Benang::count();

                $card_roll_count = Roll::count();
                $card_roll_weight = Roll::sum('netto');

                $card_fg_count = FinishGood::count();
                $card_fg_weight = FinishGood::sum('brutto');

                // SQL GROUP BY pre-aggregations
                $yarn_aggregates = Benang::selectRaw('id_kodebenang, SUM(neto) as total_neto, COUNT(*) as palet_count')
                    ->groupBy('id_kodebenang')
                    ->get()
                    ->keyBy('id_kodebenang');

                $roll_aggregates = Roll::selectRaw('id_specroll, SUM(netto) as total_netto, SUM(panjang_aktual_roll) as total_panjang, COUNT(*) as roll_count')
                    ->groupBy('id_specroll')
                    ->get()
                    ->keyBy('id_specroll');

                $fg_aggregates = FinishGood::selectRaw('id_specproduk, SUM(brutto) as total_brutto, SUM(jumlah_ikatan_perball) as total_lembar, COUNT(*) as ball_count')
                    ->groupBy('id_specproduk')
                    ->get()
                    ->keyBy('id_specproduk');

                // Charts Data (Yarn Stock - Doughnut)
                $yarn_labels = [];
                $yarn_data = [];
                foreach ($kodebenang as $kb) {
                    $agg = $yarn_aggregates->get($kb->id_kodebenang);
                    $weight = $agg ? $agg->total_neto : 0;
                    if ($weight > 0) {
                        $yarn_labels[] = $kb->kode_benang;
                        $yarn_data[] = round($weight, 2);
                    }
                }

                // Charts Data (Roll Stock - Doughnut)
                $roll_labels = [];
                $roll_data = [];
                foreach ($specroll as $sr) {
                    $agg = $roll_aggregates->get($sr->id_specroll);
                    $count = $agg ? $agg->roll_count : 0;
                    if ($count > 0) {
                        $roll_labels[] = $sr->kode_roll . ' ' . $sr->lebar . 'x' . $sr->densitas;
                        $roll_data[] = $count;
                    }
                }

                // Charts Data (Finish Good Stock - Doughnut)
                $fg_labels = [];
                $fg_data = [];
                foreach ($specproduk as $sp) {
                    $agg = $fg_aggregates->get($sp->id_specproduk);
                    $weight = $agg ? $agg->total_brutto : 0;
                    if ($weight > 0) {
                        $fg_labels[] = $sp->nama_specproduk . ' ' . $sp->lebar . 'x' . $sp->panjang;
                        $fg_data[] = round($weight, 2);
                    }
                }

                // Recent Activities
                $recent_yarn = Benang::join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'benang.id_kodebenang')
                    ->orderBy('benang.created_at', 'desc')
                    ->limit(5)
                    ->get(['benang.*', 'kodebenangs.kode_benang']);

                $recent_roll = Roll::join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
                    ->orderBy('roll.created_at', 'desc')
                    ->limit(5)
                    ->get(['roll.*', 'specroll.kode_roll', 'specroll.lebar', 'specroll.densitas']);

                $recent_fg = FinishGood::join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                    ->orderBy('finish_good.created_at', 'desc')
                    ->limit(5)
                    ->get(['finish_good.*', 'specproduk.nama_specproduk', 'specproduk.lebar', 'specproduk.panjang']);

                return compact(
                    'kodebenang', 'specroll', 'specproduk',
                    'card_yarn_weight', 'card_yarn_palets',
                    'card_roll_count', 'card_roll_weight',
                    'card_fg_count', 'card_fg_weight',
                    'yarn_aggregates', 'roll_aggregates', 'fg_aggregates',
                    'yarn_labels', 'yarn_data',
                    'roll_labels', 'roll_data',
                    'fg_labels', 'fg_data',
                    'recent_yarn', 'recent_roll', 'recent_fg'
                );
            });

            return view('home', $data);
        } elseif ($role == 'user benang') {
            return redirect()->route('benang');
        } elseif ($role == 'user roll') {
            return redirect()->route('roll');
        } else if ($role == "user fg") {
            return redirect()->route('fgood');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
