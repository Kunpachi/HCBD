@props([
  'noData'=>0,'totalTalentmap'=>0,'percentTalentmap'=>'0%',
  'tiles'=>null,'updatedAt'=>null,'class'=>'','compact'=>true,
])

@php
  $updatedLabel = $updatedAt ? (is_string($updatedAt)?$updatedAt:$updatedAt->diffForHumans()) : 'Updated just now';
  $pad = $compact ? 'tw-px-4 tw-pt-4 tw-pb-4' : 'tw-px-5 tw-pt-5 tw-pb-5';
  $titleSize = $compact ? 'tw-text-xs' : 'tw-text-sm';
  $metaSize  = $compact ? 'tw-text-[11px]' : 'tw-text-[12px]';
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white {{ $pad }} {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-3">
    <h5 class="{{ $titleSize }} tw-font-semibold tw-tracking-wide tw-text-blue-700 tw-m-0">Talentmap</h5>
    <span class="tw-text-[10px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>
  <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-x-4 tw-gap-y-1 tw-mb-3">
    <div class="{{ $metaSize }} tw-text-gray-700">No Data <span class="tw-font-semibold">{{ number_format((int)$noData) }}</span></div>
    <div class="{{ $metaSize }} tw-text-gray-700">Total <span class="tw-font-semibold">{{ number_format((int)$totalTalentmap) }}</span></div>
    <div class="{{ $metaSize }} tw-text-gray-700"><span class="tw-font-semibold">{{ $percentTalentmap }}</span> <span class="tw-italic tw-text-gray-500">(belum memiliki talentmapping)</span></div>
  </div>
  <x-hr-talentmap
    :tiles="$tiles ?? []"
    compact="true"
    tileMinH="52"
    colsSm="3" colsMd="4" colsLg="5" colsXl="6"
    dense="true"
  />
</div>x