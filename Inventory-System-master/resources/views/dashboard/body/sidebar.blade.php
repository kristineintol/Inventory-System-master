
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Options</div>
            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <!-- Sidenav Heading (Products)-->
            <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                Inventory
            </a>
            @if (auth()->user()->is_admin)
                <a class="nav-link {{ Request::is('technicians*') ? 'active' : '' }}" href="{{ route('technicians.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-headset"></i></div>
                    Technician
                </a>
            @endif
            <a class="nav-link {{ Request::is('procurements*') ? 'active' : '' }}" href="{{ route('procurements.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-circle-check"></i></div>
                Procurement
            </a>
            <a class="nav-link {{ Request::is('requisitions*') ? 'active' : '' }}" href="{{ route('requisitions.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-list"></i></div>
                Requisition
            </a>
            <a class="nav-link {{ Request::is('report*') ? 'active' : '' }}" href="{{ route('report') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-flag"></i></div>
                Report
            </a>

            <!-- Sidenav Heading (Settings)-->
            @if (auth()->user()->is_admin)
                <div class="sidenav-menu-heading">Settings</div>
                <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Users
                </a>
            @endif
        </div>
    </div>

    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
        </div>
    </div>
</nav>
