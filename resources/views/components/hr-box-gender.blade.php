@props([
  'title'          => 'Gender',
  'updatedAt'      => null,
  'male'           => 0,
  'female'         => 0,
  'malePct'        => null,          // jika null & totalEmployees ada -> dihitung otomatis
  'femalePct'      => null,
  'totalEmployees' => null,          // opsional untuk auto persentase
  'compact'        => true,          // samakan style compact dg card lain
  'class'          => '',
  'showHint'       => false,
  'linkBase'       => null,          // contoh: route('hr.gender')
])

@php
  $updatedLabel = $updatedAt
      ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
      : 'Updated just now';

  if(($malePct === null || $femalePct === null) && $totalEmployees !== null){
    $pct = fn($v,$t) => $t>0 ? '(' . round($v/$t*100) . '%)' : '(0%)';
    $malePct   = $malePct   ?? $pct($male,$totalEmployees);
    $femalePct = $femalePct ?? $pct($female,$totalEmployees);
  }
  $malePct   = $malePct   ?? '(0%)';
  $femalePct = $femalePct ?? '(0%)';

  // Kelas compact (disamakan dengan total/generation)
  $chipSizeClass  = $compact ? 'tw-w-9 tw-h-9 tw-rounded-lg' : 'tw-w-11 tw-h-11 tw-rounded-xl';
  $iconSizeClass  = $compact ? 'tw-text-base' : 'tw-text-lg';
  $valueTextClass = $compact ? 'tw-text-sm' : 'tw-text-base';
  $titleTextClass = $compact ? 'tw-text-xs' : 'tw-text-sm';
  $outerPadding   = $compact ? 'tw-px-4 tw-pt-4 tw-pb-4' : 'tw-px-5 tw-pt-5 tw-pb-5';

  // Helper ikon → tautan bila ada linkBase
  $chip = function(string $anchor, string $bg, string $icon, string $iconColor) use ($chipSizeClass,$iconSizeClass,$linkBase){
    if($linkBase){
      return '<a href="'.e($linkBase.$anchor).'" class="'.$chipSizeClass.' tw-flex tw-items-center tw-justify-center '.$bg.' hover:tw-scale-[1.02] tw-transition" title="Lihat '.$anchor.'"><i class="'.$icon.' '.$iconSizeClass.' '.$iconColor.'"></i></a>';
    }
    return '<div class="'.$chipSizeClass.' tw-flex tw-items-center tw-justify-center '.$bg.'"><i class="'.$icon.' '.$iconSizeClass.' '.$iconColor.'"></i></div>';
  };
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white {{ $outerPadding }} {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-4">
    <h5 class="{{ $titleTextClass }} tw-font-semibold tw-tracking-wide tw-text-gray-800 tw-m-0">{{ strtoupper($title) }}</h5>
    <span class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>

  <!-- Grid 3 kolom agar seragam dengan "Total Kepegawaian" -->
  <div class="tw-grid tw-gap-4 sm:tw-grid-cols-3">
    <!-- Male -->
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#male','tw-bg-blue-100','ti ti-gender-male','tw-text-blue-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $male }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $malePct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">Male</div>
      </div>
    </div>

    <!-- Female -->
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#female','tw-bg-amber-100','ti ti-gender-female','tw-text-amber-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $female }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $femalePct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">Female</div>
      </div>
    </div>

    <!-- Placeholder kolom 3 untuk meratakan layout (tidak terlihat, hanya mengisi ruang) -->
    <div class="tw-flex tw-items-center tw-gap-3">
      <div class="{{ $chipSizeClass }} tw-invisible"></div>
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900 tw-invisible">0</div>
        <div class="tw-text-[11px] tw-text-gray-500 tw-invisible">—</div>
      </div>
    </div>
  </div>

  @if($showHint && $totalEmployees !== null)
    <div class="tw-mt-3 tw-text-[10px] tw-text-gray-500">
      Persentase dihitung dari total karyawan ({{ $totalEmployees }}).
    </div>
  @endif
</div>