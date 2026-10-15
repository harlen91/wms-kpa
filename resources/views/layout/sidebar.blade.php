<!-- START SIDEBAR-->
<?php
$role = auth()->user()->akses;
if ($role == 'admin') { ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->nama }}</div><small>{{ auth()->user()->akses }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('home') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">
                Kelola Produk
            </li>
            <li>
                <a href="{{ route('benang') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Benang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roll') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Proses Keluar Barang
            </li>
            <li>
                <a href="{{ route('benang.keluar') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Keluar Benang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roll.keluar') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Keluar Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood.keluar') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Proses Retur Barang
            </li>
            <li>
                <a href="{{ route('benang.retur') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Retur Benang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roll.retur') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Retur Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood.retur') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Retur Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Scan QR Barang
            </li>
            <li>
                <a href="{{ route('roll.scan') }}"><i class="sidebar-item-icon fa fa-qrcode"></i>
                    <span class="nav-label">Scan Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood.scan') }}"><i class="sidebar-item-icon fa fa-qrcode"></i>
                    <span class="nav-label">Scan Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Kelola Data
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-wrench"></i>
                    <span class="nav-label">Master Data</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('spesifikasi') }}">Spesifikasi Benang</a>
                    </li>
                    <li>
                        <a href="{{ route('lotextruder') }}">Lot Extruder</a>
                    </li>
                    <li>
                        <a href="{{ route('kodebenang') }}">Kode Benang</a>
                    </li>
                    <li>
                        <a href="{{ route('specroll') }}">Spesifikasi Roll</a>
                    </li>
                    <li>
                        <a href="{{ route('machineloom') }}">Machine Loom</a>
                    </li>
                    <li>
                        <a href="{{ route('circularloom') }}">Circular Loom Roll</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('circularloomfg') }}">Circular Loom FG</a>
                        </li> --}}
                    <li>
                        <a href="{{ route('specproduk') }}">Spesifikasi Produk</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('warna') }}">Warna Jahitan Karung</a>
                        </li> --}}
                    {{-- <li>
                            <a href="{{ route('denier') }}">Denier Produk FG</a>
                </li>
                <li>
                    <a href="{{ route('densitas') }}">Densitas Produk FG</a>
                </li> --}}
                    <li>
                        <a href="{{ route('cutting') }}">Lot Cutting</a>
                    </li>
                    <li>
                        <a href="{{ route('ballpress') }}">Ball Press</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('users') }}"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users</span>
                </a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-folder-open"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('benang.laporan') }}">Data Benang</a>
                        <a href="{{ route('benang.history') }}">Data History Benang</a>
                        <a href="{{ route('roll.laporan') }}">Data Roll</a>
                        <a href="{{ route('roll.history') }}">Data History Roll</a>
                        <a href="{{ route('fgood.laporan') }}">Data Finish Good</a>
                        <a href="{{ route('fgood.history') }}">Data History Finish Good</a>
                        <a href="{{ route('benang.laporank') }}">Benang Keluar</a>
                        <a href="{{ route('roll.laporank') }}">Roll Keluar</a>
                        <a href="{{ route('fgood.laporank') }}">Finish Good Keluar</a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                    <a href="{{ route('roll.gagal') }}"><i class="sidebar-item-icon fa fa-recycle"></i>
                        <span class="nav-label">Recycle Bin Roll</span>
                    </a>
                </li> -->
        </ul>
    </div>
