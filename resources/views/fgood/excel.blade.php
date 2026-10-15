<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Tgl</th>
            <th>jam</th>
            <th>Spesifikasi Produk</th>
            <th>Densitas</th>
            <th>Denier</th>
            <th>Brutto</th>
            <th>Jumlah Lembar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama . '/' . $row->shift }}</td>
                <td>{{ $row->tgl_fg }}</td>
                <td>{{ $row->jam_fg }}</td>
                <td>{{ $row->nama_specproduk . ' ' . $row->lebar . 'x' . $row->panjang }}</td>
                <td>{{ $row->densitas }}</td>
                <td>{{ $row->denier }}</td>
                <td>{{ $row->brutto }}</td>
                <td>{{ $row->jumlah_ikatan_perball }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
