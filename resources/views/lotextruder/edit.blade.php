@extends('layout.dashboard')
@section('title', 'Ubah Lot Extruder')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Lot Extruder</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('lotextruder.update', $lotextruder->id_lotextruder) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Lot Extruder</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama Lot Extruder"
                                value="{{ $lotextruder->nama_lotextruder }}">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Lot Extruder</label>
                            <input class="form-control" type="text" name="nomor" placeholder="Nomor Lot Extruder"
                                value="{{ $lotextruder->nomor_lotextruder }}">
                            @error('nomor')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Lot Extruder</label>
                            <select name="jenis" class="form-control">
                                <option value="{{ $lotextruder->jenis }}">{{ $lotextruder->jenis }}</option>
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
