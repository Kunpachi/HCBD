<!DOCTYPE html>
<html lang="id"
      class="light-style layout-menu-fixed layout-navbar-fixed"
      data-theme="theme-default"
      data-assets-path="/vendor/"
      data-template="vertical-menu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Human Capital Database')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="layout-wrapper layout-content-navbar">
<!-- Layout container -->
<div class="layout-container">
    @include('layouts.partials.sidebar')

    <!-- Layout page -->
    <div class="layout-page">
        @include('layouts.partials.navbar')

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
            <!-- /Content -->

            <!-- Footer (opsional) -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-column flex-md-row flex-wrap justify-content-between py-2">
                    <div class="mb-2 mb-md-0">
                        <small class="text-muted">© {{ date('Y') }} HCBD</small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-body tw-text-xs">Docs</a>
                        <a href="#" class="text-body tw-text-xs">Support</a>
                    </div>
                </div>
            </footer>
            <div class="content-backdrop fade"></div>
        </div>
        <!-- /Content wrapper -->
    </div>
    <!-- /Layout page -->
</div>
<!-- Overlay (untuk mobile menu) -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Quick Search Dialog -->
<div id="quickSearchDialog" class="tw-hidden tw-fixed tw-inset-0 tw-bg-black/50 tw-z-50 tw-flex tw-items-start tw-justify-center tw-pt-24">
    <div class="tw-bg-white tw-w-[600px] tw-rounded-xl tw-shadow-xl tw-p-4">
        <div class="tw-flex tw-items-center tw-gap-2 tw-mb-3">
            <i class="ti ti-search tw-text-lg"></i>
            <input id="quickSearchInput"
                   type="text"
                   placeholder="Ketik untuk mencari menu..."
                   class="tw-flex-1 tw-border tw-rounded tw-px-3 tw-py-2 tw-text-sm focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-indigo-500">
            <button id="quickSearchClose" class="tw-text-gray-500 hover:tw-text-gray-700">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <ul id="quickSearchResults" class="tw-space-y-1 tw-max-h-60 tw-overflow-y-auto"></ul>
        <p class="tw-text-xs tw-text-gray-400 tw-mt-3">Shortcut: CTRL+K</p>
    </div>
</div>


@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Highlight active link berdasarkan URL
  const current = window.location.pathname;
  document.querySelectorAll('#layout-menu a.menu-link').forEach(a => {
    if (a.getAttribute('href') === current) {
      a.classList.add('active');
      const parent = a.closest('.menu-item');
      parent?.classList.add('active');
    }
  });

  // Quick Search (CTRL+K)
  const dialog = document.getElementById('quickSearchDialog');
  const input = document.getElementById('quickSearchInput');
  const results = document.getElementById('quickSearchResults');
  const closeBtn = document.getElementById('quickSearchClose');
  const menuLinks = () => Array.from(document.querySelectorAll('#layout-menu a.menu-link'));

  const collectItems = () => {
    return Array.from(document.querySelectorAll('#layout-menu a.menu-link'))
      .map(a => ({text: a.textContent.trim(), href: a.getAttribute('href')}));
  };

  const renderResults = (q) => {
    const items = collectItems().filter(i => i.text.toLowerCase().includes(q.toLowerCase()));
    results.innerHTML = items.length
      ? items.map(i => `<li><a class="tw-block tw-px-2 tw-py-1 hover:tw-bg-indigo-50 tw-rounded" href="${i.href}">${i.text}</a></li>`).join('')
      : `<li class="tw-text-xs tw-text-gray-400 tw-px-2">Tidak ada hasil</li>`;
  };

    function openDialog() {
        dialog.classList.remove('tw-hidden');
        dialog.setAttribute('aria-hidden','false');
        input.focus();
        input.select();
        renderResults('');
    }
    function closeDialog() {
        dialog.classList.add('tw-hidden');
        dialog.setAttribute('aria-hidden','true');
    }

  document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      dialog.classList.remove('tw-hidden');
      input.focus();
      input.select();
      renderResults('');
    }
  });
  document.addEventListener('open-quick-search', () => openDialog());


  input?.addEventListener('input', () => renderResults(input.value));
  closeBtn?.addEventListener('click', () => dialog.classList.add('tw-hidden'));
  dialog?.addEventListener('click', (e) => {
    if (e.target === dialog) dialog.classList.add('tw-hidden');
  });
});
</script>
</body>
</html>