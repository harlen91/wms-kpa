<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #a3ffc8;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Data Roll')
@section('content')
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
        @if (session()->has('error'))
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('error') }}",
                    icon: "error",
                });
            </script>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Roll
                </div>
                <div class="card-body">
                    <div style="overflow-x: scroll;">
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
                                    <th>Lot Circular Loom</th>
                                    <th>Spek Roll</th>
                                    <th>Netto</th>
                                    <th>Brutto</th>
                                    <th>Perintah</th>
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
                                        <td>{{ $data->lotextruder }}</td>
                                        <td>{{ $data->nama_circular . '/' . $data->tgl_roll . '/' . $data->shift . '/' . $data->nama_machineloom }}
                                        <td>{{ $data->kode_roll . 'x' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}
                                        </td>
                                        <td>{{ $data->netto }}</td>
                                        <td>{{ $data->brutto }}</td>
                                        <td>
                                            <form action="{{ route('roll.destroy', $data->id_roll) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->user()->akses == 'admin')
                                                    <button class="btn btn-outline-danger mb-3"
                                                        onclick="return confirm('Yakin Dihapus?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('roll.edit', $data->id_roll) }}"
                                                        class="btn btn-outline-info mb-3">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('roll.show', $data->id_roll) }}"
                                                        class="btn btn-outline-info mb-3">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('roll.cetak', $data->id_roll) }}" target="blank"
                                                    class="btn btn-outline-warning mb-3">
                                                    <i class="fa fa-print" aria-hidden="true"></i> Cetak ID Roll
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('roll.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Roll</a>
                    {{-- <a href="{{ route('roll.gagal') }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i>
                        Recycle Bin Roll
                    </a> --}}
                </div>

            </div>
        </div>
    </div>
@endsection
