@extends('layout.dashboard')
@section('title', 'Ubah Spesifikasi Benang')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Spesifikasi Benang</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('spesifikasi.update', $spesifikasi->id_spesifikasi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Spesifikasi</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama Spesifikasi"
                                value="{{ $spesifikasi->nama_spesifikasi }}">
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
