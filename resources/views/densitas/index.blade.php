@extends('layout.dashboard')
@section('title', 'Data Densitas Produk')
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
                    Data Densitas Produk
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Densitas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($densitas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_densitasproduk . 'x' . $data->nama_densitasproduk }}</td>
                                        <td>
                                            <form action="{{ route('densitas.destroy', $data->id_densitasproduk) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger mb-3"
                                                    onclick="return confirm('Yakin Dihapus?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('densitas.edit', $data->id_densitasproduk) }}"
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
                    <a href="{{ route('densitas.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Densitas Produk</a>
                </div>
            </div>
        </div>
    </div>
@endsection
