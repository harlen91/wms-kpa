<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>User</th>
            <th>Petugas Timbang</th>
            <th>Operator ML</th>
            <th>Tanggal Masuk</th>
            <th>Jam Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Jam Keluar</th>
            <th>Spek Benang</th>
            <th>Lot Ext</th>
            <th>Spek Roll</th>
            <th>Denier</th>
            <th>Densitas</th>
            <th>No Machine Loom</th>
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
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->petugas_timbang }}</td>
                <td>{{ $row->operator_ml }}</td>
                <td>{{ $row->tgl_roll }}</td>
                <td>{{ $row->jam_roll }}</td>
                <td>{{ $row->tgl_keluar }}</td>
                <td>{{ $row->jam_keluar }}</td>
                <td>{{ $row->kode_benang }}</td>
                <td>{{ $row->lotextruder }}
                </td>
                <td>{{ $row->kode_roll . 'x' . $row->lebar . 'x' . $row->densitas . 'x' . $row->densitas }}
                </td>
                <td>{{ $row->denier }}</td>
                <td>{{ $row->densitas }}</td>
                <td>{{ $row->nama_machineloom }}</td>
                <td>{{ $row->nama_circular . '/' . $row->tgl_roll . '/' . $row->shift . '/' . $row->nama_machineloom }}
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
