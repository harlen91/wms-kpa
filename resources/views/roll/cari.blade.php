<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roll Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid px-5 py-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Data Roll Keluar</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                <th>Petugas Timbang</th>
                                <th>Operator ML</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Spek Benang</th>
                                <th>Lot Ext</th>
                                <th>Spek Roll</th>
                                <th>Denier</th>
                                <th>Densitas</th>
                                <th>No Lot Circular Loom</th>
                                <th>Lebar Standart Roll</th>
                                <th>Lebar Aktual Roll</th>
                                <th>Panjang Standart Roll</th>
                                <th>Panjang Aktual Roll</th>
                                <th>Berat Standart/Meter</th>
                                <th>Berat Standart/Roll</th>
                                <th>Paper Core</th>
                                <th>Netto</th>
                                <th>Brutto</th>
                                <th>Hasil Perkalian</th>
                                <th>Range Berat Masuk(0% - 3%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roll as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->petugas_timbang }}</td>
                                    <td>{{ $row->operator_ml }}</td>
                                    <td>{{ $row->tgl_roll }}</td>
                                    <td>{{ $row->jam_roll }}</td>
                                    <td>{{ $row->kode_benang }}</td>
                                    <td>{{ $row->lotextruder }}</td>
                                    <td>{{ $row->kode_roll . 'x' . $row->lebar . 'x' . $row->densitas . 'x' . $row->densitas }}
                                    </td>
                                    <td>{{ $row->denier }}</td>
                                    <td>{{ $row->densitas }}</td>
                                    <td>{{ $row->nama_circular . '/' . $row->tgl_roll . '/' . $row->shift . '/' . $row->nomor_circular }}
                                    </td>
                                    <td>{{ $row->lebar_standart_roll }}</td>
                                    <td>{{ $row->lebar_aktual_roll }}</td>
                                    <td>{{ $row->panjang_standart_roll }}</td>
                                    <td>{{ $row->panjang_aktual_roll }}</td>
                                    <td>{{ $row->berat_standart_meter }}</td>
                                    <td>{{ $row->berat_standart_roll }}</td>
                                    <td>{{ $row->paper_core }}</td>
                                    <td>{{ $row->netto }}</td>
                                    <td>{{ $row->brutto }}</td>
                                    <td>{{ $row->hasil_perkalian }}</td>
                                    <td>{{ $row->range_berat_masuk_0 . '-' . $row->range_berat_masuk_3 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <a href="{{ route('roll.keluar') }}" class="btn btn-success mt-3">Kembali</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
