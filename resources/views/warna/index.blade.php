@extends('layout.dashboard')
@section('title', 'Data Warna Jahita Karung')
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
                    Data Warna Jahitan Karung
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Warna</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warna as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_warna }}</td>
                                        <td>
                                            <form action="{{ route('warna.destroy', $data->id_warna) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger mb-3"
                                                    onclick="return confirm('Yakin Dihapus?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('warna.edit', $data->id_warna) }}"
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
                    <a href="{{ route('warna.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Warna</a>
                </div>
            </div>
        </div>
    </div>
@endsection