</nav>
<?php
} elseif ($role == "supervisor") { ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->nama }}</div><small>{{ auth()->user()->akses }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('home') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">
                Kelola Produk
            </li>
            <li>
                <a href="{{ route('benang') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Benang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roll') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Proses Keluar Barang
            </li>
            <li>
                <a href="{{ route('benang.keluar') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Keluar Benang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roll.keluar') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Keluar Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood.keluar') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Scan QR Barang
            </li>
            <li>
                <a href="{{ route('roll.scan') }}"><i class="sidebar-item-icon fa fa-qrcode"></i>
                    <span class="nav-label">Scan Roll</span>
                </a>
            </li>
            <li>
                <a href="{{ route('fgood.scan') }}"><i class="sidebar-item-icon fa fa-qrcode"></i>
                    <span class="nav-label">Scan Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Kelola Data
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-wrench"></i>
                    <span class="nav-label">Master Data</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('spesifikasi') }}">Spesifikasi Benang</a>
                    </li>
                    <li>
                        <a href="{{ route('lotextruder') }}">Lot Extruder</a>
                    </li>
                    <li>
                        <a href="{{ route('kodebenang') }}">Kode Benang</a>
                    </li>
                    <li>
                        <a href="{{ route('specroll') }}">Spesifikasi Roll</a>
                    </li>
                    <li>
                        <a href="{{ route('machineloom') }}">Machine Loom</a>
                    </li>
                    <li>
                        <a href="{{ route('circularloom') }}">Circular Loom Roll</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('circularloomfg') }}">Circular Loom FG</a>
                        </li> --}}
                    <li>
                        <a href="{{ route('specproduk') }}">Spesifikasi Produk</a>
                    </li>
                    {{-- <li>
                            <a href="{{ route('warna') }}">Warna Jahitan Karung</a>
                        </li> --}}
                    {{-- <li>
                            <a href="{{ route('denier') }}">Denier Produk FG</a>
                </li>
                <li>
                    <a href="{{ route('densitas') }}">Densitas Produk FG</a>
                </li> --}}
                    {{-- <li>
                    <a href="{{ route('cutting') }}">Lot Cutting</a>
                </li>
                <li>
                    <a href="{{ route('ballpress') }}">Ball Press</a>
                </li> --}}
                </ul>
            </li>
            <li>
                <a href="{{ route('users') }}"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users</span>
                </a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-folder-open"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('benang.laporan') }}">Data Benang</a>
                        <a href="{{ route('benang.history') }}">Data History Benang</a>
                        <a href="{{ route('roll.laporan') }}">Data Roll</a>
                        <a href="{{ route('roll.history') }}">Data History Roll</a>
                        <a href="{{ route('fgood.laporan') }}">Data Finish Good</a>
                        <a href="{{ route('fgood.history') }}">Data History Finish Good</a>
                        <a href="{{ route('benang.laporank') }}">Benang Keluar</a>
                        <a href="{{ route('roll.laporank') }}">Roll Keluar</a>
                        <a href="{{ route('fgood.laporank') }}">Finish Good Keluar</a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                    <a href="{{ route('roll.gagal') }}"><i class="sidebar-item-icon fa fa-recycle"></i>
                        <span class="nav-label">Recycle Bin Roll</span>
                    </a>
                </li> -->
        </ul>
    </div>
</nav>
<?php
} elseif ($role == 'user benang') { ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->nama }}</div><small>{{ auth()->user()->akses }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li class="heading">
                Kelola Produk
            </li>
            <li>
                <a href="{{ route('benang') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Benang</span>
                </a>
            </li>
            <li class="heading">
                Proses Keluar Barang
            </li>
            <li>
                <a href="{{ route('benang.keluar') }}"><i class="sidebar-item-icon fa fa-asterisk"></i>
                    <span class="nav-label">Keluar Benang</span>
                </a>
            </li>
            {{-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-folder-open"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('benang.laporan') }}">Data Benang</a>
                <a href="{{ route('benang.history') }}">Data History Benang</a>
                <a href="{{ route('benang.laporank') }}">Benang Keluar</a>
                </li>
            </ul>
            </li> --}}
        </ul>
    </div>
</nav>
<?php
} elseif ($role == 'user roll') { ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->nama }}</div><small>{{ auth()->user()->akses }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li class="heading">
                Kelola Produk
            </li>
            <li>
                <a href="{{ route('roll') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Roll</span>
                </a>
            </li>
            <li class="heading">
                Proses Keluar Barang
            </li>
            <li>
                <a href="{{ route('roll.keluar') }}"><i class="sidebar-item-icon fa fa-dot-circle-o"></i>
                    <span class="nav-label">Keluar Roll</span>
                </a>
            </li>
            {{-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-folder-open"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('roll.laporan') }}">Data Roll</a>
                <a href="{{ route('roll.history') }}">Data History Roll</a>
                <a href="{{ route('roll.laporank') }}">Roll Keluar</a>
                </li>
            </ul>
            </li> --}}
        </ul>
    </div>
</nav>
<?php
} elseif ($role == 'user fg') { ?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->nama }}</div><small>{{ auth()->user()->akses }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li class="heading">
                Kelola Produk
            </li>
            <li>
                <a href="{{ route('fgood') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            <li class="heading">
                Proses Keluar Barang
            </li>
            <li>
                <a href="{{ route('fgood.keluar') }}"><i
                        class="sidebar-item-icon fa Example of puzzle-piece fa-puzzle-piece"></i>
                    <span class="nav-label">Finish Good</span>
                </a>
            </li>
            {{-- <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-folder-open"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('fgood.laporan') }}">Data Finish Good</a>
                <a href="{{ route('fgood.history') }}">Data History Finish Good</a>
                <a href="{{ route('fgood.laporank') }}">Finish Good Keluar</a>
                </li>
            </ul>
            </li> --}}
        </ul>
    </div>
</nav>
<?php
}
?>

<!-- END SIDEBAR-->
