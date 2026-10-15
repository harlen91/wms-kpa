@extends('layout.dashboard')
@section('title', 'Tambah Densitas Produk')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Densitas Produk</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('densitas.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Densitas Produk</label>
                            <input type="text" name="nama" class="form-control" value="{{ @old('nama') }}"
                                placeholder="Nama Densitas Produk. Contoh : 10">
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
