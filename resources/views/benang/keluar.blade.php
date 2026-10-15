<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c7edff;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Keluar Benang')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    @if (session()->has('error'))
        <script>
            swal({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Proses Keluar Benang</div>
                </div>
                <div class="ibox-body">
                    {{-- <div style="width: 500px" id="reader"></div> --}}
                    <form action="{{ route('benang.cari') }}" class="mb-5" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>ID Pallet Benang</label>
                            <input type="text" class="form-control" name="idbenang" placeholder="ID Pallet"
                                value="{{ @old('idbenang') }}" autofocus>
                            @error('idbenang')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-arrow-left"></i> Proses</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Benang</th>
                                    <th>Spesifikasi</th>
                                    <th>Lot Extruder</th>
                                    <th>Qty</th>
                                    <th>Tgl</th>
                                    <th>User</th>
                                    <th>Bruto</th>
                                    <th>Neto</th>
                                    <th>Nomor Pallet</th>
                                    <th>Aktual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($benang as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kode_benang }}</td>
                                        <td>{{ $data->nama_spesifikasi }}</td>
                                        <td>{{ $data->nama_lotextruder . $data->nomor_lotextruder . '/' . str_replace('-', '/', $data->tgl_benang) . '/' . $data->shift . '/' . $data->no_palet }}
                                        </td>
                                        <td>{{ $data->qty_benang }}
                                        <td>{{ $data->tgl_benang }}
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->bruto }}</td>
                                        <td>{{ number_format($data->neto, 2) }}</td>
                                        <td>{{ $data->no_palet }}</td>
                                        <td>{{ number_format($data->berat_aktual, 2) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            console.log(`Scan result: ${decodedText}`, decodedResult);
            alert(decodedText);
            html5QrCode.stop();
        };
        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        };

        // If you want to prefer front camera
        html5QrCode.start({
            facingMode: "user"
        }, config, qrCodeSuccessCallback);

        // If you want to prefer back camera
        // html5QrCode.start({
        //     facingMode: "environment"
        // }, config, qrCodeSuccessCallback);

        // // Select front camera or fail with `OverconstrainedError`.
        // html5QrCode.start({
        //     facingMode: {
        //         exact: "user"
        //     }
        // }, config, qrCodeSuccessCallback);

        // // Select back camera or fail with `OverconstrainedError`.
        // html5QrCode.start({
        //     facingMode: {
        //         exact: "environment"
        //     }
        // }, config, qrCodeSuccessCallback);
    </script> --}}
@endsection
