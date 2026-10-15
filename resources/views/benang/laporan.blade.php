<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c7edff;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Laporan Data Benang')
@section('content')

    {{-- @include('layout.card') --}}
    <div class="row">
        @if (session()->has('success'))
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            </script>
        @endif

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Laporan Data Benang
                </div>
                <div class="card-body">
                    <form action="{{ route('benang.filter') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Dari Tanggal</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tanggal1">
                                @error('tanggal1')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">S/d Tanggal</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tanggal2">
                                @error('tanggal2')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Dari Jam</label>
                            <div class="col-sm-3">
                                <input type="text" id="timepicker" class="form-control timepicker" name="jam1">
                                @error('jam1')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">S/d Jam</label>
                            <div class="col-sm-3">
                                <input type="text" id="timepicker" class="form-control timepicker" name="jam2">
                                @error('jam2')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Benang</th>
                                    <th>Spesifikasi</th>
                                    <th>Lot Extruder</th>
                                    <th>Qty</th>
                                    <th>Tgl</th>
                                    <th>Jam</th>
                                    <th>User</th>
                                    <th>Bruto</th>
                                    <th>Neto</th>
                                    <th>Nomor Pallet</th>
                                    <th>Aktual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($benang as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kode_benang }}</td>
                                        <td>{{ $data->nama_spesifikasi }}</td>
                                        <td>{{ $data->nama_lotextruder . $data->nomor_lotextruder . '/' . str_replace('-', '/', $data->tgl_benang) . '/' . $data->shift . '/' . $data->no_palet }}
                                        </td>
                                        <td>{{ $data->qty_benang }}</td>
                                        <td>{{ $data->tgl_benang }}</td>
                                        <td>{{ $data->jam_benang }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->bruto }}</td>
                                        <td>{{ number_format($data->neto, 2) }}</td>
                                        <td>{{ $data->no_palet }}</td>
                                        <td>{{ number_format($data->berat_aktual, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('benang.excel', ['tanggal1' => $tanggal1, 'tanggal2' => $tanggal2, 'jam1' => $jam1, 'jam2' => $jam2]) }}"
                        class="btn btn-outline-info">Export Excel</a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

    <script>
        $('document').ready(function() {
            $('input.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 1
            });
        });
    </script>
@endsection
