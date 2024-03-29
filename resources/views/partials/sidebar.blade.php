<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Master Data</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pegawai.index') }}">
                <i class="mdi mdi-human-male-female menu-icon"></i>
                <span class="menu-title">Data Pegawai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spt.index') }}">
                <i class="mdi mdi-file-multiple menu-icon"></i>
                <span class="menu-title">Data SPT</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sppd.index') }}">
                <i class="mdi mdi-file-multiple menu-icon"></i>
                <span class="menu-title">Data SPPD</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laporan Data</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.lap_spt') }}">
                <i class="mdi mdi-folder-multiple menu-icon"></i>
                <span class="menu-title">SPT</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.lap_sppd') }}">
                <i class="mdi mdi-folder-multiple menu-icon"></i>
                <span class="menu-title">SPPD</span>
            </a>
        </li>
        <li class="nav-item nav-category">Master Setting</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('instansi.index') }}">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Data Instansi</span>
            </a>
        </li>
    </ul>
</nav>
