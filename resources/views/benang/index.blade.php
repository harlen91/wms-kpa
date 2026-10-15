<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #c7edff;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Data Benang')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        @if (session()->has('success'))
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            </script>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Data Benang
                </div>
                <div class="card-body">
                    <div style="overflow-x: scroll;">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Benang</th>
                                    <th>Spesifikasi</th>
                                    <th>Lot Extruder</th>
                                    <th>Qty</th>
                                    <th>Tgl</th>
                                    <th>Jam</th>
                                    <th>User</th>
                                    <th>Jumlah Keranjang</th>
                                    <th>Total Bobin Per Palet</th>
                                    <th>Brutto</th>
                                    <th>Netto</th>
                                    <th>NP</th>
                                    <th>Aktual</th>
                                    <th>Perintah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($benang as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kode_benang }}</td>
                                        <td>{{ $data->nama_spesifikasi }}</td>
                                        <td>{{ $data->nama_lotextruder . $data->nomor_lotextruder . '/' . str_replace('-', '/', $data->tgl_benang) . '/' . $data->shift . '/' . $data->no_palet }}
                                        </td>
                                        <td>{{ $data->qty_benang }}</td>
                                        <td>{{ $data->tgl_benang }}</td>
                                        <td>{{ $data->jam_benang }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->jumlah_keranjang_palet }}</td>
                                        <td>{{ $data->total_banyakbobin_palet }}</td>
                                        <td>{{ $data->bruto }}</td>
                                        <td>{{ number_format($data->neto, 2) }}</td>
                                        <td>{{ $data->no_palet }}</td>
                                        <td>{{ number_format($data->berat_aktual, 3) }}</td>
                                        <td>
                                            <form action="{{ route('benang.destroy', $data->id_benang) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (auth()->user()->akses == 'admin')
                                                    <button class="btn btn-outline-danger mb-3"
                                                        onclick="return confirm('Yakin Dihapus?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('benang.edit', $data->id_benang) }}"
                                                        class="btn btn-outline-info mb-3">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('benang.show', $data->id_benang) }}" target="blank"
                                                    class="btn btn-outline-warning mb-3">
                                                    <i class="fa fa-print" aria-hidden="true"></i> ID Benang
                                                </a>
                                                <a href="{{ route('benang.cetak', $data->id_benang) }}" target="blank"
                                                    class="btn btn-outline-success">
                                                    <i class="fa fa-print" aria-hidden="true"></i> ID Palet
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('benang.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Benang
                    </a>
                    <a href="{{ route('benang.keluar') }}" class="btn btn-warning"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i>
                        Proses Benang Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
