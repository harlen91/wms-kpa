@extends('layout.dashboard')
@section('title', 'Data Finish Good')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Data Finish Good</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('fgood.update', $finish[0]->id_finish) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Spesifikasi Produk</label>
                            <select name="specproduk" id="specproduk" class="form-control" readonly>
                                <option value="{{ $finish[0]->id_specproduk }}">
                                    {{ $finish[0]->nama_specproduk . ' ' . $finish[0]->lebar . 'x' . $finish[0]->panjang }}
                                </option>
                                <option value="">--Pilih--</option>
                                @foreach ($specproduk as $data)
                                    <option value="{{ $data->id_specproduk }}">
                                        {{ $data->nama_specproduk . ' ' . $data->lebar . 'x' . $data->panjang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specproduk')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Densitas Produk</label>
                            <input type="text" name="densitas" class="form-control" value="{{ $finish[0]->densitas }}"
                                id="densitas" readonly>
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier Produk</label>
                            <input type="text" name="denier" class="form-control" value="{{ $finish[0]->denier }}"
                                id="denier" readonly>
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jumlah Lembar Per Ball (Lembar)</label>
                            <input type="text" name="jumlah_ikatan_perball" class="form-control"
                                value="{{ $finish[0]->jumlah_ikatan_perball }}" readonly>
                            @error('jumlah_ikatan_perball')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Brutto (Kg)</label>
                            <input type="text" name="brutto" id="brutto" class="form-control"
                                value="{{ $finish[0]->brutto }}" readonly>
                            @error('brutto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <a href="{{ route('fgood') }}" class="btn btn-success">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
