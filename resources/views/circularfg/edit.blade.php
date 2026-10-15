@extends('layout.dashboard')
@section('title', 'Ubah Circular Loom')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Circular Loom Finish</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('circularloomfg.update', $circular->id_circular) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Circular Loom</label>
                            <input type="text" name="nama" class="form-control" value="{{ $circular->nama_circular }}"
                                placeholder="Nama Circular Loom">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Circular Loom</label>
                            <input type="text" name="nomor" class="form-control"
                                value="{{ $circular->nomor_circular }}" placeholder="Nomor Circular Loom">
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
