<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
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
    <table cellpadding="1" cellspacing="0" border="1" style="width: 384px; height:384px;">
        <tr>
            <td colspan="4">
                <center>
                    <img src="{{ asset('logo.jpg') }}" alt="" width="130">
                </center>

            </td>
            <td colspan="5" style="text-align: center;">
                ID Roll
            </td>
        </tr>

        <tr>
            <td colspan="4">Lot Ext.</td>
            <td colspan="5">
                {{ $roll[0]->lotextruder }}
            </td>
        </tr>
        <tr>
            <td colspan="4">No Machine Loom</td>
            <td colspan="5">
                {{ $roll[0]->nama_machineloom }}
            </td>
        </tr>
        <tr>
            <td colspan="4">No Circular Loom</td>
            <td colspan="5">
                {{ $roll[0]->nama_circular . '/' . $roll[0]->tgl_roll . '/' . $roll[0]->shift . '/' . $roll[0]->nama_machineloom }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Spesifikasi Roll
            </td>
            <td colspan="5">
                {{ $roll[0]->kode_roll . ' ' . $roll[0]->lebar . 'x' . $roll[0]->densitas . 'x' . $roll[0]->densitas . ' ' . $roll[0]->kode_benang }}
            </td>
        </tr>
        <tr>
            <td rowspan="3" style="text-align: center;">Berat</td>
            <td colspan="3">
                B.S Roll
            </td>
            <td colspan="3">
                {{ $roll[0]->berat_standart_roll }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                P.A Roll
            </td>
            <td colspan="5">
                {{ $roll[0]->panjang_aktual_roll }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Brutto
            </td>
            <td colspan="5">
                {{ $roll[0]->brutto }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Berat Aktual/Roll
            </td>
            <td colspan="5">
                {{ $roll[0]->netto }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                R.B.M(-3%)-(0%)
            </td>
            <td colspan="5">
                {{ $roll[0]->range_berat_masuk_3 . ' - ' . $roll[0]->range_berat_masuk_0 }}
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Status
            </td>
            <td colspan="2">
                {{ $roll[0]->catatan }}
            </td>
            <td colspan="3" rowspan="4">
                <center>
                    <img src="{{ $roll[0]->qrcode_roll }}" style="height: 130px; width:100px;">
                </center>
            </td>
        </tr>
        <tr>
            <td>User</td>
            <td>{{ $roll[0]->nama }}</td>
            <td>Shift</td>
            <td>{{ $roll[0]->shift }}</td>
            <td>Jam</td>
            <td>{{ $roll[0]->jam_roll }}</td>
        </tr>
        <tr>
            <td>Hari</td>
            <td>{{ $dayList[date('D', strtotime($roll[0]->tgl_roll))] }}</td>
            <td>Tanggal</td>
            <td colspan="3">{{ $roll[0]->tgl_roll }}</td>
        </tr>
    </table>
    <br><br>
</body>

</html>
