<!-- CSS Sidebar -->
<style>
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 230px;
        height: 100vh;
        background: #123d36;
        color: white;
        padding: 22px 18px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 32px;
    }

    .brand-icon {
        font-size: 34px;
        line-height: 1;
    }

    .brand-name {
        font-size: 15px;
        font-weight: bold;
        line-height: 1.2;
    }

    .menu-title {
        color: #91afa8;
        font-size: 11px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: #c6d6d2;
        padding: 11px 13px;
        border-radius: 9px;
        font-size: 14px;
        transition: 0.2s;
    }

    .menu a:hover {
        background: #245f4f;
        color: white;
    }

    .menu a.active {
        background: #2d765d;
        color: white;
    }

    .menu-icon {
        width: 20px;
        text-align: center;
        font-size: 18px;
    }

    /* USER SIDEBAR */
    .sidebar-bottom {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 20px;
        border-top: 1px solid rgba(255,255,255,0.12);
        padding-top: 18px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #4eb37f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: bold;
    }

    .user-name {
        font-size: 12px;
        font-weight: bold;
    }

    .user-role {
        font-size: 10px;
        color: #9bb5ae;
        margin-top: 2px;
    }

    .logout {
        color: #ff6464;
        text-decoration: none;
        font-size: 13px;
    }
</style>

<!-- HTML Sidebar -->
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
        <a href="{{ route('dashboard.admin') }}" class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <span class="menu-icon">▦</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('kelola.sampah') }}" class="{{ request()->routeIs('kelola.sampah') ? 'active' : '' }}">
            <span class="menu-icon">▤</span>
            <span>Kelola Sampah</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
            <span class="menu-icon">◎</span>
            <span>Manajemen Pengguna</span>
        </a>

        <a href="#">
            <span class="menu-icon">↗</span>
            <span>Laporan</span>
        </a>
    </nav>

    <!-- USER & LOGOUT -->
    <div class="sidebar-bottom">
        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <div class="user-name">
                    {{ Auth::user()->name ?? 'Ibu Dina' }}
                </div>
                <div class="user-role">
                    Admin
                </div>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ⇥ Keluar
        </a>
    </div>
</aside>
