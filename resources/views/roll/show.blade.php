@extends('layout.dashboard')
@section('title', 'Data Roll')
@section('content')
{{-- @include('layout.card') --}}

<?php
$tanggal = date('Y/m/d');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Data Roll</div>
            </div>
            <div class="ibox-body">
                <div class="row mb-3">
                    <div class="col">Nomor Machine Loom</div>
                    <div class="col">: {{ $roll[0]->nama_machineloom }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">User</div>
                    <div class="col">: {{ $roll[0]->nama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Spesifikasi Roll</div>
                    <div class="col">:
                        {{ $roll[0]->kode_roll . ' ' . $roll[0]->lebar . 'x' . $roll[0]->densitas . 'x' . $roll[0]->densitas }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">Spesifikasi Benang</div>
                    <div class="col">: {{ $roll[0]->kode_benang }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Lot Extruder</div>
                    <div class="col">: {{ $roll[0]->lotextruder }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Circular Loom</div>
                    <div class="col">: {{ $roll[0]->nama_circular }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Tanggal Roll</div>
                    <div class="col">: {{ $roll[0]->tgl_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Jam Roll</div>
                    <div class="col">: {{ $roll[0]->jam_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Petugas Timbang</div>
                    <div class="col">: {{ $roll[0]->petugas_timbang }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Operator ML</div>
                    <div class="col">: {{ $roll[0]->operator_ml }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Denier</div>
                    <div class="col">: {{ $roll[0]->denier }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Densitas</div>
                    <div class="col">: {{ $roll[0]->densitas }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Lebar Standart/Roll</div>
                    <div class="col">: {{ $roll[0]->lebar_standart_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Lebar Aktual/Roll</div>
                    <div class="col">: {{ $roll[0]->lebar_aktual_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Panjang Standart/Roll</div>
                    <div class="col">: {{ $roll[0]->panjang_standart_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Panjang Aktual/Roll</div>
                    <div class="col">: {{ $roll[0]->panjang_aktual_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Berat Standart/Meter</div>
                    <div class="col">: {{ $roll[0]->berat_standart_meter }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Berat Standart/roll</div>
                    <div class="col">: {{ $roll[0]->berat_standart_roll }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Paper Core</div>
                    <div class="col">: {{ $roll[0]->paper_core }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Brutto</div>
                    <div class="col">: {{ $roll[0]->brutto }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Netto</div>
                    <div class="col">: {{ $roll[0]->netto }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Range Berat Masuk(0%)</div>
                    <div class="col">: {{ $roll[0]->range_berat_masuk_0 }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Range Berat masuk(-3%)</div>
                    <div class="col">: {{ $roll[0]->range_berat_masuk_3 }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Catatan</div>
                    <div class="col">: {{ $roll[0]->catatan }}</div>
                </div>
                <a href="{{ route('roll') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection