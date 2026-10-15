@extends('layout.dashboard')
@section('title', 'Tambah Finish Good')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Finish Good</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('fgood.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Spesifikasi Produk</label>
                            <select name="specproduk" id="specproduk" class="form-control">
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
                            <input type="text" name="densitas" class="form-control" value="{{ @old('densitas') }}"
                                id="densitas" readonly>
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier Produk</label>
                            <input type="text" name="denier" class="form-control" value="{{ @old('denier') }}"
                                id="denier" readonly>
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jumlah Lembar Per Ball (Lembar)</label>
                            <input type="text" name="jumlah_ikatan_perball" id="ikatball" class="form-control"
                                value="{{ @old('jumlah_ikatan_perball') }}">
                            @error('jumlah_ikatan_perball')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lot Ball Press</label>
                            <input type="text" name="lot_ball" class="form-control" value="{{ @old('lot_ball') }}">
                            @error('lot_ball')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Brutto (Kg)</label>
                            <input type="text" name="brutto" id="brutto" class="form-control"
                                value="{{ @old('brutto') }}">
                            @error('brutto')
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $('document').ready(function() {
            $('#specproduk').change(function() {
                let spek = $(this).val();
                $.ajax({
                    'url': `/fgood/getproduk/${spek}`,
                    'type': "GET",
                    success: function(res) {
                        // console.log(res);
                        $('#lebar').val(res.data.lebar);
                        $('#panjang').val(res.data.panjang);
                        $('#denier').val(res.data.denier);
                        $('#densitas').val(res.data.densitas);
                        $('#ikatball').val(res.data.jumlah_lembar);
                    }
                });
            });
            $('#brutto').keypress(function(e) {
                if (e.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#brutto').keyup(function() {})
        });
    </script>
@endsection
