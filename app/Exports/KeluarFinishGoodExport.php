<?php

namespace App\Exports;

use App\Models\KeluarFinishGood;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KeluarFinishGoodExport implements FromView
{
    protected $tanggal1 = "";
    protected $tanggal2 = "";
    protected $jam1 = "";
    protected $jam2 = "";
    protected $g1 = "";
    protected $g2 = "";
    public function __construct(string $tanggal1, string $tanggal2, String $jam1, String $jam2)
    {
        $this->tanggal1 = $tanggal1;
        $this->tanggal2 = $tanggal2;
        $this->jam1 = $jam1;
        $this->jam2 = $jam2;
        $this->g1 = $tanggal1 . " " . $jam1;
        $this->g2 = $tanggal2 . " " . $jam2;
    }
    public function view(): View
    {
        // dd($this->jam);
        if ($this->tanggal1 == '0') {
            return view('fgood.excelk', [
                'data' => KeluarFinishGood::join('users', 'users.id', '=', 'keluar_finish_good.id')
                    // ->join('circular_loomfg', 'circular_loomfg.id_circular', '=', 'finish_good.id_circular')
                    // ->join('cutting', 'cutting.id_cutting', '=', 'keluar_finish_good.id_cutting')
                    // ->join('ball_press', 'ball_press.id_ballpress', '=', 'keluar_finish_good.id_ballpress')
                    ->join('specproduk', 'specproduk.id_specproduk', '=', 'keluar_finish_good.id_specproduk')
                    // ->join('densitas_produk', 'densitas_produk.id_densitasproduk', '=', 'keluar_finish_good.id_densitasproduk')
                    // ->join('denier_produk', 'denier_produk.id_denierproduk', '=', 'keluar_finish_good.id_denierproduk')
                    // ->join('warna_jahitan', 'warna_jahitan.id_warna', '=', 'keluar_finish_good.id_warna')
                    ->get()
            ]);
        }
        return view('fgood.excelk', [
            'data' => KeluarFinishGood::join('users', 'users.id', '=', 'keluar_finish_good.id')
                // ->join('circular_loomfg', 'circular_loomfg.id_circular', '=', 'finish_good.id_circular')
                // ->join('cutting', 'cutting.id_cutting', '=', 'keluar_finish_good.id_cutting')
                // ->join('ball_press', 'ball_press.id_ballpress', '=', 'keluar_finish_good.id_ballpress')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'keluar_finish_good.id_specproduk')
                // ->join('densitas_produk', 'densitas_produk.id_densitasproduk', '=', 'keluar_finish_good.id_densitasproduk')
                // ->join('denier_produk', 'denier_produk.id_denierproduk', '=', 'keluar_finish_good.id_denierproduk')
                // ->join('warna_jahitan', 'warna_jahitan.id_warna', '=', 'keluar_finish_good.id_warna')
                ->whereBetween('keluar_finish_good.created_at', [$this->g1, $this->g2])
                ->orderBy('keluar_finish_good.created_at', 'asc')
                ->get()
        ]);
    }
}
