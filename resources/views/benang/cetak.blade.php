<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body style="padding: 0; margin:0;">

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
    <table cellpadding="1" cellspacing="0" border="1" style="width: 384px; height:384px;">
        <tr>
            <td colspan="4">
                <center>
                    <img src="{{ asset('logo.jpg') }}" alt="" width="130">
                </center>

            </td>
            <td colspan="5" style="text-align: center;">
                ID PALLET BENANG
            </td>
        </tr>

        <tr>
            <td colspan="4">Lot Ext.</td>
            <td colspan="5">
                {{ $benang[0]->nama_lotextruder . '/' . str_replace('-', '/', $benang[0]->tgl_benang) . '/' . $benang[0]->shift . '/' . $benang[0]->no_palet }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Spesifikasi
            </td>
            <td colspan="5">
                {{ $benang[0]->kode_benang }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Netto
            </td>
            <td colspan="5">
                {{ number_format($benang[0]->neto, 2) }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Bruto
            </td>
            <td colspan="5">
                {{ number_format($benang[0]->bruto, 2) }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                No. Pallet
            </td>
            <td colspan="3">
                {{ $benang[0]->no_palet }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Berat Pallet
            </td>
            <td colspan="3">
                {{ $benang[0]->berat_palet }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Jumlah Bobin per Keranjang
            </td>
            <td colspan="3">
                {{ $benang[0]->banyak_bobin_keranjang }}
            </td>
        </tr>
        <tr>
            <td colspan="6" style="height: 100px;"></td>
            <td colspan="3" rowspan="3">
                <center>
                    <img src="{{ $benang[0]->qrcode }}" style="height: 130px; width:100px;">
                </center>
            </td>
        </tr>
        <tr>
            <td>User</td>
            <td>{{ $benang[0]->nama }}</td>
            <td>Shift</td>
            <td>{{ $benang[0]->shift }}</td>
            <td>Jam</td>
            <td>{{ $benang[0]->jam_benang }}</td>
        </tr>
        {{-- <tr>
            <td>User</td>
            <td>{{ $benang[0]->nama }}</td>
        <td>Shift</td>
        <td>{{ $benang[0]->shift }}</td>
        <td>Jam</td>
        <td colspan="4">{{ substr($benang[0]->created_at, 11, 8) }}</td>
        </tr> --}}
        <tr>
            <td>Hari</td>
            <td>{{ $dayList[date('D', strtotime($benang[0]->tgl_benang))] }}</td>
            <td>Tanggal</td>
            <td colspan="3">{{ $benang[0]->tgl_benang }}</td>
        </tr>
    </table>
    <br><br>
</body>

</html>
