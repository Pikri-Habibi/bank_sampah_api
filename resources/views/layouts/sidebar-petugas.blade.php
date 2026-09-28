<style>
    .sidebar {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        display: flex;
        width: 230px;
        height: 100vh;
        flex-direction: column;
        padding: 20px 18px;
        background: #123d36;
        color: #fff;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 35px;
    }

    .brand-icon {
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #319d7c;
        font-size: 21px;
    }

    .brand-text {
        font-size: 15px;
        font-weight: 700;
        line-height: 1.25;
    }

    .menu-title {
        margin-bottom: 12px;
        color: #9cc2ba;
        font-size: 11px;
        text-transform: uppercase;
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .menu a,
    .logout {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #e4f1ef;
        font: inherit;
        font-size: 14px;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
    }

    .menu a:hover,
    .logout:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .menu a.active {
        background: #2c8069;
        color: #fff;
        font-weight: 700;
    }

    .menu-icon {
        display: inline-flex;
        width: 20px;
        flex: 0 0 20px;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .sidebar-bottom {
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
        padding-top: 18px;
    }

    .petugas-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .petugas-avatar {
        display: flex;
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #50ba8c;
        font-weight: 700;
    }

    .petugas-name {
        font-size: 12px;
        font-weight: 700;
    }

    .petugas-role {
        margin-top: 2px;
        color: #a9cbc4;
        font-size: 10px;
    }

    .logout {
        width: 100%;
        color: #ffaaa3;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
            padding: 16px 14px;
        }
    }

    @media (max-width: 600px) {
        .sidebar {
            width: 64px;
            align-items: center;
            padding: 16px 8px;
        }

        .brand-text,
        .menu-title,
        .menu a span:not(.menu-icon),
        .petugas-info > div,
        .logout span {
            display: none;
        }

        .brand {
            justify-content: center;
            margin-bottom: 24px;
        }

        .menu a,
        .logout {
            justify-content: center;
            padding: 12px;
        }
    }
</style>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">♻</div>
        <div class="brand-text">Bank Sampah<br>Griya Ayu</div>
    </div>

    <div class="menu-title">Menu</div>
    <nav class="menu">
        <a href="{{ route('petugas.dashboard') }}" class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">⌂</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('petugas.setoran.create') }}" class="{{ request()->routeIs('petugas.setoran.*') ? 'active' : '' }}">
            <span class="menu-icon">♻</span>
            <span>Setor Sampah</span>
        </a>
        <a href="{{ route('petugas.transaksi.history') }}" class="{{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
            <span class="menu-icon">▤</span>
            <span>Riwayat Transaksi</span>
        </a>
        <a href="{{ route('petugas.penarikan.index') }}" class="{{ request()->routeIs('petugas.penarikan.*') ? 'active' : '' }}">
            <span class="menu-icon">Rp</span>
            <span>Penarikan Saldo</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="petugas-info">
            <div class="petugas-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}</div>
            <div>
                <div class="petugas-name">{{ auth()->user()->name ?? 'Petugas' }}</div>
                <div class="petugas-role">Petugas Pelayanan</div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout" type="submit">
                <span class="menu-icon">↪</span>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
