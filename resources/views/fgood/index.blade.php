<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #ffdd87;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Data Finish Good')
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
        @if (session()->has('error'))
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('error') }}",
                    icon: "error",
                });
            </script>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Data Finish Good
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Spesifikasi Produk</th>
                                    <th>Densitas</th>
                                    <th>Denier</th>
                                    <th>Jumlah Lembar</th>
                                    <th>Lot Ball Press</th>
                                    <th>Brutto</th>
                                    <th>Perintah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finish as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_specproduk . ' ' . $data->lebar . 'x' . $data->panjang }}</td>
                                        <td>{{ $data->densitas }}</td>
                                        <td>{{ $data->denier }}</td>
                                        <td>{{ $data->jumlah_ikatan_perball }}</td>
                                        <td>{!! $data->lot_ball_press !!}</td>
                                        <td>{{ $data->brutto }}</td>
                                        <td>
                                            <form action="{{ route('fgood.destroy', $data->id_finish) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->user()->akses == 'admin')
                                                    <button class="btn btn-outline-danger mb-3"
                                                        onclick="return confirm('Yakin Dihapus?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('fgood.edit', $data->id_finish) }}"
                                                        class="btn btn-outline-info mb-3">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('fgood.show', $data->id_finish) }}"
                                                        class="btn btn-outline-info mb-3">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('fgood.cetak', $data->id_finish) }}" target="blank"
                                                    class="btn btn-outline-warning mb-3">
                                                    <i class="fa fa-print" aria-hidden="true"></i> Cetak ID FINISH GOOD
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('fgood.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Finish Good</a>
                </div>
            </div>
        </div>
    </div>
@endsection
