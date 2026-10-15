<?php

namespace App\Exports;

use App\Models\FinishGood;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FgoodExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
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
            return view('fgood.excel', [
                'data' => FinishGood::join('users', 'users.id', '=', 'finish_good.id')
                    ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                    ->get()
            ]);
        }
        return view('fgood.excel', [
            'data' => FinishGood::join('users', 'users.id', '=', 'finish_good.id')
                ->join('specproduk', 'specproduk.id_specproduk', '=', 'finish_good.id_specproduk')
                ->whereBetween('finish_good.created_at', [$this->g1, $this->g2])
                ->orderBy('finish_good.created_at', 'asc')
                ->get()
        ]);
    }
}
