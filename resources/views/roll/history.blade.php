<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #a3ffc8;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Laporan Data Roll')
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
                    Laporan Data History Roll
                </div>
                <div class="card-body">
                    <form action="{{ route('roll.filterh') }}" method="POST">
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
                                    <th>User</th>
                                    <th>Petugas Timbang</th>
                                    <th>Tgl</th>
                                    <th>Jam</th>
                                    <th>Operator ML</th>
                                    <th>Spek Benang</th>
                                    <th>Lot Ext</th>
                                    <th>Spek Roll</th>
                                    <th>Netto</th>
                                    <th>Brutto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roll as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->petugas_timbang }}</td>
                                        <td>{{ $data->tgl_roll }}</td>
                                        <td>{{ $data->jam_roll }}</td>
                                        <td>{{ $data->operator_ml }}</td>
                                        <td>{{ $data->kode_benang }}</td>
                                        <td>{{ $data->lotextruder }}</td>
                                        <td>{{ $data->kode_roll . 'x' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}
                                        </td>
                                        <td>{{ $data->netto }}</td>
                                        <td>{{ $data->brutto }}</td>
                                        <td>
                                            <form action="{{ route('roll.history.destroy', $data->id_roll) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->user()->akses == 'admin')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin Dihapus?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('roll.hexcel', ['tanggal1' => $tanggal1, 'tanggal2' => $tanggal2, 'jam1' => $jam1, 'jam2' => $jam2]) }}"
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
