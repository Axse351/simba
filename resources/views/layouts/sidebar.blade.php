<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        {{-- BRAND --}}
        <div class="sidebar-brand">
            <a href="#">POSYANDU</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">PS</a>
        </div>

        <ul class="sidebar-menu">

            {{-- ================= BIDAN ================= --}}
            @if (auth()->user()->role === 'bidan')
                <li class="menu-header">BIDAN</li>

                <li class="{{ request()->routeIs('bidan.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bidan.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- nanti bisa ditambah --}}
                {{-- Data Pemeriksaan --}}
                {{-- Grafik Pertumbuhan --}}
            @endif


            {{-- ================= PETUGAS DESA ================= --}}
            @if (auth()->user()->role === 'petugas_desa')
                <li class="menu-header">PETUGAS DESA</li>

                <li class="{{ request()->routeIs('desa.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('desa.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- MASTER DATA --}}
                <li class="dropdown {{ request()->is('desa/warga*', 'desa/anak*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-database"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="{{ request()->is('desa/warga*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('desa.warga.index') }}">
                                <i class="fas fa-female"></i>
                                Data Warga (Ibu)
                            </a>
                        </li>

                        <li class="{{ request()->is('desa/anak*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('desa.anak.index') }}">
                                <i class="fas fa-baby"></i>
                                Data Anak
                            </a>
                        </li>

                    </ul>
                </li>
            @endif


            {{-- ================= USER / WARGA ================= --}}
            @if (auth()->user()->role === 'user')
                <li class="menu-header">WARGA</li>

                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- nanti --}}
                {{-- Riwayat Anak --}}
                {{-- Jadwal Posyandu --}}
            @endif

        </ul>

    </aside>
</div>
