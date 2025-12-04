@props([
  // Judul
  'title' => 'Disability Inclusion',
  // Waktu update
  'updatedAt' => null,

  // Data
  'totalEmployees' => 0,     // total pegawai HCBD
  'disabilityCount' => 0,    // jumlah pegawai dengan disabilitas
  'disabilityPct' => null,   // jika null, dihitung: (disabilityCount/totalEmployees)*100 dengan 2 desimal

  // Opsi tampilan
  'class' => '',
  'headerFrom' => '#0053D9',
  'headerTo'   => '#0038A8',
])

@php
  $updatedLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s'))
    : now()->format('Y-m-d H:i:s');

  $fmtInt = fn($n) => number_format((int)$n, 0, ',', '.');

  $pctVal = !is_null($disabilityPct)
    ? $disabilityPct
    : ($totalEmployees > 0 ? number_format(($disabilityCount / $totalEmployees) * 100, 2, ',', '.') . '%' : '0%');
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-0 {{ $class }}">
  <!-- Header biru -->
  <div class="tw-rounded-t-2xl tw-flex tw-items-center tw-justify-between tw-px-4 tw-py-2"
       style="background:linear-gradient(90deg, {{ $headerFrom }} 0%, {{ $headerTo }} 100%);">
    <div class="tw-flex tw-items-center tw-gap-2">
      <!-- Ikon kursi roda (Tabler Icons) -->
      <i class="ti ti-wheelchair tw-text-white tw-text-sm"></i>
      <span class="tw-text-[11px] tw-font-semibold tw-tracking-wide tw-text-white">{{ $title }}</span>
    </div>
    <span class="tw-text-[10px] tw-font-medium tw-text-white/90">{{ $updatedLabel }}</span>
  </div>

  <!-- Isi -->
  <div class="tw-flex tw-items-start tw-gap-4 tw-px-4 tw-pt-3 tw-pb-4">
    <!-- Ilustrasi/ikon besar (opsional, pakai emoji jika belum ada gambar kursi roda) -->
    <div class="tw-w-12 tw-h-12 tw-rounded-xl tw-bg-blue-50 tw-flex tw-items-center tw-justify-center tw-shrink-0">
      <span class="tw-text-2xl">♿</span>
    </div>

    <div class="tw-flex-1 tw-leading-tight">
      <div class="tw-text-xl tw-font-semibold tw-text-gray-900">{{ $fmtInt($disabilityCount) }} <span class="tw-text-sm tw-font-medium">Pegawai</span></div>
      <div class="tw-text-sm tw-font-semibold tw-text-blue-700">{{ $pctVal }}</div>

      <div class="tw-text-[10px] tw-text-blue-700 tw-mt-1">
        * terhadap keseluruhan Pegawai HCBD
      </div>
    </div>
  </div>
</div>