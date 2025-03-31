<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Website Klinik</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Dashboard Pasien</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Dashboard Dokter</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
