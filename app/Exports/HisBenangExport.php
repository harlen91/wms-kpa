<?php

namespace App\Exports;

use App\Models\HisBenang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HisBenangExport implements FromView
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
        if ($this->tanggal1 == '0') {
            return view('benang.hexcel', [
                'data' => HisBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', "=", "history_benang.id_spesifikasi")
                    ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_benang.id_kodebenang')
                    ->join('users', 'users.id', '=', 'history_benang.id')
                    ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'history_benang.id_lotextruder')
                    ->get()
            ]);
        } else {
            return view('benang.hexcel', [
                'data' => HisBenang::join('spesifikasi', 'spesifikasi.id_spesifikasi', "=", "history_benang.id_spesifikasi")
                    ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_benang.id_kodebenang')
                    ->join('users', 'users.id', '=', 'history_benang.id')
                    ->join('lotextruders', 'lotextruders.id_lotextruder', '=', 'history_benang.id_lotextruder')
                    ->whereBetween('history_benang.created_at', [$this->g1, $this->g2])
                    ->orderBy('history_benang.created_at', 'asc')
                    ->get()
            ]);
        }
    }
}
