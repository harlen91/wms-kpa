@extends('layout.dashboard')
@section('title', 'Ubah Ball Press')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Ball Press</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('ballpress.update', $ballpress->id_ballpress) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Ball Press</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ $ballpress->nama_ballpress }}" placeholder="Ball Press">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Ball Press</label>
                            <input type="text" name="nomor" class="form-control"
                                value="{{ $ballpress->nomor_ballpress }}" placeholder="Nomor Ball Press">
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
