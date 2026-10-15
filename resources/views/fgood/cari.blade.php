<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finish Good Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid px-5 py-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Data Finish Good Keluar</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                {{-- <th>Circular Loom</th>
                                <th>Lot Cutting</th>
                                <th>Lot Ball Press</th> --}}
                                <th>Spesifikasi Produk</th>
                                <th>Densitas</th>
                                <th>Denier</th>
                                {{-- <th>Jlh Ikatan/Ikat</th> --}}
                                <th>Jlh Ikatan/Ball</th>
                                {{-- <th>Jlh Tekukan/Ikat</th> --}}
                                {{-- <th>Jlh Tali/Ikat</th> --}}
                                {{-- <th>Warna Jahitan Karung</th> --}}
                                {{-- <th>Jumlah Jahitan Karung/10 cm</th> --}}
                                {{-- <th>Panjang Ekor Jahitan</th> --}}
                                <th>Panjang Produk</th>
                                <th>Lebar Produk</th>
                                <th>Angka Densitas Produk</th>
                                <th>Angka Denier Produk</th>
                                <th>Berat Lembar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($finish as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama . '/' . $row->shift }}</td>
                                    {{-- <td>{{ $row->nama_circular . '/' . $row->tgl_fg . '/' . $row->id . '/' . $row->shift }}
                                    </td>
                                    <td>{{ $row->nama_cutting . '/' . $row->tgl_fg . '/' . $row->id . '/' . $row->shift }}
                                    </td>
                                    <td>{{ $row->nama_ballpress . '/' . $row->tgl_fg . '/' . $row->id . '/' . $row->shift }}
                                    </td> --}}
                                    <td>{{ $row->nama_specproduk }}</td>
                                    <td>{{ $row->nama_densitasproduk }}</td>
                                    <td>{{ $row->nama_denierproduk }}</td>
                                    {{-- <td>{{ $row->jumlah_ikatan_perikat }}</td> --}}
                                    <td>{{ $row->jumlah_ikatan_perball }}</td>
                                    {{-- <td>{{ $row->jumlah_tekukan_perikat }}</td> --}}
                                    {{-- <td>{{ $row->jumlah_tali_perikat }}</td> --}}
                                    {{-- <td>{{ $row->nama_warna }}</td> --}}
                                    {{-- <td>{{ $row->jumlah_jahitan_karung_10 }}</td>
                                    <td>{{ $row->panjang_ekor_jahitan }}</td> --}}
                                    <td>{{ $row->panjang_produk }}</td>
                                    <td>{{ $row->lebar_produk }}</td>
                                    <td>{{ $row->angka_densitas_produk }}</td>
                                    <td>{{ $row->angka_denier_produk }}</td>
                                    <td>{{ number_format($row->berat_lembar, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('fgood.keluar') }}" class="btn btn-success mt-3">Kembali</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
