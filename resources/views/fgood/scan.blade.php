<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c7edff;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Scan Finish Good')
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
                    <div class="ibox-title">Proses Scan Finish Good</div>
                </div>
                <div class="ibox-body">
                    <div style="width: 100%" id="reader"></div>
                    <button type="button" class="btn btn-success mt-3 btn-block" id="tombol"><i class="fa fa-qrcode"></i>
                        Mulai Scan</button>
                </div>
            </div>

        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $('document').ready(function() {
            $('#tombol').click(function() {
                const html5QrCode = new Html5Qrcode("reader");
                const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                    /* handle success */
                    console.log(`Scan result: ${decodedText}`, decodedResult);
                    // alert(decodedText);
                    html5QrCode.stop();
                    swal({
                        title: "Berhasil!",
                        text: "Berhasil tedeteksi!",
                        icon: "success",
                    });
                    window.location.href = "https://kpawarehousesistem.com/public/fgood/" +
                        decodedText + "/edit"
                };
                const config = {
                    fps: 10,
                    // qrbox: {
                    //     width: 150,
                    //     height: 150
                    // }
                };

                // If you want to prefer front camera
                html5QrCode.start({
                    facingMode: "environment"
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
            });

        });
    </script>
@endsection
