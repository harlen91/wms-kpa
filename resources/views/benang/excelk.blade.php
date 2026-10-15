<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Benang</th>
            <th>Spesifikasi</th>
            <th>Lot Extruder</th>
            <th>Qty</th>
            <th>User</th>
            <th>Tgl Masuk</th>
            <th>Jam Masuk</th>
            <th>Tgl Keluar</th>
            <th>Jam Keluar</th>
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
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->kode_benang }}</td>
                <td>{{ $row->nama_spesifikasi }}</td>
                <td>{{ $row->nama_lotextruder . $row->nomor_lotextruder . '/' . str_replace('-', '/', $row->tgl_benang) . '/' . $row->shift . '/' . $row->no_palet }}
                </td>
                <td>{{ $row->qty_benang }}</td>
                <td>{{ $row->nama . '/' . $row->shift }}</td>
                <td>{{ $row->tgl_benang }}</td>
                <td>{{ $row->jam_benang }}</td>
                <td>{{ $row->tgl_keluar }}</td>
                <td>{{ $row->jam_keluar }}</td>
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
