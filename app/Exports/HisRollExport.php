<?php

namespace App\Exports;

use App\Models\HisRoll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HisRollExport implements FromView
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
            return view('roll.excel', [
                'data' => HisRoll::join('users', 'users.id', '=', 'history_roll.id')
                    ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_roll.id_kodebenang')
                    ->join('specroll', 'specroll.id_specroll', '=', 'history_roll.id_specroll')
                    ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'history_roll.id_machineloom')
                    ->join('circular_loom', 'circular_loom.id_circular', '=', 'history_roll.id_circular')
                    ->get()
            ]);
        }
        return view('roll.excel', [
            'data' => HisRoll::join('users', 'users.id', '=', 'history_roll.id')
                ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'history_roll.id_kodebenang')
                ->join('specroll', 'specroll.id_specroll', '=', 'history_roll.id_specroll')
                ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'history_roll.id_machineloom')
                ->join('circular_loom', 'circular_loom.id_circular', '=', 'history_roll.id_circular')
                ->whereBetween('history_roll.created_at', [$this->g1, $this->g2])
                ->orderBy('history_roll.created_at', 'asc')
                ->get()
        ]);
    }
}
