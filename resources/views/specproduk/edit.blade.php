@extends('layout.dashboard')
@section('title', 'Ubah Spesifikasi Produk')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Spesifikasi Produk</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('specproduk.update', $spek->id_specproduk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Spesifikasi Produk</label>
                            <input type="text" name="nama" class="form-control" value="{{ $spek->nama_specproduk }}"
                                placeholder="Nama Spesifikasi Produk">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebar</label>
                            <input type="text" class="form-control" name="lebar" placeholder="Lebar"
                                value="{{ $spek->lebar }}">
                            @error('lebar')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Panjang</label>
                            <input type="text" class="form-control" name="panjang" placeholder="Panjang"
                                value="{{ $spek->panjang }}">
                            @error('panjang')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier</label>
                            <input type="text" class="form-control" name="denier" placeholder="Denier Produk"
                                value="{{ $spek->denier }}">
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Densitas</label>
                            <input type="text" class="form-control" name="densitas" placeholder="Densitas Produk"
                                value="{{ $spek->densitas }}">
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jumlah Lembar Per Ball (Lembar)</label>
                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Lembar"
                                value="{{ $spek->jumlah_lembar }}">
                            @error('jumlah')
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
