<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c7edff;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Retur Benang')
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
    @if (session()->has('success'))
        <script>
            swal({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Proses Retur Benang</div>
                </div>
                <div class="ibox-body">
                    {{-- <div style="width: 500px" id="reader"></div> --}}
                    <form action="{{ route('benang.pretur') }}" class="mb-5" method="POST">
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
