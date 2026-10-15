@extends('layout.dashboard')
@section('title', 'Ubah Roll')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah Roll</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('roll.update', $roll[0]->id_roll) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nomor Machine Loom</label>
                            <select name="machine" id="machine" class="form-control">
                                <option value="{{ $roll[0]->id_machineloom }}">{{ $roll[0]->nama_machineloom }}</option>
                                <option value="">--Pilih--</option>
                                @foreach ($machine_loom as $data)
                                    <option value="{{ $data->id_machineloom }}">{{ $data->nama_machineloom }}</option>
                                @endforeach
                            </select>
                            @error('machine')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Petugas Timbang</label>
                            <input type="text" name="timbang" class="form-control"
                                value="{{ $roll[0]->petugas_timbang }}" placeholder="Petugas Timbang">
                            @error('timbang')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Operator ML</label>
                            <input type="text" name="operator" class="form-control" value="{{ $roll[0]->operator_ml }}"
                                placeholder="Operator ML">
                            @error('operator')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Spesifikasi Benang</label>
                            <select name="benang" class="form-control">
                                <option value="{{ $roll[0]->id_kodebenang }}">{{ $roll[0]->kode_benang }}</option>
                                <option value="">--Pilih--</option>
                                @foreach ($benang as $data)
                                    <option value="{{ $data->id_kodebenang }}">{{ $data->kode_benang }}</option>
                                @endforeach
                            </select>
                            @error('benang')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lot Extruder</label>
                            <input type="text" name="lot" class="form-control" value="{{ $roll[0]->lotextruder }}">
                            @error('lot')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Spesifikasi Roll</label>
                            <select name="spekroll" id="spekroll" class="form-control">
                                <option value="{{ $roll[0]->id_specroll }}">
                                    {{ $roll[0]->kode_roll . ' ' . $roll[0]->lebar . 'x' . $roll[0]->densitas . 'x' . $roll[0]->densitas }}
                                </option>
                                <option value="">--Pilih--</option>
                                @foreach ($specroll as $data)
                                    <option value="{{ $data->id_specroll }}">
                                        {{ $data->kode_roll . ' ' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('spekroll')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nomor Lot Circular Loom</label>
                            <select name="circular" id="circular" class="form-control">
                                <option value="{{ $roll[0]->id_circular }}">
                                    {{ $roll[0]->nama_circular . '/' . $roll[0]->tgl_roll . '/' . $roll[0]->shift }}
                                </option>
                                <option value="">--Pilih--</option>
                                @foreach ($circular as $data)
                                    <option value="{{ $data->id_circular }}">
                                        {{ $data->nama_circular . ' / ' . $data->tgl_circular . ' / ' . $data->shift }}
                                    </option>
                                @endforeach
                            </select>
                            @error('circular')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Denier</label>
                            <input type="text" name="denier" id="denier" class="form-control"
                                value="{{ $roll[0]->denier }}" placeholder="Denier" readonly>
                            @error('denier')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Densitas</label>
                            <input type="text" name="densitas" id="densitas" class="form-control"
                                value="{{ $roll[0]->densitas }}" placeholder="Densitas" readonly>
                            @error('densitas')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebar Standart Roll</label>
                            <input type="text" name="lebar_standart" id="lebar_standart" class="form-control"
                                value="{{ $roll[0]->lebar_standart_roll }}" placeholder="Lebar Standart Roll" readonly>
                            @error('lebar_standart')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Lebar Aktual Roll</label>
                            <input type="text" name="lebar_aktual" id="lebar_aktual" class="form-control"
                                value="{{ $roll[0]->lebar_aktual_roll }}" placeholder="Lebar Aktual Roll">
                            @error('lebar_aktual')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Panjang Standart Roll</label>
                            <input type="text" name="panjang_standart" id="panjang_standart" class="form-control"
                                value="{{ $roll[0]->panjang_standart_roll }}" placeholder="Panjang Standart Roll">
                            @error('panjang_standart')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Panjang Aktual Roll</label>
                            <input type="text" name="panjang_aktual" id="panjang_aktual" class="form-control"
                                value="{{ $roll[0]->panjang_aktual_roll }}" placeholder="Panjang Aktual Roll">
                            @error('panjang_aktual')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Standart per Meter</label>
                            <input type="text" name="berat_standart_meter" id="berat_standart_meter"
                                class="form-control" value="{{ $roll[0]->berat_standart_meter }}"
                                placeholder="Berat Standart/Meter" readonly>
                            @error('berat_standart_meter')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Standart per Roll</label>
                            <input type="text" name="berat_standart_roll" id="berat_standart_roll"
                                class="form-control" value="{{ $roll[0]->berat_standart_roll }}"
                                placeholder="Berat Standart/Roll" readonly>
                            @error('berat_standart_roll')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Brutto Aktual Roll</label>
                            <input type="text" name="brutto" id="brutto" class="form-control"
                                value="{{ $roll[0]->brutto }}" placeholder="Brutto">
                            @error('brutto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Paper Core</label>
                            <input type="text" name="papercore" id="papercore" class="form-control"
                                value="{{ $roll[0]->paper_core }}" placeholder="Paper Core" readonly>
                            @error('papercore')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Range Berat Masuk(-3%)</label>
                            <input type="text" name="rberatmasuk3" id="rberatmasuk3" class="form-control"
                                value="{{ $roll[0]->range_berat_masuk_3 }}" placeholder="Ranger Berat Masuk(-3%)"
                                readonly>
                            @error('rberatmasuk3')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Range Berat Masuk(0%)</label>
                            <input type="text" name="rberatmasuk0" id="rberatmasuk0" class="form-control"
                                value="{{ $roll[0]->range_berat_masuk_0 }}" placeholder="Ranger Berat Masuk(0%)"
                                readonly>
                            @error('rberatmasuk0')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Netto</label>
                            <input type="text" name="netto" id="netto" class="form-control"
                                value="{{ $roll[0]->netto }}" placeholder="Netto" readonly>
                            @error('netto')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" cols="30" rows="10">{{ $roll[0]->catatan }}</textarea>
                            @error('catatan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Berat Waste</label>
                            <input type="text" name="waste" id="waste" class="form-control"
                                value="{{ @old('waste') }}" placeholder="Berat Waste" readonly>
                            @error('waste')
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
            new SlimSelect({
                select: '#spekroll',
                events: {
                    afterChange: () => {
                        $('#spekroll').trigger('change');
                    }
                }
            })
            $('#machine').change(function() {
                var x = $(this).find(":selected").text();
                $.ajax({
                    'url': `/roll/getcircular/${x}`,
                    'type': 'GET',
                    success: function(res) {
                        $("#circular").html(res);
                    }
                });
            });
            $('#spekroll').change(function() {
                let spek = $(this).val();
                $.ajax({
                    'url': `/roll/getspek/${spek}`,
                    'type': "GET",
                    success: function(res) {
                        $('#denier').val(res.data.denier);
                        $('#densitas').val(res.data.densitas);
                        $('#lebar_standart').val(res.data.lebar);
                        $('#panjang_standart').val(res.data.standart_panjang);
                        var lebarstandart = res.data.lebar;
                        var densitas = res.data.densitas;
                        var denier = res.data.denier;

                        var bstandartmeter = (lebarstandart * densitas * denier / 5715) / 1000;
                        if (lebarstandart < 75) {
                            $('#papercore').val('2');
                        } else {
                            $('#papercore').val('3');
                        }

                        $('#berat_standart_meter').val(bstandartmeter);

                    }
                });
            });
            $('#panjang_aktual').keyup(function() {
                var bstandartmeter = $('#berat_standart_meter').val();
                var panjang_aktual = $(this).val();
                var bstandartroll = bstandartmeter * panjang_aktual;
                var hasilkali = 0.03 * bstandartroll;
                var beratmasuk3 = bstandartroll - hasilkali;
                $('#rberatmasuk0').val(bstandartroll.toFixed(1));
                $('#berat_standart_roll').val(bstandartroll.toFixed(1));
                $('#rberatmasuk3').val(beratmasuk3.toFixed(1));

            })
            // $('#panjang_standart').keyup(function() {

            //     var bstandartmeter = $('#berat_standart_meter').val();
            //     var panjang_standart = $(this).val();
            //     // var bstandartroll = panjang_standart * bstandartmeter;
            //     // var hasilkali = 0.03 * bstandartroll;
            //     // var beratmasuk3 = bstandartroll - hasilkali;
            //     // $('#berat_standart_roll').val(bstandartroll.toFixed(3));

            //     // $('#hasilkali').val(hasilkali.toFixed(3));
            //     // $('#rberatmasuk3').val(beratmasuk3);
            // });
            $('#brutto').keypress(function(e) {
                if (e.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#brutto').keyup(function(e) {
                var brutto = $(this).val();
                var papercore = $('#papercore').val();
                var netto = brutto - papercore;
                $('#netto').val(netto);
            });
        });
    </script>
@endsection
