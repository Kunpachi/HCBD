<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- Ganti dengan SVG/logo Anda -->
                <svg width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="30" height="30" rx="6" class="tw-fill-indigo-500"></rect>
                    <text x="15" y="20" text-anchor="middle" font-size="12" fill="#fff" font-family="Arial">HC</text>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">HCBD</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="ti ti-x ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards --> 

        <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon ti ti-users"></i>
                <div data-i18n="Laravel Example">User Management</div>
            </a>
        </li>

        <!-- Collapsible example -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-layout-grid"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('hr.total') }}" class="menu-link">
                        <div>Total Kepegawaian</div>
                    </a>
                </li>
              
            </ul>
        </li>
    </ul>
</aside>