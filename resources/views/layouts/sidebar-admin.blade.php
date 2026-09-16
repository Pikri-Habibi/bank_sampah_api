
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
                    S
                </div>

                <div>

                    <div class="user-name">
                        Ibu Dina
                    </div>

                    <div class="user-role">
                        Admin
                    </div>

                </div>

            </div>


            <a href="#" class="logout">
                ⇥ Keluar
            </a>

        </div>

    </aside>
