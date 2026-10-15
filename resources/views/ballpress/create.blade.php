@extends('layout.dashboard')
@section('title', 'Tambah Ball Press')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Ball Press</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('ballpress.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Ball Press</label>
                            <input type="text" name="nama" class="form-control" value="{{ @old('nama') }}"
                                placeholder="Ball Press">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Ball Press</label>
                            <input type="text" name="nomor" class="form-control" value="{{ @old('nomor') }}"
                                placeholder="Nomor Ball Press">
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
