@extends('layout.dashboard')
@section('title', 'Ubah Benang')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Benang</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('benang.update', $benang[0]->id_benang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Kode Benang</label>
                            <select name="kode" class="form-control">
                                <option value="{{ $benang[0]->id_kodebenang }}">{{ $benang[0]->kode_benang }}</option>
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
                                <option value="{{ $benang[0]->id_lotextruder }}"
                                    data-lot="{{ $benang[0]->nama_lotextruder }}">
                                    {{ $benang[0]->nama_lotextruder . $benang[0]->nomor_lotextruder . '/' . $tanggal . '/' . auth()->user()->shift }}
                                </option>
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
                                <option value="{{ $benang[0]->id_spesifikasi }}">{{ $benang[0]->nama_spesifikasi }}
                                </option>
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
                                placeholder="Qty Benang" value="{{ $benang[0]->qty_benang }}">
                            @error('qty')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal"
                                value="{{ $benang[0]->tgl_benang }}">
                            @error('qty')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Brutto</label>
                            <input type="text" class="form-control" id="brutto" name="brutto" placeholder="Brutto"
                                value="{{ $benang[0]->bruto }}">
                            @error('brutto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Palet</label>
                            <input type="text" name="beratpalet" id="beratpalet" class="form-control"
                                value="{{ $benang[0]->berat_palet }}">
                            @error('beratpalet')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Keranjang per Satuan</label>
                            <select name="beratsatuan" id="beratsatuan" class="form-control">
                                <option value="{{ $benang[0]->berat_keranjang_satuan }}">
                                    {{ $benang[0]->berat_keranjang_satuan }}
                                </option>
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
                                <option value="{{ $benang[0]->jumlah_keranjang_palet }}">
                                    {{ $benang[0]->jumlah_keranjang_palet }}
                                </option>
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
                                placeholder="Total Berat Keranjang/Palet"
                                value="{{ $benang[0]->total_berat_keranjang_palet }}">
                            @error('totalberat')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Satuan per Bobin</label>
                            <input type="text" class="form-control" id="beratbobin" name="beratbobin"
                                placeholder="Berat Satuan/Bobin" value="{{ $benang[0]->berat_bobin_satuan }}">
                            @error('beratbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Banyak Bobin per Keranjang</label>
                            <input type="text" class="form-control" id="bobin" name="bobin"
                                placeholder="Bobin" value="{{ $benang[0]->banyak_bobin_keranjang }}">
                            @error('bobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Banyak Bobin per Palet</label>
                            <input type="text" class="form-control" id="banyakbobin" name="banyakbobin"
                                placeholder="Banyak Bobin/Palet" value="{{ $benang[0]->total_banyakbobin_palet }}">
                            @error('banyakbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Berat Bobin per Palet</label>
                            <input type="text" class="form-control" id="totalbobin" name="totalbobin"
                                placeholder="Total Berat Bobin" value="{{ $benang[0]->total_beratbobin_palet }}">
                            @error('totalbobin')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Netto</label>
                            <input type="text" class="form-control" id="netto" name="netto" readonly
                                placeholder="Netto" value="{{ $benang[0]->neto }}">
                            @error('netto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Pallet</label>
                            <input type="text" class="form-control" name="pallet" placeholder="Nomor Pallet"
                                value="{{ $benang[0]->no_palet }}">
                            @error('pallet')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Aktual Benang per Keranjang</label>
                            <input type="text" class="form-control" name="aktual" placeholder="Berat Aktual"
                                id="aktual" readonly value="{{ $benang[0]->berat_aktual }}">
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

                var beratsatuan = $('#beratsatuan').val();
                var jumlah = $('#jumlah').val();
                var bobin = $('#bobin').val();
                var bruto = $(this).val();
                var beratpalet = $('#beratpalet').val();

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

                var bbobin = "";
                if (lot == "YSTR") {
                    bbobin = 0.22;
                    $('#beratbobin').val('0.22');
                } else {
                    bbobin = 0.285;
                    $('#beratbobin').val('0.285');
                }

                var beratsatuan = $('#beratsatuan').val();
                var jumlah = $('#jumlah').val();
                var bobin = $('#bobin').val();
                var bruto = $(this).val();
                var beratpalet = $('#beratpalet').val();

                var beratsatuan = $('#beratsatuan').val();
                var jumlah = $('#jumlah').val();
                var bobin = $('#bobin').val();
                var bruto = $('#brutto').val();
                var beratpalet = $('#beratpalet').val();

                var banyakbobin = jumlah * bobin;
                var totalberat = beratsatuan * jumlah;
                var beratbobin = bbobin;
                var totalbobin = banyakbobin * beratbobin;
                var netto = bruto - beratpalet - totalbobin - totalberat;
                var aktual = netto / jumlah;

                $('#aktual').val(aktual);
                $('#netto').val(netto);
                $('#totalbobin').val(totalbobin);
                $('#banyakbobin').val(banyakbobin);
                $('#totalberat').val(totalberat);
            });
        });
    </script>
@endsection
