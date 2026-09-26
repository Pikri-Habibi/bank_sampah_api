<style>

    .sidebar-petugas {
        position: fixed;
        left: 0;
        top: 0;
        width: 230px;
        height: 100vh;

        background: #123d36;
        color: white;

        display: flex;
        flex-direction: column;

        z-index: 1000;
    }


    /* ================================
       BRAND
    ================================= */

    .brand-petugas {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 24px 18px 20px;
    }

    .brand-icon {
        width: 30px;
        height: 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;
    }

    .brand-name {
        font-size: 16px;
        font-weight: bold;

        line-height: 1.25;
    }


    /* ================================
       MENU
    ================================= */

    .menu-title {
        padding: 0 18px 10px;

        font-size: 11px;

        color: #8eb5aa;

        text-transform: uppercase;
    }

    .menu-petugas {
        display: flex;
        flex-direction: column;

        gap: 5px;

        padding: 0 10px;
    }

    .menu-petugas a {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 12px 12px;

        border-radius: 9px;

        color: #d8ebe6;

        text-decoration: none;

        font-size: 13px;

        transition: 0.2s;
    }

    .menu-petugas a:hover {
        background: rgba(255, 255, 255, 0.08);
        color: white;
    }

    .menu-petugas a.active {
        background: #2d765d;
        color: white;
        font-weight: bold;
    }

    .menu-icon {
        width: 20px;
        min-width: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
    }


    /* ================================
       BOTTOM USER
    ================================= */

    .sidebar-bottom-petugas {
        margin-top: auto;

        padding: 15px 18px 20px;

        border-top: 1px solid rgba(255, 255, 255, 0.12);
    }

    .user-info-petugas {
        display: flex;
        align-items: center;

        gap: 10px;

        margin-bottom: 15px;
    }

    .user-avatar-petugas {
        width: 34px;
        height: 34px;

        border-radius: 50%;

        background: #4fb287;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 13px;
        font-weight: bold;
    }

    .user-name-petugas {
        font-size: 12px;
        font-weight: bold;
    }

    .user-role-petugas {
        margin-top: 3px;

        font-size: 10px;

        color: #9fc1b8;
    }

    .logout-petugas {
        display: block;

        color: #d8ebe6;

        text-decoration: none;

        font-size: 12px;
    }

    .logout-petugas:hover {
        color: rgb(235, 0, 0);
    }

</style>


<aside class="sidebar-petugas">


    {{-- BRAND --}}

    <div class="brand-petugas">

        <div class="brand-icon">
            <i class="fa-solid fa-building-columns"></i>
        </div>

        <div class="brand-name">
            Bank Sampah<br>
            Griya Ayu
        </div>

    </div>


    {{-- MENU --}}

    <div class="menu-title">
        Menu
    </div>


    <nav class="menu-petugas">


        {{-- DASHBOARD --}}

        <a
            href="{{ route('petugas.dashboard') }}"
            class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                <i class="fa-solid fa-house"></i>
            </span>

            <span>
                Dashboard
            </span>

        </a>


        {{-- SETOR SAMPAH --}}

        <a
            href="{{ route('petugas.setoran.create') }}"
            class="{{ request()->routeIs('petugas.setoran.create') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                <i class="fa-solid fa-recycle"></i>
            </span>

            <span>
                Setor Sampah
            </span>

        </a>


        {{-- RIWAYAT TRANSAKSI --}}

        <a href="#">

            <span class="menu-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </span>

            <span>
                Riwayat Transaksi
            </span>

        </a>


        {{-- PENARIKAN SALDO --}}

        <a
            href="{{ route('petugas.penarikan.index') }}"
            class="{{ request()->routeIs('petugas.penarikan.*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                <i class="fa-solid fa-money-bill-transfer"></i>
            </span>

            <span>
                Penarikan Saldo
            </span>

        </a>


    </nav>


    {{-- USER --}}

    <div class="sidebar-bottom-petugas">


        <div class="user-info-petugas">


            <div class="user-avatar-petugas">
                {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
            </div>


            <div>

                <div class="user-name-petugas">

                    {{ auth()->user()->name ?? 'Petugas' }}

                </div>


                <div class="user-role-petugas">

                    Petugas Pelayanan

                </div>

            </div>


        </div>


        {{-- LOGOUT --}}

        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="logout-petugas"
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