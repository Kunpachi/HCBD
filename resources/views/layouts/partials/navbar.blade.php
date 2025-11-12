{{-- <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-fluid">
        <!-- Toggle for small screens -->
        <div class="navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-md"></i>
            </a>
        </div>

        <!-- Search (CTRL+K) -->
        <div class="navbar-nav flex-row align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="ti ti-search tw-text-gray-400 me-2"></i>
                <input type="text"
                       readonly
                       class="form-control border-0 shadow-none tw-bg-transparent tw-text-sm tw-w-64"
                       placeholder="Search [CTRL + K]">
            </div>
        </div>

        <ul class="navbar-nav ms-auto flex-row align-items-center">
            <!-- Language -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                    <i class="ti ti-language"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Indonesia</a></li>
                    <li><a class="dropdown-item" href="#">English</a></li>
                </ul>
            </li>
            <!-- Theme -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="themeSwitcher">
                    <i class="ti ti-sun"></i>
                </a>
            </li>
            <!-- Grid -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="ti ti-grid-dots"></i></a>
            </li>
            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                    <i class="ti ti-bell"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">4</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">Notifications</li>
                    <li><a class="dropdown-item" href="#">Tidak ada notifikasi</a></li>
                </ul>
            </li>
            <!-- User -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <div class="tw-w-9 tw-h-9 tw-rounded-full tw-bg-indigo-200 tw-flex tw-items-center tw-justify-center tw-font-bold tw-text-indigo-700">
                        {{ strtoupper(substr(Auth::user()->name ?? 'GU',0,2)) }}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="d-flex flex-column">
                            <span class="fw-medium">{{ Auth::user()->name ?? 'Guest User' }}</span>
                            <small class="text-muted">{{ Auth::user()->email ?? 'guest@example.com' }}</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const switcher = document.getElementById('themeSwitcher');
  switcher?.addEventListener('click', (e) => {
    e.preventDefault();
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark-style');
    if (isDark) {
      html.setAttribute('data-theme','dark');
    } else {
      html.setAttribute('data-theme','theme-default');
    }
  });
});
</script>
@endpush --}}

<nav id="layout-navbar"
     class="layout-navbar navbar navbar-expand-xl align-items-center tw-px-0 tw-pt-3 tw-select-none"
     data-navbar-floating="true">
  <div class="container-fluid tw-px-4">

    <!-- Floating wrapper -->
    <div class="tw-w-full tw-bg-white tw-rounded-xl tw-shadow-[0_4px_16px_-4px_rgba(0,0,0,0.08)] tw-flex tw-items-center tw-h-16 tw-px-4 tw-gap-6 tw-border tw-border-white/60">

      <!-- LEFT: Search -->
      <div class="tw-flex tw-items-center tw-flex-1 tw-gap-3">
        <i class="ti ti-search tw-text-gray-400"></i>
        <!-- Hapus class Bootstrap .form-control agar tidak memunculkan border hitam -->
        <input
          type="text"
          readonly
          class="tw-bg-transparent tw-flex-1 tw-text-sm tw-text-gray-600 placeholder:tw-text-gray-400 tw-border-0 tw-outline-none focus:tw-outline-none focus:tw-ring-0"
          placeholder="Search [CTRL + K]"
          aria-label="Search"
        />
      </div>

      <!-- RIGHT: Icon group -->
      <ul class="tw-flex tw-items-center tw-gap-4 tw-mb-0 tw-list-none tw-pl-0">
        <li>
          <a href="javascript:void(0)" class="tw-text-gray-500 hover:tw-text-gray-700 tw-flex tw-items-center" id="themeSwitcher" aria-label="Theme">
            <i class="ti ti-sun tw-text-lg"></i>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)" class="tw-text-gray-500 hover:tw-text-gray-700 tw-flex tw-items-center" aria-label="Apps">
            <i class="ti ti-grid-dots tw-text-lg"></i>
          </a>
        </li>

        <!-- User dropdown -->
        <li class="dropdown">
          <a class="tw-flex tw-items-center tw-relative" href="#" data-bs-toggle="dropdown" aria-label="User menu">
            <div class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-indigo-200 tw-flex tw-items-center tw-justify-center tw-font-semibold tw-text-indigo-700">
              {{ strtoupper(substr(Auth::user()->name ?? 'GU',0,2)) }}
            </div>
            <span class="tw-absolute tw-bottom-0 tw-right-0 tw-h-3 tw-w-3 tw-rounded-full tw-bg-green-500 tw-ring-2 tw-ring-white"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end tw-text-sm">
            <li class="dropdown-header">
              <div class="tw-flex tw-flex-col">
                <span class="fw-medium">{{ Auth::user()->name ?? 'Guest User' }}</span>
                <small class="text-muted">{{ Auth::user()->email ?? 'guest@example.com' }}</small>
              </div>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>

@push('scripts')
<script type="module">
document.addEventListener('DOMContentLoaded', () => {
  // Theme toggle
  const themeSwitcher = document.getElementById('themeSwitcher');
  themeSwitcher?.addEventListener('click', (e) => {
    e.preventDefault();
    const html = document.documentElement;
    const dark = html.classList.toggle('dark-style');
    html.setAttribute('data-theme', dark ? 'dark' : 'theme-default');
  });

  // Bootstrap dropdown safeguard
  const Dropdown = window.bootstrap?.Dropdown;
  if (Dropdown) {
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
      if (!el.__dropdown) el.__dropdown = new Dropdown(el);
    });
  }
});
</script>
@endpush