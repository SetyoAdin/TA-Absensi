<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('dashboard') }}">General Dashboard</a></li>
                </ul>
            </li>

            <li class="menu-header">Manajemen</li>
            <li class="nav-item">
                <a href="{{ route('karyawan.index') }}" class="nav-link"><i
                        class="fas fa-users"></i><span>user</span></a>
            </li>

            <!-- Add more menu items as needed -->
        </ul>
    </aside>
</div>
