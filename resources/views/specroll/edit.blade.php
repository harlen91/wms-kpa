@extends('layout.dashboard')
@section('title', 'Ubah Spesifikasi Roll')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Spesifikasi Roll</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('specroll.update', $specroll->id_specroll) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Kode Roll</label>
                            <input type="text" name="kode" class="form-control" value="{{ $specroll->kode_roll }}"
                                placeholder="Kode Roll">
                            @error('kode')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Specroll</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Specroll"
                                value="{{ $specroll->deskripsi }}">
                            @error('deskripsi')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebar</label>
                            <input type="text" class="form-control" name="lebar" placeholder="Lebar"
                                value="{{ $specroll->lebar }}">
                            @error('lebar')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Densitas</label>
                            <input type="text" class="form-control" name="densitas" placeholder="Densitas"
                                value="{{ $specroll->densitas }}">
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier</label>
                            <input type="text" class="form-control" name="denier" placeholder="Denier"
                                value="{{ $specroll->denier }}">
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Standart Panjang</label>
                            <input type="text" class="form-control" name="standart" placeholder="Standart Panjang"
                                value="{{ $specroll->standart_panjang }}">
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
