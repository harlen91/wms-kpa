<style>
    /* KPI Cards Styling */
    .kpi-card {
        border: none;
        border-radius: 16px;
        color: #fff;
        padding: 24px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    .kpi-card .kpi-icon {
        position: absolute;
        right: 20px;
        bottom: 10px;
        font-size: 70px;
        opacity: 0.18;
        transition: transform 0.3s ease;
    }
    .kpi-card:hover .kpi-icon {
        transform: scale(1.1) rotate(-5deg);
    }
    .kpi-card .kpi-value {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .kpi-card .kpi-label {
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        opacity: 0.9;
    }
    .kpi-card .kpi-subtext {
        font-size: 11px;
        opacity: 0.75;
        margin-top: 8px;
    }
    
    /* Gradients */
    .bg-gradient-yarn {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
    }
    .bg-gradient-roll {
        background: linear-gradient(135deg, #0d9488 0%, #10b981 100%);
    }
    .bg-gradient-fg {
        background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%);
    }

    /* Box & Layout Styling */
    .ibox {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
        background: #fff;
    }
    .ibox-head {
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 15px 20px !important;
    }
    .ibox-title {
        font-weight: 600 !important;
        color: #1e293b !important;
        font-size: 15px !important;
    }
    .table thead th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #cbd5e1 !important;
        padding: 12px 10px !important;
    }
    .table tbody td {
        padding: 12px 10px !important;
        vertical-align: middle !important;
    }
    
    /* Custom Striped Colors for Stock Tables */
    .table-biru tbody tr:nth-of-type(odd) {
        background-color: #f0f7ff;
    }
    .table-hijau tbody tr:nth-of-type(odd) {
        background-color: #f0fdf4;
    }
    .table-orange tbody tr:nth-of-type(odd) {
        background-color: #fffbeb;
    }

    /* Recent Activities */
    .activity-item {
        padding: 12px 20px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-details {
        display: flex;
        flex-direction: column;
    }
    .activity-title {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }
    .activity-time {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 2px;
    }
    .activity-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>

@extends('layout.dashboard')
@section('title', 'Dashboard')
@section('content')
    @if (session()->has('error'))
        <script>
            swal({
                title: "Berhasil!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif

    <div class="row">
        @php
            use App\Models\Benang;
            use App\Models\FinishGood;
            use App\Models\Roll;
            use App\Models\Spesifikasi;
            use App\Models\KeluarBenang;
            use App\Models\KeluarRoll;
            use App\Models\KeluarFinishGood;
        @endphp
    </div>

    <!-- Row KPI Summary Cards -->
    <div class="row">
        <!-- Yarn KPI Card -->
        <div class="col-lg-4 col-md-6">
            <div class="kpi-card bg-gradient-yarn">
                <div class="kpi-icon"><i class="fa fa-cubes"></i></div>
                <div class="kpi-label">Stok Benang</div>
                <div class="kpi-value">{{ number_format($card_yarn_weight, 2, ',', '.') }} Kg</div>
                <div class="kpi-subtext"><i class="fa fa-hdd-o"></i> Total Palet: <strong>{{ $card_yarn_palets }}</strong></div>
            </div>
        </div>
        
        <!-- Roll KPI Card -->
        <div class="col-lg-4 col-md-6">
            <div class="kpi-card bg-gradient-roll">
                <div class="kpi-icon"><i class="fa fa-database"></i></div>
                <div class="kpi-label">Stok Roll</div>
                <div class="kpi-value">{{ number_format($card_roll_count, 0, ',', '.') }} Pcs</div>
                <div class="kpi-subtext"><i class="fa fa-balance-scale"></i> Total Berat: <strong>{{ number_format($card_roll_weight, 2, ',', '.') }} Kg</strong></div>
            </div>
        </div>

        <!-- Finish Good KPI Card -->
        <div class="col-lg-4 col-md-6">
            <div class="kpi-card bg-gradient-fg">
                <div class="kpi-icon"><i class="fa fa-check-circle"></i></div>
                <div class="kpi-label">Stok Finish Good</div>
                <div class="kpi-value">{{ number_format($card_fg_count, 0, ',', '.') }} Ball</div>
                <div class="kpi-subtext"><i class="fa fa-balance-scale"></i> Total Berat: <strong>{{ number_format($card_fg_weight, 2, ',', '.') }} Kg</strong></div>
            </div>
        </div>
    </div>

    <!-- Row Charts -->
    <div class="row">
        <!-- Chart Benang -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-pie-chart text-primary"></i> Sebaran Stok Benang (Kg)</div>
                </div>
                <div class="ibox-body">
                    <div style="height: 250px; position: relative;">
                        <canvas id="yarnChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Roll -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-pie-chart text-success"></i> Sebaran Stok Roll (Pcs)</div>
                </div>
                <div class="ibox-body">
                    <div style="height: 250px; position: relative;">
                        <canvas id="rollChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Finish Good -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-pie-chart text-danger"></i> Sebaran Stok Finish Good (Kg)</div>
                </div>
                <div class="ibox-body">
                    <div style="height: 250px; position: relative;">
                        <canvas id="fgChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Aktivitas Terbaru -->
    <div class="row mb-4">
        <!-- Recent Yarn -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-history text-primary"></i> Input Benang Terbaru</div>
                </div>
                <div class="ibox-body" style="padding: 10px 0;">
                    @forelse($recent_yarn as $item)
                        <div class="activity-item">
                            <div class="activity-details">
                                <span class="activity-title">{{ $item->kode_benang }} (Palet {{ $item->no_palet }})</span>
                                <span class="activity-time">{{ date('d/m/Y', strtotime($item->tgl_benang)) }} - {{ $item->jam_benang }}</span>
                            </div>
                            <span class="badge badge-primary activity-badge">{{ number_format($item->neto, 2, ',', '.') }} Kg</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">Tidak ada aktivitas baru</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Roll -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-history text-success"></i> Input Roll Terbaru</div>
                </div>
                <div class="ibox-body" style="padding: 10px 0;">
                    @forelse($recent_roll as $item)
                        <div class="activity-item">
                            <div class="activity-details">
                                <span class="activity-title">{{ $item->kode_roll }} {{ $item->lebar }}x{{ $item->densitas }}</span>
                                <span class="activity-time">{{ date('d/m/Y', strtotime($item->tgl_roll)) }} - {{ $item->jam_roll }}</span>
                            </div>
                            <span class="badge badge-success activity-badge">{{ number_format($item->netto, 2, ',', '.') }} Kg</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">Tidak ada aktivitas baru</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Finish Good -->
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-history text-danger"></i> Input FG Terbaru</div>
                </div>
                <div class="ibox-body" style="padding: 10px 0;">
                    @forelse($recent_fg as $item)
                        <div class="activity-item">
                            <div class="activity-details">
                                <span class="activity-title">{{ $item->nama_specproduk }} (Lot: {{ $item->lot_ball_press }})</span>
                                <span class="activity-time">{{ date('d/m/Y', strtotime($item->tgl_fg)) }} - {{ $item->jam_fg }}</span>
                            </div>
                            <span class="badge badge-danger activity-badge">{{ number_format($item->brutto, 2, ',', '.') }} Kg</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">Tidak ada aktivitas baru</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Original Detailed Stock Tables -->
    <div class="row">
        <!-- Stok Benang Table -->
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-cubes text-primary"></i> Detail Rincian Stok Benang</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-bordered table-hover table-biru" id="example-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Benang</th>
                                <th>Total Berat</th>
                                <th>Total Jumlah Palet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kodebenang as $data)
                                @php
                                    $agg = $yarn_aggregates->get($data->id_kodebenang);
                                    $x = $agg ? $agg->total_neto : 0;
                                    $paletmasuk = $agg ? $agg->palet_count : 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode_benang }}</td>
                                    <td>{{ number_format($x, 2, ',', '.') }} Kg</td>
                                    <td>{{ $paletmasuk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Stok Roll Table -->
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-database text-success"></i> Detail Rincian Stok Roll</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-bordered table-hover table-hijau" id="example-table2" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Spesifikasi Roll</th>
                                <th>Total Roll</th>
                                <th>Total Panjang Roll</th>
                                <th>Total Berat Roll</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specroll as $data)
                                @php
                                    $agg = $roll_aggregates->get($data->id_specroll);
                                    $x = $agg ? $agg->total_netto : 0;
                                    $panjangrollmasuk = $agg ? $agg->total_panjang : 0;
                                    $banyakrollmasuk = $agg ? $agg->roll_count : 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kode_roll . ' ' . $data->lebar . 'x' . $data->densitas . 'x' . $data->densitas }}</td>
                                    <td>{{ $banyakrollmasuk }} Pcs</td>
                                    <td>{{ $panjangrollmasuk }}</td>
                                    <td>{{ number_format($x, 2, ',', '.') }} Kg</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Stok Finish Good Table -->
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-check-circle text-danger"></i> Detail Rincian Stok Finish Good</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-bordered table-hover table-orange" id="example-table3" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Spesifikasi Produk</th>
                                <th>Total Jumlah Ball</th>
                                <th>Total Jumlah Lembar</th>
                                <th>Total Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specproduk as $data)
                                @php
                                    $agg = $fg_aggregates->get($data->id_specproduk);
                                    $banyak = $agg ? $agg->ball_count : 0;
                                    $x = $agg ? $agg->total_brutto : 0;
                                    $jumlahlembar = $agg ? $agg->total_lembar : 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_specproduk . ' ' . $data->lebar . 'x' . $data->panjang }}</td>
                                    <td>{{ $banyak }}</td>
                                    <td>{{ $jumlahlembar }}</td>
                                    <td>{{ number_format($x, 2, ',', '.') }} Kg</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Library and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart Benang
            const yarnCtx = document.getElementById('yarnChart').getContext('2d');
            new Chart(yarnCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($yarn_labels) !!},
                    datasets: [{
                        data: {!! json_encode($yarn_data) !!},
                        backgroundColor: [
                            '#4f46e5', '#3b82f6', '#6366f1', '#60a5fa', '#93c5fd', '#c7d2fe'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });

            // Chart Roll
            const rollCtx = document.getElementById('rollChart').getContext('2d');
            new Chart(rollCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($roll_labels) !!},
                    datasets: [{
                        data: {!! json_encode($roll_data) !!},
                        backgroundColor: [
                            '#0d9488', '#10b981', '#14b8a6', '#34d399', '#6ee7b7', '#a7f3d0'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });

            // Chart Finish Good
            const fgCtx = document.getElementById('fgChart').getContext('2d');
            new Chart(fgCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($fg_labels) !!},
                    datasets: [{
                        data: {!! json_encode($fg_data) !!},
                        backgroundColor: [
                            '#e11d48', '#f43f5e', '#fb7185', '#fda4af', '#fecdd3', '#ffe4e6'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
