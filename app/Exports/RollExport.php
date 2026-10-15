<?php

namespace App\Exports;

use App\Models\Roll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RollExport implements FromView
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
            return view('roll.excel', [
                'data' => Roll::join('users', 'users.id', '=', 'roll.id')
                    ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
                    ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
                    ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
                    ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
                    ->get()
            ]);
        }
        return view('roll.excel', [
            'data' => Roll::join('users', 'users.id', '=', 'roll.id')
                ->join('kodebenangs', 'kodebenangs.id_kodebenang', '=', 'roll.id_kodebenang')
                ->join('specroll', 'specroll.id_specroll', '=', 'roll.id_specroll')
                ->join('machine_loom', 'machine_loom.id_machineloom', '=', 'roll.id_machineloom')
                ->join('circular_loom', 'circular_loom.id_circular', '=', 'roll.id_circular')
                ->whereBetween('roll.created_at', [$this->g1, $this->g2])
                ->orderBy('roll.created_at', 'asc')
                ->get()
        ]);
    }
}
