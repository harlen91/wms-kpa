@extends('layout.dashboard')
@section('title', 'Data Spesfikasi Roll')
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
                    Data Spesfikasi Roll
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Roll</th>
                                    <th>Deskrpisi</th>
                                    <th>Lebar</th>
                                    <th>Densitas</th>
                                    <th>Denier</th>
                                    <th>Standart Panjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specroll as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kode_roll }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>{{ $data->lebar }} </td>
                                        <td>{{ $data->densitas }}
                                        <td>{{ $data->denier }}
                                        <td>{{ $data->standart_panjang }}</td>
                                        <td>
                                            <form action="{{ route('specroll.destroy', $data->id_specroll) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger mb-3"
                                                    onclick="return confirm('Yakin Dihapus?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('specroll.edit', $data->id_specroll) }}"
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
                    <a href="{{ route('specroll.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Spesifikasi Roll</a>
                </div>
            </div>
        </div>
    </div>
@endsection
