@extends('layout.dashboard')
@section('title', 'Tambah Kode Benang')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Kode Benang</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('kodebenang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kode Benang</label>
                            <input class="form-control" type="text" name="kode" placeholder="Kode Benang"
                                value="{{ @old('nama') }}">
                            @error('kode')
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
