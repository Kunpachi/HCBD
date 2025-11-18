@props([
  'noData' => 0,
  'totalTalentmap' => 3251,
  'percentTalentmap' => '25,53%',
  'tiles' => null,         // jika null: jangan override -> biarkan komponen anak pakai default
  'updatedAt' => null,
  'class' => '',
])

@php
  $updatedLabel = $updatedAt ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans()) : 'Updated just now';
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-px-4 tw-pt-4 tw-pb-4 {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-3">
    <h5 class="tw-text-sm tw-font-semibold tw-tracking-wide tw-text-blue-700 tw-m-0">Talentmap</h5>
    <span class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>
  <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-x-5 tw-gap-y-1 tw-mb-3">
    <div class="tw-text-[12px] tw-text-gray-700">No Data <span class="tw-font-semibold">{{ number_format((int)$noData) }}</span></div>
    <div class="tw-text-[12px] tw-text-gray-700">Total <span class="tw-font-semibold">{{ number_format((int)$totalTalentmap) }}</span></div>
    <div class="tw-text-[12px] tw-text-gray-700"><span class="tw-font-semibold">{{ $percentTalentmap }}</span> <span class="tw-italic tw-text-gray-500">(belum memiliki talentmapping)</span></div>
  </div>

  {{-- Penting: hanya kirim prop tiles jika pengguna memang mengirim. Kalau tidak, biarkan komponen anak memakai default-nya. --}}
  @if(is_array($tiles))
    <x-hr-talentmap :tiles="$tiles" :colsSm="2" :colsMd="3" :colsLg="3" :colsXl="3" dense="true" :tileMinH="64" />
  @else
    <x-hr-talentmap :colsSm="2" :colsMd="3" :colsLg="3" :colsXl="3" dense="true" :tileMinH="64" />
  @endif
</div>