@php
  // Sanitasi variabel agar foreach tidak menerima int
  $employees   = is_iterable($employees   ?? null) ? $employees   : [];
  $direktorats = is_iterable($direktorats ?? null) ? $direktorats : [];
  $departments = is_iterable($departments ?? null) ? $departments : [];
  $locations   = is_iterable($locations   ?? null) ? $locations   : [];
  $families    = is_iterable($families    ?? null) ? $families    : [];
  $contracts   = is_iterable($contracts   ?? null) ? $contracts   : ['Permanent','Contract','Intern'];
  $maritals    = is_iterable($maritals    ?? null) ? $maritals    : ['Single','Married'];
  $religions   = is_iterable($religions   ?? null) ? $religions   : ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
  $angkatan    = is_iterable($angkatan    ?? null) ? $angkatan    : ['Y-3','Y-2','Y-1','Y'];
  $layers      = is_iterable($layers      ?? null) ? $layers      : ['Staff','Supervisor','Manager','Senior Manager','GM','Director'];
@endphp

<div class="tw-space-y-4">

  <div class="tw-flex tw-items-center tw-justify-between">
    <div class="tw-flex tw-items-center tw-gap-2">
      <button id="expCsvBtn" class="tw-text-xs tw-font-semibold tw-text-indigo-700 tw-bg-indigo-50 hover:tw-bg-indigo-100 tw-rounded-lg tw-px-3 tw-py-1.5 tw-flex tw-items-center tw-gap-1">
        <i class="ti ti-file-type-csv"></i> Export CSV
      </button>
      <button id="expXlsxBtn" class="tw-text-xs tw-font-semibold tw-text-emerald-700 tw-bg-emerald-50 hover:tw-bg-emerald-100 tw-rounded-lg tw-px-3 tw-py-1.5 tw-flex tw-items-center tw-gap-1">
        <i class="ti ti-file-spreadsheet"></i> Export Excel
      </button>
      {{-- GANTI route('import.show') -> route('import.pegawai.form') --}}
      <a href="{{ route('import.pegawai.form') }}" class="tw-text-xs tw-font-semibold tw-text-violet-700 tw-bg-violet-50 hover:tw-bg-violet-100 tw-rounded-lg tw-px-3 tw-py-1.5 tw-flex tw-items-center tw-gap-1">
        <i class="ti ti-cloud-upload"></i> Import
      </a>
    </div>
    <div class="tw-flex tw-items-center tw-gap-4 tw-text-[11px]">
      <div class="tw-flex tw-items-center tw-gap-1"><span class="tw-text-gray-500">Total:</span> <span id="kpiTotal" class="tw-font-semibold">0</span></div>
      <div class="tw-flex tw-items-center tw-gap-1"><span class="tw-text-gray-500">Avg Age:</span> <span id="kpiAvgAge" class="tw-font-semibold">0</span></div>
      <div class="tw-flex tw-items-center tw-gap-1"><span class="tw-text-gray-500">Avg Tenure:</span> <span id="kpiAvgTenure" class="tw-font-semibold">0 th</span></div>
    </div>
  </div>

  {{-- ... (lanjutan file tidak diubah selain sanitasi variabel dan route) ... --}}

  @push('after-scripts')
  <script>
    // Pastikan expXlsxBtn gunakan route baru jika Anda punya route khusus export:
    document.getElementById('expXlsxBtn').addEventListener('click',()=>{
      // Ganti ini ke route export XLSX (buat route baru) atau sementara ke form import
      window.location.href = '{{ route('import.pegawai.form') }}';
    });
  </script>
  @endpush
</div>