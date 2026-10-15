@extends('layout.dashboard')
@section('title', 'Tambah Lot Extruder')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Lot Extruder</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('lotextruder.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lot Extruder</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama Lot Extruder"
                                value="{{ @old('nama') }}">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Lot Extruder</label>
                            <input class="form-control" type="text" name="nomor" placeholder="Nomor Lot Extruder"
                                value="{{ @old('nomor') }}">
                            @error('nomor')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Lot Extruder</label>
                            <select name="jenis" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="Starlinger">Starlinger</option>
                                <option value="Lohia">Lohia</option>
                            </select>
                            @error('jenis')
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
