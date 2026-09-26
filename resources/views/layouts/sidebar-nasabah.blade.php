<aside class="sidebar">
    <div class="sidebar-header">
        <div class="brand-icon">
            <i class="fa-solid fa-building-columns"></i>
        </div>

        <div>
            <h2>Bank Sampah</h2>
            <p>Griya Ayu</p>
        </div>
    </div>

    <div class="sidebar-menu">
        <p class="menu-title">MENU NASABAH</p>

        <a href="{{ route('nasabah.dashboard') }}"
           class="menu-item {{ request()->routeIs('nasabah.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <i class="fa-solid fa-house"></i>
            </span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('nasabah.penarikan.create') }}"
           class="menu-item {{ request()->routeIs('nasabah.penarikan.*') ? 'active' : '' }}">
            <span class="menu-icon">
                <i class="fa-solid fa-money-bill-transfer"></i>
            </span>
            <span>Penarikan Saldo</span>
        </a>

        <a href="{{ route('nasabah.riwayat') }}"
           class="menu-item {{ request()->routeIs('nasabah.riwayat') ? 'active' : '' }}">
            <span class="menu-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </span>

            <span>Riwayat Transaksi</span>
        </a>

        <a href="{{ route('nasabah.harga-sampah') }}"
            class="menu-item {{ request()->routeIs('nasabah.harga-sampah') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-coins"></i>
                </span>
                <span>Harga Sampah</span>
            </a>
    </div>

    <div class="sidebar-bottom">
        <a href="{{ route('nasabah.profil') }}" class="profile-link">

            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 1)) }}
                </div>

                <div>
                    <strong>{{ auth()->user()->name ?? 'Nasabah' }}</strong>
                    <small>Nasabah</small>
                </div>
            </div>

        </a>

        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="logout-nasabah"
                style="
                    background: none;
                    border: none;
                    padding: 0;
                    cursor: pointer;
                    font-family: inherit;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                "
            >

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>
                    Keluar
                </span>

            </button>

        </form>
    </div>
</aside>

<style>
    .menu-icon {
        width: 20px;
        min-width: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
    }
    
    .profile-link {
        color: inherit;
        text-decoration: none;
        display: block;
    }

    .profile-link:hover {
        opacity: 0.85;
    }
    .sidebar {
        width: 230px;
        min-height: 100vh;
        background: #0f463d;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        padding: 24px 18px;
        box-sizing: border-box;
    }

    .brand-icon {
        font-size: 30px;
        line-height: 1;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 35px;
    }

    .logo-icon {
        font-size: 30px;
    }

    .sidebar-header h2 {
        margin: 0;
        font-size: 16px;
    }

    .sidebar-header p {
        margin: 2px 0 0;
        font-size: 14px;
    }

    .menu-title {
        font-size: 11px;
        color: #8fb7ad;
        margin-bottom: 12px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 13px;
        color: white;
        text-decoration: none;
        padding: 13px 14px;
        border-radius: 9px;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .menu-item:hover {
        background: #216b5c;
    }

    .menu-item.active {
        background: #2f806b;
    }

    .menu-item span:first-child {
        width: 18px;
        text-align: center;
        font-size: 18px;
    }

    .sidebar-bottom {
        margin-top: auto;
        border-top: 1px solid rgba(255,255,255,.15);
        padding-top: 18px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #4eb58b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .user-info strong {
        display: block;
        font-size: 13px;
    }

    .user-info small {
        color: #a9c9c1;
        font-size: 11px;
    }

    .logout-nasabah {
        color: #d8ebe6;
        font-size: 13px;
    }

    .logout-nasabah:hover {
        color: rgb(235, 0, 0);
    }

</style> 