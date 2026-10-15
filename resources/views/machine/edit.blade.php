@extends('layout.dashboard')
@section('title', 'Ubah Machine Loom')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Machine Loom</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('machineloom.update', $machine->id_machineloom) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Machine Loom</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ $machine->nama_machineloom }}" placeholder="Nama Machine Loom">
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
