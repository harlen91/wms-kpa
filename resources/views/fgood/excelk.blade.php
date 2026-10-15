<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Spesifikasi Produk</th>
            <th>Densitas</th>
            <th>Denier</th>
            <th>Tanggal Masuk</th>
            <th>Jam Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Jam Keluar</th>
            <th>Brutto</th>
            <th>Jumlah Lembar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama . '/' . $row->shift }}</td>
                <td>{{ $row->nama_specproduk . ' ' . $row->lebar . 'x' . $row->panjang }}</td>
                <td>{{ $row->densitas }}</td>
                <td>{{ $row->denier }}</td>
                <td>{{ $row->tgl_fg }}</td>
                <td>{{ $row->jam_fg }}</td>
                <td>{{ $row->tgl_keluar }}</td>
                <td>{{ $row->jam_keluar }}</td>
                <td>{{ $row->brutto }}</td>
                <td>{{ $row->jumlah_ikatan_perball }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
