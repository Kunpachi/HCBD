@props([
  'title'           => 'Total Kepegawaian',
  'subtitle'        => null,
  'updatedAt'       => null,
  'period'          => '30d',
  'totalEmployees'  => 0,
  'totalTalent'     => 0,
  'totalDisability' => 0,
  'totalPct'        => '(0%)',
  'talentPct'       => '(0%)',
  'disabilityPct'   => '(0%)',
  'class'           => '',
  'compact'         => true,   // samakan gaya compact seperti "generation"
])

@php
  $updatedLabel   = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
    : 'Updated just now';

  // Kelas ukuran compact
  $chipSizeClass  = $compact ? 'tw-w-9 tw-h-9 tw-rounded-lg' : 'tw-w-11 tw-h-11 tw-rounded-xl';
  $iconSizeClass  = $compact ? 'tw-text-base' : 'tw-text-lg';
  $valueTextClass = $compact ? 'tw-text-sm' : 'tw-text-base';
  $titleTextClass = $compact ? 'tw-text-xs' : 'tw-text-sm';
  $outerPadding   = $compact ? 'tw-px-4 tw-pt-4 tw-pb-4' : 'tw-px-5 tw-pt-5 tw-pb-5';
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white {{ $outerPadding }} {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-4">
    <h5 class="{{ $titleTextClass }} tw-font-semibold tw-tracking-wide tw-text-gray-800 tw-m-0">
      {{ strtoupper($title) }}
    </h5>
    <span class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>

  <!-- Grid 3 kolom (ringkas seperti generation) -->
  <div class="tw-grid tw-gap-4 sm:tw-grid-cols-3">
    <!-- Jumlah Pegawai -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <a href="{{ route('hr.total') }}#pegawai"
         class="{{ $chipSizeClass }} tw-flex tw-items-center tw-justify-center tw-bg-indigo-100 hover:tw-scale-[1.02] tw-transition"
         title="Lihat tabel Jumlah Pegawai">
        <i class="ti ti-users {{ $iconSizeClass }} tw-text-indigo-600"></i>
      </a>
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $totalEmployees }}
          <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $totalPct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">Jumlah Pegawai</div>
      </div>
    </div>

    <!-- Jumlah Talent -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <a href="{{ route('hr.total') }}#talent"
         class="{{ $chipSizeClass }} tw-flex tw-items-center tw-justify-center tw-bg-teal-100 hover:tw-scale-[1.02] tw-transition"
         title="Lihat tabel Jumlah Talent">
        <i class="ti ti-user-plus {{ $iconSizeClass }} tw-text-teal-600"></i>
      </a>
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $totalTalent }}
          <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $talentPct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">Jumlah Talent</div>
      </div>
    </div>

    <!-- Disability -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <a href="{{ route('hr.total') }}#disability"
         class="{{ $chipSizeClass }} tw-flex tw-items-center tw-justify-center tw-bg-cyan-100 hover:tw-scale-[1.02] tw-transition"
         title="Lihat tabel Disability">
        <i class="ti ti-accessible {{ $iconSizeClass }} tw-text-cyan-600"></i>
      </a>
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $totalDisability }}
          <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $disabilityPct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">Disability</div>
      </div>
    </div>
  </div>
</div>