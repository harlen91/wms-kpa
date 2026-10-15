<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #a3ffc8;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Keluar Roll')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    @if (session()->has('error'))
        <script>
            swal({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Proses Keluar Roll</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('roll.cari') }}" class="mb-5" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>ID Roll</label>
                            <input type="text" class="form-control" name="idroll" placeholder="ID Roll"
                                value="{{ @old('idroll') }}" autofocus>
                            @error('idroll')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-arrow-left"></i> Proses</button>
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
                                    <th>Operator ML</th>
                                    <th>Spek Benang</th>
                                    <th>Lot Ext</th>
                                    <th>Spek Roll</th>
                                    <th>Netto</th>
                                    <th>Brutto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roll as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->petugas_timbang }}</td>
                                        <td>{{ $data->operator_ml }}</td>
                                        <td>{{ $data->kode_benang }}</td>
                                        <td>{{ $data->lotextruder }}
                                        </td>
                                        <td>{{ $data->kode_roll . 'x' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}
                                        </td>
                                        <td>{{ $data->netto }}</td>
                                        <td>{{ $data->brutto }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
