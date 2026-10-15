@extends('layout.dashboard')
@section('title', 'Data Roll Recycle')
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
                    Data Roll Recycle
                </div>
                <div class="card-body">
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
                                    <th>Range Berat(0%)</th>
                                    <th>Brutto</th>
                                    <th>Aksi</th>
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
                                        <td>{{ $data->kode_roll . 'x' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}
                                        </td>
                                        <td>{{ $data->netto }}</td>
                                        <td>{{ $data->range_berat_masuk_0 }}</td>
                                        <td>{{ $data->brutto }}</td>
                                        <td>
                                            <form action="{{ route('roll.destroy', $data->id_roll) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger mb-3"
                                                    onclick="return confirm('Yakin Dihapus?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('roll.edit', $data->id_roll) }}"
                                                    class="btn btn-outline-info mb-3">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </form>
                                        </td>
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
