@extends('layout.dashboard')
@section('title', 'Tambah Circular Loom')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Circular Loom Finish Good</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('circularloomfg.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Circular Loom</label>
                            <input type="text" name="nama" class="form-control" value="{{ @old('nama') }}"
                                placeholder="Nama Circular Loom">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Circular Loom</label>
                            <input type="text" name="nomor" class="form-control" value="{{ @old('nomor') }}"
                                placeholder="Nomor Circular Loom">
                            @error('nomor')
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
