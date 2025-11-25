<nav id="layout-navbar"
     class="layout-navbar navbar navbar-expand-xl align-items-center tw-px-0 tw-pt-3"
     aria-label="Main navigation">
  <div class="container-fluid tw-px-4">

    <!-- Wrapper tanpa border hitam -->
    <div class="tw-w-full tw-bg-white tw-rounded-xl tw-shadow-[0_4px_16px_-4px_rgba(0,0,0,0.08)] tw-flex tw-items-center tw-h-16 tw-px-4 tw-gap-6">

      <!-- LEFT: Search trigger -->
      <div class="tw-flex tw-items-center tw-flex-1 tw-gap-2">
        <i class="ti ti-search tw-text-gray-400"></i>
        <button
          type="button"
          id="quickSearchTrigger"
          class="tw-flex tw-items-center tw-gap-2 tw-bg-transparent tw-w-full tw-text-left tw-text-sm tw-text-gray-600 hover:tw-bg-gray-50 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500"
          aria-label="Open quick search (CTRL+K)">
          <span class="tw-text-sm tw-text-gray-600">Search [CTRL + K]</span>
        </button>
      </div>

      <!-- RIGHT: Actions -->
      @php($user = Auth::user())
      <ul class="tw-flex tw-items-center tw-gap-2 tw-mb-0 tw-list-none tw-pl-0">

        <!-- Theme Switch -->
        <li>
          <button type="button"
                  id="themeSwitcher"
                  class="tw-h-10 tw-w-10 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-gray-500 hover:tw-bg-gray-100 hover:tw-text-gray-700 focus:tw-ring-2 focus:tw-ring-indigo-500"
                  aria-label="Toggle theme">
            <i class="ti ti-sun tw-text-lg" id="themeIcon"></i>
          </button>
        </li>

        <!-- Apps -->
        <li>
          <button type="button"
                  class="tw-h-10 tw-w-10 tw-rounded-lg tw-flex tw-items-center tw-justify-center tw-text-gray-500 hover:tw-bg-gray-100 hover:tw-text-gray-700 focus:tw-ring-2 focus:tw-ring-indigo-500"
                  aria-label="Apps">
            <i class="ti ti-grid-dots tw-text-lg"></i>
          </button>
        </li>

        <!-- Quick Import (utama) -->
        <li>
          <button type="button"
                  data-bs-toggle="modal"
                  data-bs-target="#quickImportModal"
                  class="tw-inline-flex tw-items-center tw-gap-1 tw-text-xs tw-font-semibold tw-rounded-lg tw-bg-indigo-600 hover:tw-bg-indigo-500 tw-text-white tw-px-4 tw-h-10 tw-transition focus:tw-ring-2 focus:tw-ring-indigo-500"
                  aria-label="Quick import karyawan">
            <i class="ti ti-cloud-upload tw-text-sm"></i><span>Import</span>
          </button>
        </li>

        <!-- User dropdown -->
        <li class="dropdown">
          <button class="tw-h-10 tw-w-10 tw-rounded-full tw-relative tw-bg-indigo-200 tw-flex tw-items-center tw-justify-center tw-font-semibold tw-text-indigo-700 hover:tw-bg-indigo-300 focus:tw-ring-2 focus:tw-ring-indigo-500"
                  data-bs-toggle="dropdown"
                  aria-label="User menu"
                  aria-expanded="false">
            {{ strtoupper(substr($user->name ?? 'GU',0,2)) }}
            <span class="tw-absolute tw-bottom-0 tw-right-0 tw-h-3 tw-w-3 tw-rounded-full tw-bg-green-500 tw-ring-2 tw-ring-white"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end tw-text-sm" role="menu" aria-label="User dropdown">
            <li class="dropdown-header">
              <div class="tw-flex tw-flex-col">
                <span class="fw-medium">{{ $user->name ?? 'Guest User' }}</span>
                <small class="text-muted">{{ $user->email ?? 'guest@example.com' }}</small>
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

<!-- Modal -->
<div class="modal fade" id="quickImportModal" tabindex="-1" aria-hidden="true" aria-labelledby="quickImportTitle">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="quickImportForm" method="POST" action="{{ route('import.pegawai.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="quickImportTitle">Import Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">File Excel (.xlsx / .xls)</label>
            <input type="file"
                   name="file"
                   class="form-control"
                   accept=".xlsx,.xls"
                   required>
            <small class="text-muted d-block mt-1">
              Gunakan header sesuai template. Maks 20MB.
            </small>
          </div>
          <div id="quickImportProgress" class="progress d-none" style="height:6px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%"></div>
          </div>
          <div id="quickImportStatus" class="mt-2 text-muted small"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="ti ti-upload"></i> Upload
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<style>
/* Hapus border/outlines hitam yang muncul dari reset / bootstrap default */
#layout-navbar button,
#layout-navbar a,
#layout-navbar input[readonly] {
  border: none !important;
  box-shadow: none !important;
  outline: none !important;
}

