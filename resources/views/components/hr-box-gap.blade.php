@props([
  'title'          => 'GAP',
  'updatedAt'      => null,
  'male'           => 0,
  'female'         => 0,
  'totalEmployees' => null,     // jika null: denominator = male + female
  'compact'        => true,
  'class'          => '',
  'showHint'       => true,
  'linkBase'       => null,     // contoh: route('hr.gap')
  // Jika ingin definisi lain (kebutuhan, pensiun) bisa tambah prop requirementMale dll.
])

@php
  $updatedLabel = $updatedAt
      ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
      : 'Updated just now';

  $denom   = $totalEmployees !== null ? (int)$totalEmployees : ((int)$male + (int)$female);
  $gap     = abs((int)$male - (int)$female);
  $gapPctN = $denom > 0 ? round($gap / $denom * 100) : 0;
  $gapPct  = '(' . $gapPctN . '%)';

  $chipSizeClass  = $compact ? 'tw-w-9 tw-h-9 tw-rounded-lg' : 'tw-w-11 tw-h-11 tw-rounded-xl';
  $iconSizeClass  = $compact ? 'tw-text-base' : 'tw-text-lg';
  $valueTextClass = $compact ? 'tw-text-sm' : 'tw-text-base';
  $titleTextClass = $compact ? 'tw-text-xs' : 'tw-text-sm';
  $outerPadding   = $compact ? 'tw-px-4 tw-pt-4 tw-pb-4' : 'tw-px-5 tw-pt-5 tw-pb-5';

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

  <div class="tw-grid tw-gap-4 sm:tw-grid-cols-2">
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#gap','tw-bg-violet-100','ti ti-arrows-left-right','tw-text-violet-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $gap }}
          <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $gapPct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">GAP</div>
      </div>
    </div>
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#gap-percent','tw-bg-fuchsia-100','ti ti-percentage','tw-text-fuchsia-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $gapPctN }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">(%)</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">GAP%</div>
      </div>
    </div>
  </div>

  {{-- @if($showHint)
    <div class="tw-mt-3 tw-text-[10px] tw-text-gray-500">
      GAP = selisih jumlah Male vs Female. GAP% = GAP / {{ $denom ?: 1 }} × 100.
    </div>
  @endif --}}
</div>