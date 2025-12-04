@props([
  'title' => 'Consolidated HCBD & HCMD',
  'updatedAt' => null,
  'formasi' => 0,
  'jumlahPegawai' => 0,
  'gap' => null,
  'gapPct' => null,
  'male' => 0,
  'female' => 0,
  // baru
  'totalDisability' => 0,
  'disabilityPct' => null,
  'class' => '',
])

@php
  $updatedLabel = $updatedAt ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s')) : now()->format('Y-m-d H:i:s');
  $fmt = fn($n) => number_format((int)$n, 0, ',', '.');

  $gapVal = is_null($gap) ? ((int)$formasi - (int)$jumlahPegawai) : (int)$gap;
  $gapPctVal = !is_null($gapPct) ? $gapPct : ($formasi > 0 ? round(($gapVal / $formasi) * 100, 1).'%' : '0%');
  $gapColor = $gapVal > 0 ? '#16a34a' : ($gapVal < 0 ? '#ef4444' : '#64748b');

  $malePct   = ($jumlahPegawai > 0) ? round(($male / max(1,$jumlahPegawai)) * 100, 1).'%'   : '0%';
  $femalePct = ($jumlahPegawai > 0) ? round(($female / max(1,$jumlahPegawai)) * 100, 1).'%' : '0%';


  // Disability percent otomatis bila tidak diberikan
  $disPct = !is_null($disabilityPct)
    ? (is_string($disabilityPct) ? $disabilityPct : (round((float)$disabilityPct,2).'%'))
    : ($jumlahPegawai > 0 ? number_format(($totalDisability / max(1,$jumlahPegawai)) * 100, 2, ',', '.') . '%' : '0%');
@endphp

<div class="tw-rounded-2xl tw-bg-white tw-border tw-border-gray-200 tw-p-5 {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-4">
    <div class="tw-text-sm tw-font-semibold tw-text-gray-800">{{ strtoupper($title) }}</div>
    <div class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</div>
  </div>

  <!-- Section: Total Kepegawaian -->
  <div class="tw-text-[11px] tw-font-semibold tw-text-gray-700 tw-mb-2">TOTAL KEPEGAWAIAN</div>
  <div class="tw-grid tw-grid-cols-3 tw-gap-x-8 tw-gap-y-3 tw-items-center">
    <!-- Formasi -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-blue-100">
        <i class="ti ti-clipboard-list tw-text-blue-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-blue-600">{{ $fmt($formasi) }}</div>
        <div class="tw-text-[11px] tw-text-gray-500">Formasi Pegawai</div>
      </div>
    </div>
    <!-- Jumlah Pegawai -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-green-100">
        <i class="ti ti-users tw-text-green-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-green-600">{{ $fmt($jumlahPegawai) }}</div>
        <div class="tw-text-[11px] tw-text-gray-500">Jumlah Pegawai</div>
      </div>
    </div>
    <!-- Disability (baru) -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-sky-100">
        <i class="ti ti-wheelchair tw-text-sky-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-sky-600">{{ $fmt($totalDisability) }} <span class="tw-text-[11px] tw-text-sky-700">({{ $disPct }})</span></div>
        <div class="tw-text-[11px] tw-text-gray-500">Disability</div>
      </div>
    </div>
  </div>

  <!-- Section: GAP -->
  <div class="tw-text-[11px] tw-font-semibold tw-text-gray-700 tw-mt-5 tw-mb-2">GAP</div>
  <div class="tw-grid tw-grid-cols-2 tw-gap-x-8 tw-gap-y-3 tw-items-center">
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-gray-100">
        <i class="ti ti-arrows-left-right tw-text-gray-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold" style="color:{{ $gapColor }}">{{ $gapVal >= 0 ? '+'.$fmt($gapVal) : $fmt($gapVal) }}</div>
        <div class="tw-text-[11px] tw-text-gray-500">GAP</div>
      </div>
    </div>
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-violet-100">
        <i class="ti ti-percent tw-text-violet-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-violet-600">{{ is_string($gapPctVal)?$gapPctVal:($gapPctVal.'%') }}</div>
        <div class="tw-text-[11px] tw-text-gray-500">%GAP</div>
      </div>
    </div>
  </div>

{{-- Section Gender  --}}
  <div class="tw-text-[11px] tw-font-semibold tw-text-gray-700 tw-mt-5 tw-mb-2">GENDER</div>
  <div class="tw-grid tw-grid-cols-2 tw-gap-x-8 tw-gap-y-3 tw-items-center">
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-blue-100">
        <i class="ti ti-gender-male tw-text-blue-600"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-blue-600">{{ $fmt($male) }} ({{ $malePct }})</div>
        <div class="tw-text-[11px] tw-text-gray-500">Male</div>
      </div>
    </div>
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="tw-w-10 tw-h-10 tw-rounded-2xl tw-flex tw-items-center tw-justify-center tw-bg-amber-100">
        <i class="ti ti-gender-female tw-text-amber-500"></i>
      </div>
      <div class="tw-leading-tight">
        <div class="tw-text-sm tw-font-semibold tw-text-amber-600">{{ $fmt($female) }} ({{ $femalePct }})</div>
        <div class="tw-text-[11px] tw-text-gray-500">Female</div>
      </div>
    </div>
  </div>
</div>