/* Hilangkan kemungkinan outline black fokus global */
#layout-navbar button:focus,
#layout-navbar a:focus {
  outline: none !important;
  box-shadow: none !important;
}

/* Avatar tanpa border */
#layout-navbar .dropdown > button {
  border: none !important;
  box-shadow: none !important;
}

/* Jika masih terlihat garis hitam di tepi container paling atas (misal karena body border) */
body, .layout-navbar {
  border: 0 !important;
}

/* Pastikan tombol Quick tidak diselimuti border browser high-contrast */
@media (forced-colors: active) {
  #layout-navbar button,
  #layout-navbar a {
    border: 0;
  }
}
</style>
<script type="module">
document.addEventListener('DOMContentLoaded', () => {

  // Theme switch
  const themeSwitcher = document.getElementById('themeSwitcher');
  const themeIcon     = document.getElementById('themeIcon');
  themeSwitcher?.addEventListener('click', (e) => {
    e.preventDefault();
    const html = document.documentElement;
    const dark = html.classList.toggle('dark-style');
    html.setAttribute('data-theme', dark ? 'dark' : 'theme-default');
    if(themeIcon){
      themeIcon.classList.toggle('ti-sun', !dark);
      themeIcon.classList.toggle('ti-moon', dark);
    }
  });

  // Quick search trigger (CTRL+K)
  const quickSearchTrigger = document.getElementById('quickSearchTrigger');
  quickSearchTrigger?.addEventListener('click', () => {
    document.dispatchEvent(new CustomEvent('open-quick-search'));
  });
  document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      document.dispatchEvent(new CustomEvent('open-quick-search'));
    }
  });

  // Bootstrap dropdown init
  const Dropdown = window.bootstrap?.Dropdown;
  if (Dropdown) {
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
      if (!el.__dropdown) el.__dropdown = new Dropdown(el);
    });
  }

  // Quick Import AJAX (optional)
  const qiForm    = document.getElementById('quickImportForm');
  const qiProgress= document.getElementById('quickImportProgress');
  const qiBar     = qiProgress?.querySelector('.progress-bar');
  const qiStatus  = document.getElementById('quickImportStatus');

  qiForm?.addEventListener('submit', (e) => {
    const fileInput = qiForm.querySelector('input[type=file]');
    if (!fileInput.files.length) {
      e.preventDefault();
      alert('Pilih file terlebih dahulu.');
      return;
    }
    if (fileInput.files[0].size > 20 * 1024 * 1024) {
      e.preventDefault();
      alert('Ukuran file melebihi 20MB.');
      return;
    }

    // AJAX mode (hapus e.preventDefault untuk submit normal)
    e.preventDefault();

    const fd = new FormData(qiForm);
    qiProgress.classList.remove('d-none');
    qiBar.style.width = '0%';
    qiStatus.textContent = 'Mengunggah...';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', qiForm.action);
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name=csrf-token]').content);

    xhr.upload.onprogress = (ev) => {
      if (ev.lengthComputable) {
        const pct = (ev.loaded / ev.total) * 100;
        qiBar.style.width = pct.toFixed(0) + '%';
      }
    };
    xhr.onload = () => {
      if (xhr.status === 200) {
        qiBar.style.width = '100%';
        qiStatus.textContent = 'Sukses import.';
        setTimeout(() => {
          const modalEl = document.getElementById('quickImportModal');
          const modalInstance = window.bootstrap?.Modal.getInstance(modalEl);
          modalInstance?.hide();
          window.location.href = "{{ route('import.pegawai.form') }}";
        }, 800);
      } else {
        let msg = 'Gagal (' + xhr.status + ')';
        try {
          const json = JSON.parse(xhr.responseText);
          if (json.message) msg += ': ' + json.message;
        } catch(_) {}
        qiStatus.textContent = msg;
      }
    };
    xhr.onerror = () => {
      qiStatus.textContent = 'Error koneksi.';
    };
    xhr.send(fd);
  });
});
</script>
@endpush