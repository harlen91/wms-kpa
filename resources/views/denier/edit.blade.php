@extends('layout.dashboard')
@section('title', 'Ubah Denier Produk')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Denier Produk</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('denier.update', $denier->id_denierproduk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Denier Produk</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ $denier->nama_denierproduk }}" placeholder="Nama Denier Produk">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
