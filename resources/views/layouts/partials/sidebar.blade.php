<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="30" height="30" rx="6" class="tw-fill-indigo-500"></rect>
          <text x="15" y="20" text-anchor="middle" font-size="12" fill="#fff" font-family="Arial">HC</text>
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bold">HCBD</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" aria-label="Toggle menu">
      <i class="ti ti-x ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  @php
    use Illuminate\Support\Facades\Route;

    $routeHas = fn(string $name) => Route::has($name);

    // User Management
    $userUrl = $routeHas('users.index') ? route('users.index') : 'javascript:void(0);';
    $userActive = request()->routeIs('users.*');

    // Dashboard
    $dashboardUrl = $routeHas('dashboard') ? route('dashboard') : url('/');
    $dashboardActive = request()->routeIs('dashboard');

    // Total Kepegawaian
    $totalUrl = $routeHas('hr.total') ? route('hr.total') : 'javascript:void(0);';
    $totalActive = request()->routeIs('hr.total');

    // Pemenuhan Kepegawaian (baru)
    $fulfillUrl = $routeHas('hr.fulfillment') ? route('hr.fulfillment') : 'javascript:void(0);';
    $fulfillActive = request()->routeIs('hr.fulfillment');

    // Job Title
    $jobTitleUrl = $routeHas('hr.jobtitle') ? route('hr.jobtitle') : 'javascript:void(0);';
    $jobTitleActive = request()->routeIs('hr.jobtitle');

    // Buka grup Layouts jika ada item di dalamnya yang aktif
    $layoutsOpen = $dashboardActive || $totalActive || $fulfillActive || $jobTitleActive;
  @endphp

  <ul class="menu-inner py-1">
    <!-- User Management -->
    {{-- <li class="menu-item {{ $userActive ? 'active' : '' }}">
      <a href="{{ $userUrl }}" class="menu-link" {!! $userUrl === 'javascript:void(0);' ? 'aria-disabled="true"' : '' !!}>
        <i class="menu-icon ti ti-users"></i>
        <div>User Management</div>
      </a>
    </li> --}}

    <!-- Layouts (collapsible) -->
    <li class="menu-item {{ $layoutsOpen ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ $layoutsOpen ? 'true' : 'false' }}">
        <i class="menu-icon ti ti-layout-grid"></i>
        <div>Dashboard</div>
      </a>
      <ul class="menu-sub">
        <!-- Dashboard (Pemenuhan Pegawai) -->
        <li class="menu-item {{ $dashboardActive ? 'active' : '' }}">
          <a href="{{ $dashboardUrl }}" class="menu-link">
            <i class="ti ti-layout-dashboard me-2"></i>
            <div>Management</div>
          </a>
        </li>

        <!-- Total Kepegawaian -->
        <li class="menu-item {{ $totalActive ? 'active' : '' }}">
          <a href="{{ $totalUrl }}" class="menu-link" {!! $totalUrl === 'javascript:void(0);' ? 'aria-disabled="true"' : '' !!}>
            <i class="ti ti-chart-bar me-2"></i>
            <div>Total Kepegawaian</div>
          </a>
        </li>

        <!-- Pemenuhan Kepegawaian (baru) -->
        <li class="menu-item {{ $fulfillActive ? 'active' : '' }}">
          <a href="{{ $fulfillUrl }}" class="menu-link" {!! $fulfillUrl === 'javascript:void(0);' ? 'aria-disabled="true"' : '' !!}>
            <i class="ti ti-clipboard-check me-2"></i>
            <div>Pemenuhan Kepegawaian</div>
          </a>
        </li>
        <li class="menu-item {{ $jobTitleActive ? 'active' : '' }}">
          <a href="{{ $jobTitleUrl }}" class="menu-link" {!! $jobTitleUrl === 'javascript:void(0);' ? 'aria-disabled="true"' : '' !!}>
            <i class="ti ti-briefcase me-2"></i>
            <div>Job Title</div>
          </a>
        </li>  
      </ul>
    </li>
  </ul>
</aside>