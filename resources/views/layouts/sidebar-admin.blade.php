<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">
            ♻
        </div>

        <div class="brand-name">
            Bank Sampah<br>
            Griya Ayu
        </div>
    </div>


    <div class="menu-title">
        Menu Koordinator
    </div>


    <nav class="menu">
        <!-- PERBAIKAN 1: Menggunakan admin.dashboard -->
        <a href="{{ route('dashboard.admin') }}" class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <span class="menu-icon">
                ▦
            </span>
            <span>
                Dashboard
            </span>
        </a>


        <a href="{{ route('kelola.sampah') }}" class="{{ request()->routeIs('kelola.sampah') ? 'active' : '' }}">
            <span class="menu-icon">
                ▤
            </span>
            <span>
                Kelola Sampah
            </span>
        </a>


        <a href="#">
            <span class="menu-icon">
                ◎
            </span>
            <span>
                Manajemen Pengguna
            </span>
        </a>


        <a href="#">
            <span class="menu-icon">
                ↗
            </span>
            <span>
                Laporan
            </span>
        </a>
    </nav>


    <!-- USER -->
    <div class="sidebar-bottom">

        <div class="user-info">
            <div class="user-avatar">
                <!-- Opsional: Mengambil inisial nama secara dinamis -->
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>

            <div>
                <div class="user-name">
                    <!-- Menampilkan nama user yang sedang login -->
                    {{ Auth::user()->name ?? 'Ibu Dina' }}
                </div>

                <div class="user-role">
                    Admin
                </div>
            </div>
        </div>


        <!-- PERBAIKAN 2: Hidden Form Logout & Trigger JavaScript -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ⇥ Keluar
        </a>

    </div>

</aside>
