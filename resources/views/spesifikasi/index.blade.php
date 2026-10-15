@extends('layout.dashboard')
@section('title', 'Spesifikasi Benang')
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
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Data Spesifikasi Benang</div>
                </div>
                <div class="ibox-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Spesifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spesifikasi as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_spesifikasi }}</td>
                                        <td>
                                            <form action="{{ route('spesifikasi.destroy', $data->id_spesifikasi) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger"
                                                    onclick="return confirm('Yakin Dihapus?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('spesifikasi.edit', $data->id_spesifikasi) }}"
                                                    class="btn btn-outline-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('spesifikasi.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah spesifikasi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
