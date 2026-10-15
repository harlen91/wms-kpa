<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Benang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid px-5 py-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Data Benang Keluar</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Benang</th>
                                <th>Spesifikasi</th>
                                <th>Lot Extruder</th>
                                <th>Qty</th>
                                <th>User</th>
                                <th>Tgl</th>
                                <th>Jam</th>
                                <th>User</th>
                                <th>Bruto</th>
                                <th>Berat Pallet</th>
                                <th>Berat Keranjang/Satuan</th>
                                <th>Jumlah Keranjang/Pallet</th>
                                <th>Total Berat Keranjang/Pallet</th>
                                <th>Berat Satuan Bobin</th>
                                <th>Banyak Bobin/Keranjang</th>
                                <th>Total Banyak Bobin/Pallet</th>
                                <th>Total Berat Bobin/Pallet</th>
                                <th>Neto</th>
                                <th>Nomor Pallet</th>
                                <th>Berat Aktual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($benang as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->kode_benang }}</td>
                                <td>{{ $row->nama_spesifikasi }}</td>
                                <td>{{ $row->nama_lotextruder . '/' . str_replace('-', '/', $row->tgl_benang) . '/' . $row->shift }}
                                </td>
                                <td>{{ $row->qty_benang }}</td>
                                <td>{{ $row->nama . '/' . $row->shift }}</td>
                                <td>{{ $row->tgl_benang }}</td>
                                <td>{{ $row->jam_benang }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->bruto }}</td>
                                <td>{{ $row->berat_palet }}</td>
                                <td>{{ $row->berat_keranjang_satuan }}</td>
                                <td>{{ $row->jumlah_keranjang_palet }}</td>
                                <td>{{ $row->total_berat_keranjang_palet }}</td>
                                <td>{{ $row->berat_bobin_satuan }}</td>
                                <td>{{ $row->banyak_bobin_keranjang }}</td>
                                <td>{{ $row->total_banyakbobin_palet }}</td>
                                <td>{{ $row->total_beratbobin_palet }}</td>
                                <td>{{ number_format($row->neto, 2) }}</td>
                                <td>{{ $row->no_palet }}</td>
                                <td>{{ number_format($row->berat_aktual, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('benang.keluar') }}" class="btn btn-success mt-3">Kembali</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>