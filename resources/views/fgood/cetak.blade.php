<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: "Angsana UPC";
        }
    </style>
</head>

<body>

    <?php
    $dayList = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu',
    ];
    
    ?>
    <table cellpadding="1" cellspacing="0" border="1" style="width: 350px; height:226px;">
        <tr>
            <td colspan="2" style="text-align: center; font-size: 12px;">
                Product Spesification ID
            </td>

        </tr>
        {{-- <tr>
            <td style="text-align: center;">
                {{ $finish[0]->jumlah_ikatan_perball }} Lembar
            </td>
            <td></td>
        </tr> --}}
        <tr>
            <td rowspan="3" style="text-align: center; padding: 0px;">
                <center>
                    <img src="{{ $finish[0]->qr_fg }}" style="height: 100%; width: 150px;">
                </center>
            </td>
            <td style="padding: 0px;">
                <img src="{{ asset('halal.png') }}" style="float: right;" width="30" height="30">
            </td>
        </tr>
        <tr style="font-size: 12px;">
            <td>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>Product Name</td>
                        <td>:</td>
                        <td>{{ $finish[0]->nama_specproduk . ' ' . $finish[0]->lebar . 'x' . $finish[0]->panjang }}</td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>:</td>
                        <td> {{ $finish[0]->jumlah_ikatan_perball }}</td>
                    </tr>
                    <tr>
                        <td>LOT Product</td>
                        <td>:</td>
                        <td>{{ $finish[0]->lot_ball_press }}</td>
                    </tr>
                </table>


            </td>
        </tr>
        <tr>
            <td style="font-style:italic; font-size: 10px; text-align: right;">
                Do Not Copy Product ID
            </td>
        </tr>
    </table>
    <br><br>
</body>

</html>
