<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #ffdd87;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Keluar Finish Good')
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
                    <div class="ibox-title">Proses Keluar Finish Good</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('fgood.cari') }}" class="mb-5" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>ID Finish Good</label>
                            <input type="text" class="form-control" name="idfinish" placeholder="ID FINISH GOOD"
                                value="{{ @old('idfinish') }}" autofocus>
                            @error('idfinish')
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
                                    <th>Spesifikasi Produk</th>
                                    <th>Densitas</th>
                                    <th>Denier</th>
                                    <th>Brutto</th>
                                    <th>Lot Ball Press</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finish as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_specproduk . ' ' . $data->lebar . 'x' . $data->panjang }}</td>
                                        <td>{{ $data->densitas }}</td>
                                        <td>{{ $data->denier }}</td>
                                        <td>{{ $data->brutto }}</td>
                                        <td>{{ $data->lot_ball_press }}</td>
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
