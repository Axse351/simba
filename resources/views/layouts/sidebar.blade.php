<style>
    /* Spasi submenu sidebar */
    .sidebar-menu .dropdown-menu li a {
        padding: 10px 20px;
        line-height: 1.6;
    }

    .sidebar-menu .dropdown-menu li {
        margin-bottom: 4px;
    }

    .sidebar-menu .dropdown-menu li a i {
        margin-right: 10px;
    }
</style>
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

                {{-- DATA KMS --}}
                <li class="dropdown {{ request()->is('bidan/kms-*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-notes-medical"></i>
                        <span>Data KMS</span>
                    </a>

                    <ul class="dropdown-menu">

                        <li class="{{ request()->routeIs('bidan.kms-ibu.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kms-ibu.index') }}">
                                <i class="fas fa-female"></i>
                                KMS Ibu
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('bidan.kms-anak.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kms-anak.index') }}">
                                <i class="fas fa-baby"></i>
                                KMS Anak
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown {{ request()->is('bidan/warga*', 'bidan/anak*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-database"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="{{ request()->routeIs('bidan.warga.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('bidan.warga.index') }}">
                                <i class="fas fa-female"></i>
                                Data Ibu
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('bidan.anak.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('bidan.anak.index') }}">
                                <i class="fas fa-baby"></i>
                                Data Anak
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="{{ request()->routeIs('artikel.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('artikel.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Artikel Kesehatan</span>
                    </a>
                </li>
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
                {{-- JADWAL POSYANDU --}}
                <li class="dropdown {{ request()->is('desa/jadwal-posyandu*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Posyandu</span>
                    </a>

                    <ul class="dropdown-menu">

                        <li class="{{ request()->routeIs('desa.jadwal-posyandu.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('desa.jadwal-posyandu.index') }}">
                                <i class="fas fa-list"></i>
                                Kelola Jadwal
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('desa.jadwal-posyandu.rekap') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('desa.jadwal-posyandu.rekap') }}">
                                <i class="fas fa-chart-bar"></i>
                                Rekap Kehadiran Bulanan
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

                <li class="{{ request()->routeIs('user.artikel.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.artikel.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Artikel Kesehatan</span>
                    </a>
                </li>

                <li class="menu-header">LAYANAN</li>

                {{-- CHATBOT - Klik untuk buka chat --}}
                <li>
                    <a class="nav-link chatbot-trigger" href="javascript:void(0);">
                        <i class="fas fa-robot"></i>
                        <span>Asisten Kesehatan</span>
                        <span class="badge badge-primary">AI</span>
                    </a>
                </li>
            @endif

        </ul>

    </aside>
</div>

{{-- Script untuk trigger chatbot --}}
@if (auth()->user()->role === 'user')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trigger chatbot saat link di sidebar diklik
    const chatbotTrigger = document.querySelector('.chatbot-trigger');

    if (chatbotTrigger) {
        chatbotTrigger.addEventListener('click', function(e) {
            e.preventDefault();

            // Tunggu sebentar untuk memastikan chatbot widget sudah dimuat
            setTimeout(function() {
                const chatbotToggle = document.getElementById('chatbot-toggle');
                const chatbotWindow = document.getElementById('chatbot-window');

                if (chatbotToggle && chatbotWindow) {
                    // Toggle chatbot window
                    if (chatbotWindow.style.display === 'none' || !chatbotWindow.style.display) {
                        chatbotWindow.style.display = 'flex';
                        // Focus pada input
                        setTimeout(function() {
                            document.getElementById('chatbot-message-input')?.focus();
                        }, 100);
                    } else {
                        chatbotWindow.style.display = 'none';
                    }
                } else {
                    alert('Chatbot hanya tersedia di halaman Dashboard dan Artikel');
                }
            }, 100);
        });
    }
});
</script>
@endif
