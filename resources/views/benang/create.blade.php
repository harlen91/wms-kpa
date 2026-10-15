@extends('layout.dashboard')
@section('title', 'Tambah Benang')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Tambah Benang</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('benang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kode Benang</label>
                            <select name="kode" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach ($kode as $data)
                                    <option value="{{ $data->id_kodebenang }}">{{ $data->kode_benang }}</option>
                                @endforeach
                            </select>
                            @error('kode')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lot Extruder</label>
                            <select name="lot" id="lot" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach ($lot as $data)
                                    <option value="{{ $data->id_lotextruder }}" data-lot="{{ $data->nama_lotextruder }}">
                                        {{ $data->nama_lotextruder . $data->nomor_lotextruder . '/' . $tanggal . '/' . auth()->user()->shift }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lot')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Spesifikasi</label>
                            <select name="spesifikasi" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach ($spesifikasi as $data)
                                    <option value="{{ $data->id_spesifikasi }}">{{ $data->nama_spesifikasi }}</option>
                                @endforeach
                            </select>
                            @error('spesifikasi')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Qty Benang</label>
                            <input type="text" class="form-control" id="qty" name="qty"
                                placeholder="Qty Benang" value="{{ @old('qty') }}">
                            @error('qty')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" placeholder="Tanggal"
                                value="{{ $tanggal }}" readonly>
                            @error('qty')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Brutto</label>
                            <input type="text" class="form-control" id="brutto" name="brutto" placeholder="Brutto"
                                value="{{ @old('brutto') }}">
                            @error('brutto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Pallet</label>
                            <input type="text" name="beratpalet" id="beratpalet" class="form-control">
                            @error('beratpalet')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Keranjang per Satuan</label>
                            <select name="beratsatuan" id="beratsatuan" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @error('beratsatuan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jumlah Keranjang per Palet</label>
                            <select name="jumlah" id="jumlah" class="form-control">
                                <option value="">--Pilih--</option>
                                @for ($i = 5; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('jumlah')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Berat Keranjang per Palet</label>
                            <input type="text" class="form-control" id="totalberat" name="totalberat"
                                placeholder="Total Berat Keranjang/Palet" value="{{ @old('totalberat') }}">
                            @error('totalberat')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Satuan Bobin</label>
                            <input type="text" class="form-control" id="beratbobin" name="beratbobin"
                                placeholder="Berat Satuan/Bobin" value="{{ @old('beratbobin') }}">
                            @error('beratbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Banyak Bobin per Keranjang</label>
                            <input type="text" class="form-control" id="bobin" name="bobin" placeholder="Bobin"
                                value="{{ @old('bobin') }}">
                            @error('bobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Banyak Bobin per Palet</label>
                            <input type="text" class="form-control" id="banyakbobin" name="banyakbobin"
                                placeholder="Banyak Bobin/Palet" value="{{ @old('banyakbobin') }}">
                            @error('banyakbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Berat Bobin per Palet</label>
                            <input type="text" class="form-control" id="totalbobin" name="totalbobin"
                                placeholder="Total Berat Bobin" value="{{ @old('totalbobin') }}">
                            @error('totalbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Netto</label>
                            <input type="text" class="form-control" id="netto" name="netto" readonly
                                placeholder="Netto" value="{{ @old('netto') }}">
                            @error('netto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Pallet</label>
                            <input type="text" class="form-control" name="pallet" placeholder="Nomor Pallet"
                                value="{{ @old('pallet') }}">
                            @error('pallet')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Aktual Benang per Keranjang</label>
                            <input type="text" class="form-control" name="aktual" placeholder="Berat Aktual"
                                id="aktual" readonly value="{{ @old('aktual') }}">
                            @error('aktual')
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
            $('#qty').keyup(function() {
                var qty = $(this).val();
                $('#bobin').val(qty);
            });
            $('#brutto').keypress(function(e) {
                if (e.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#jumlah').change(function() {
                var beratsatuan = $('#beratsatuan').val();
                var jumlah = $(this).val();
                var bobin = $('#bobin').val();
                var bruto = $('#brutto').val();
                var beratpalet = $('#beratpalet').val();

                console.log(bruto);

                var banyakbobin = jumlah * bobin;
                var totalberat = beratsatuan * jumlah;
                var beratbobin = $('#beratbobin').val();
                var totalbobin = banyakbobin * beratbobin;
                var netto = bruto - beratpalet - totalbobin - totalberat;
                var aktual = netto / jumlah;

                $('#aktual').val(aktual);
                $('#netto').val(netto);
                $('#totalbobin').val(totalbobin);
                $('#banyakbobin').val(banyakbobin);
                $('#totalberat').val(totalberat);
            });

            $('#lot').change(function() {
                var lot = $(this).find(':selected').attr('data-lot');
                console.log(lot);
                // var potong = lot.substr(0, 4);
                if (lot == "YSTR") {
                    $('#beratbobin').val('0.22');
                    console.log(0.22);
                } else {
                    $('#beratbobin').val('0.285');
                    console.log(0.285);
                }

            });

            // $('#bobin').focus(function() {
            //     alert('muncul');
            // })
            $('#bobin').click(function() {

            });

        });
    </script>
@endsection
