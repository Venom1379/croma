<nav class="nxl-navigation">
    <div class="navbar-wrapper">

        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand">
            <img src="{{ asset('assets/images/logo-full.png') }}" class="logo logo-lg" width="150" />
                {{-- <img src="{{ asset('assets/images/logo-abbr.png') }}" class="logo logo-sm"/> --}}
            </a>
        </div>

        <div class="navbar-content">

            <ul class="nxl-navbar">

                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>

                {{-- Dashboard --}}
                <li class="nxl-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nxl-link">
                        <span class="nxl-micon">
                            <i class="feather-airplay"></i>
                        </span>
                        <span class="nxl-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- Supervisors --}}
                <li class="nxl-item {{ Route::is('supervisors.*') ? 'active' : '' }}">
                    <a href="{{ route('supervisors.index') }}" class="nxl-link">
                        <span class="nxl-micon">
                            <i class="feather-users"></i>
                        </span>
                        <span class="nxl-mtext">Supervisors</span>
                    </a>
                </li>

                {{-- Certificates --}}
                <li class="nxl-item {{ Route::is('certificates.*') ? 'active' : '' }}">
                    <a href="{{ route('certificates.index') }}" class="nxl-link">
                        <span class="nxl-micon">
                            <i class="feather-file-text"></i>
                        </span>
                        <span class="nxl-mtext">Certificates</span>
                    </a>
                </li>

                {{-- Companies --}}
                <li class="nxl-item {{ Route::is('companies.*') ? 'active' : '' }}">
                    <a href="{{ route('companies.index') }}" class="nxl-link">
                        <span class="nxl-micon">
                            <i class="feather-briefcase"></i>
                        </span>
                        <span class="nxl-mtext">Companies</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav> 
<style>
    /* ================= SIDEBAR THEME ================= */

/* Sidebar background */
.nxl-navigation {
    background: #1d3152 !important;
}

/* Logo/Header area */
.nxl-navigation .m-header {
    background: #1d3152 !important;
    border-bottom: 1px solid rgba(255,255,255,0.15);
}

/* All menu text + icons white */
.nxl-navigation .nxl-link,
.nxl-navigation .nxl-mtext,
.nxl-navigation .nxl-micon i,
.nxl-navigation .nxl-arrow i,
.nxl-navigation .nxl-submenu .nxl-link {
    color: #ffffff !important;
}

/* Caption text */
.nxl-navigation .nxl-caption label {
    color: rgba(255,255,255,0.85) !important;
    font-weight: 700;
}

/* Hover effect */
.nxl-navigation .nxl-item:hover > .nxl-link {
    background: rgba(255,255,255,0.12) !important;
    border-radius: 12px;
    color: #ffffff !important;
}

/* Active menu */
.nxl-navigation .nxl-item.active > .nxl-link {
    background: rgba(0,0,0,0.20) !important;
    border-radius: 12px;
    color: #ffffff !important;
}

/* Submenu background */
.nxl-navigation .nxl-submenu {
    background: rgba(0,0,0,0.12) !important;
    border-left: 2px solid rgba(255,255,255,0.25);
    margin-left: 10px;
    border-radius: 12px;
    padding: 8px 6px;
}

/* Submenu item hover */
.nxl-navigation .nxl-submenu .nxl-item:hover .nxl-link {
    background: rgba(255,255,255,0.12) !important;
    border-radius: 10px;
}

/* Submenu active */
.nxl-navigation .nxl-submenu .nxl-item.active .nxl-link {
    background: rgba(0,0,0,0.22) !important;
    border-radius: 10px;
    font-weight: 800;
}

/* Make icons slightly stronger */
.nxl-navigation .nxl-micon i {
    font-size: 18px;
    opacity: 0.95;
}

/* Smooth UI */
.nxl-navigation .nxl-link {
    transition: all 0.2s ease-in-out;
}

/* Scrollbar (optional nice look) */
.nxl-navigation ::-webkit-scrollbar {
    width: 6px;
}
.nxl-navigation ::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.25);
    border-radius: 10px;
}

</style>