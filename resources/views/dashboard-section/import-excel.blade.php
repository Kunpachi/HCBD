@extends('layouts.app')
@section('title','Import Data Karyawan')

@section('content')
<div class="tw-max-w-5xl tw-mx-auto tw-space-y-6">

  <div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-6">
    <h2 class="tw-text-sm tw-font-semibold tw-text-gray-800 tw-mb-4">Import Data Karyawan</h2>

    @if(session('success'))
      <div class="tw-bg-green-50 tw-border tw-border-green-200 tw-text-green-700 tw-text-xs tw-rounded tw-p-3 tw-mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="tw-bg-red-50 tw-border tw-border-red-200 tw-text-red-600 tw-text-xs tw-rounded tw-p-3 tw-mb-4">
        @foreach($errors->all() as $e)
          <div>{{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST"
          action="{{ route('import.pegawai.import') }}"
          enctype="multipart/form-data"
          class="tw-space-y-5"
          id="excelImportForm">
      @csrf

      <div>
        <label class="tw-block tw-text-xs tw-font-medium tw-text-gray-600 mb-2">Pilih File Excel</label>
        <div class="tw-border-2 tw-border-dashed tw-border-gray-300 tw-rounded-xl tw-p-6 tw-text-center tw-bg-gray-50 hover:tw-bg-gray-100 tw-transition">
          <input type="file"
                 name="file"
                 id="excelFileInput"
                 accept=".xlsx,.xls"
                 class="tw-hidden"
                 required>
          <label for="excelFileInput"
                 class="tw-cursor-pointer tw-text-indigo-600 tw-text-xs tw-font-semibold hover:tw-text-indigo-500">
            Klik untuk memilih file (atau drop di sini)
          </label>
          <p id="selectedFileName" class="tw-text-[11px] tw-text-gray-500 tw-mt-2">Belum ada file dipilih.</p>
        </div>
        <p class="tw-text-[10px] tw-text-gray-400 tw-mt-1">
          Format: .xlsx / .xls (maks 5MB). Gunakan header persis seperti daftar di bawah.
        </p>
      </div>

      <div class="tw-bg-gray-50 tw-rounded-xl tw-p-4 tw-border tw-border-gray-200">
        <p class="tw-text-[11px] tw-font-semibold tw-text-gray-700 tw-mb-2">Kolom WAJIB Minimal:</p>
        <ul class="tw-text-[11px] tw-text-gray-600 tw-list-disc tw-pl-4 tw-space-y-1">
          <li>NIP</li>
          <li>Full Name</li>
          <li>Status</li>
          <li>Gender</li>
          <li>Birth Date</li>
          <li>Join Date (jika ingin hitung masa kerja)</li>
          <li>Position Code</li>
          <li>Position</li>
          <li>Start Date Posisi</li>
          <li>Person Grade (jika Grade dipakai)</li>
          <li>Start Date Masa Grade (jika Grade dipakai)</li>
        </ul>
        <p class="tw-text-[10px] tw-text-gray-500 tw-mt-3">
          Kolom lain opsional; jika kosong akan dilewati atau disimpan null. Age dan Masa Kerja TIDAK perlu diisi karena bisa dihitung otomatis.
        </p>
      </div>

      <div class="tw-bg-white tw-border tw-border-gray-200 tw-rounded-xl tw-p-4">
        <details open>
          <summary class="tw-cursor-pointer tw-text-xs tw-font-semibold tw-text-gray-700">Daftar Header Lengkap yang Didukung</summary>
          <div class="tw-mt-3 tw-max-h-60 tw-overflow-auto tw-text-[11px] tw-text-gray-600 tw-space-y-2 tw-border tw-border-gray-100 tw-rounded tw-p-3">
            NIP, Full Name, Status, Contract Type, Angkatan, Gender, Religion, Marr. Status, PTKP, Birth Place, Birth Date,
            Gol Darah, Usia Pensiun, Join Date,
            Direktorat, Kode Induk, Induk, Start Date induk, Masa Induk,
            Kode Cost Center, Cost Center,
            Code Department, Department, Rumpun Divisi, Masa Department,
            Code Lokasi, Lokasi,
            Person Grade, Start Date Masa Grade, Masa Grade,
            Position Code, Position, Start Date Posisi, Masa Posisi,
            Job Code, Job, Layer Job, Job Family, Rumpun Jabatan, Start Date Job, Masa Job,
            Valid Grade Min, Valid Grade Max,
            Disability Info, Disability Type,
            Email Corporate, User AD,
            No Handphone, No Link Aja,
            NIK, No DPLK, No.BPJS Kesehatan, No BPS Ketenagakerjaan,
            CIF, NIP Atasan, Nama Atasan,
            Jenjang Pendidikan, Tahun Lulus, Country, Nama institusi, Fakultas, Jurusan, IPK,
            SMK Y-3, SMK Y-2, SMK Y-1,
            Assignment Number, Global Transfer Flag
          </div>
        </details>
      </div>

      <div class="tw-flex tw-items-center tw-gap-3">
        <button type="submit"
                class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-lg tw-bg-indigo-600 hover:tw-bg-indigo-500 tw-text-white tw-text-xs tw-font-semibold tw-px-4 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500">
          <i class="ti ti-upload"></i> Import
        </button>
        <button type="button" id="resetFileBtn"
                class="tw-text-xs tw-text-gray-600 hover:tw-text-red-600">
          Reset
        </button>
        <div id="uploadProgress" class="tw-flex-1 tw-hidden">
          <div class="tw-h-2 tw-bg-gray-200 tw-rounded">
            <div id="uploadBar" class="tw-h-2 tw-bg-indigo-500 tw-rounded" style="width:0%;"></div>
          </div>
          <p class="tw-text-[10px] tw-text-gray-500 tw-mt-1" id="uploadStatus">Mengunggah...</p>
        </div>
      </div>

    </form>
  </div>

  <div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-6">
    <h3 class="tw-text-xs tw-font-semibold tw-text-gray-700 tw-mb-3">Contoh Minimal Template Excel (Baris 1 = Header)</h3>
    <table class="tw-w-full tw-text-[11px] tw-text-gray-600 tw-border tw-border-gray-200 tw-rounded overflow-auto">
      <thead class="tw-bg-gray-100 tw-text-gray-700 tw-font-semibold">
        <tr>
          <th class="tw-px-2 tw-py-1">NIP</th>
          <th class="tw-px-2 tw-py-1">Full Name</th>
          <th class="tw-px-2 tw-py-1">Status</th>
          <th class="tw-px-2 tw-py-1">Gender</th>
          <th class="tw-px-2 tw-py-1">Birth Date</th>
          <th class="tw-px-2 tw-py-1">Join Date</th>
          <th class="tw-px-2 tw-py-1">Position Code</th>
          <th class="tw-px-2 tw-py-1">Position</th>
          <th class="tw-px-2 tw-py-1">Start Date Posisi</th>
          <th class="tw-px-2 tw-py-1">Person Grade</th>
          <th class="tw-px-2 tw-py-1">Start Date Masa Grade</th>
        </tr>
      </thead>
      <tbody>
        <tr class="tw-border-t">
          <td class="tw-px-2 tw-py-1">10001</td>
          <td class="tw-px-2 tw-py-1">Budi Santoso</td>
          <td class="tw-px-2 tw-py-1">PKWT</td>
          <td class="tw-px-2 tw-py-1">M</td>
          <td class="tw-px-2 tw-py-1">1990-01-12</td>
          <td class="tw-px-2 tw-py-1">2020-02-01</td>
          <td class="tw-px-2 tw-py-1">POS-001</td>
          <td class="tw-px-2 tw-py-1">Staff Operasional</td>
          <td class="tw-px-2 tw-py-1">2023-07-01</td>
          <td class="tw-px-2 tw-py-1">2C</td>
          <td class="tw-px-2 tw-py-1">2023-07-01</td>
        </tr>
      </tbody>
    </table>
    <p class="tw-text-[10px] tw-text-gray-500 tw-mt-2">
      Tambahkan kolom opsional lain sesuai kebutuhan. Pastikan tidak mengubah ejaan header.
    </p>
  </div>

</div>
@endsection

@push('after-scripts')
<script>
(function(){
  const input = document.getElementById('excelFileInput');
  const fileNameEl = document.getElementById('selectedFileName');
  const resetBtn = document.getElementById('resetFileBtn');
  const form = document.getElementById('excelImportForm');
  const progressWrap = document.getElementById('uploadProgress');
  const uploadBar = document.getElementById('uploadBar');
  const uploadStatus = document.getElementById('uploadStatus');

  input.addEventListener('change', () => {
    if (input.files.length) {
      const f = input.files[0];
      fileNameEl.textContent = f.name + ' (' + Math.round(f.size/1024) + ' KB)';
      if (f.size > 5 * 1024 * 1024) { // 5MB
        alert('Ukuran file melebihi 5MB.');
        input.value = '';
        fileNameEl.textContent = 'Belum ada file dipilih.';
      }
    } else {
      fileNameEl.textContent = 'Belum ada file dipilih.';
    }
  });

  resetBtn.addEventListener('click', () => {
    input.value = '';
    fileNameEl.textContent = 'Belum ada file dipilih.';
  });

  // Jika ingin AJAX progress, aktifkan blok komentar di bawah
  form.addEventListener('submit', (e) => {
    if (!input.files.length) {
      e.preventDefault();
      alert('Pilih file terlebih dahulu.');
      return;
    }
    // Default: form submit biasa
  });
})();
</script>
@endpush