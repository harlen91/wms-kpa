@extends('layout.dashboard')
@section('title', 'Tambah Spesifikasi Roll')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Spesifikasi Roll</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('specroll.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kode Roll</label>
                            <input type="text" name="kode" class="form-control" value="{{ @old('kode') }}"
                                placeholder="Kode Roll">
                            @error('kode')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Specroll</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Specroll"
                                value="{{ @old('deskripsi') }}">
                            @error('deskripsi')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebar</label>
                            <input type="text" class="form-control" name="lebar" placeholder="Lebar"
                                value="{{ @old('lebar') }}">
                            @error('lebar')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Densitas</label>
                            <input type="text" class="form-control" name="densitas" placeholder="Densitas"
                                value="{{ @old('densitas') }}">
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier</label>
                            <input type="text" class="form-control" name="denier" placeholder="Denier"
                                value="{{ @old('denier') }}">
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Standart Panjang</label>
                            <input type="text" class="form-control" name="standart" placeholder="Standart Panjang"
                                value="{{ @old('standart') }}">
                            @error('standart')
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
