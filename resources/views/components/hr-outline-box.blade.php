@props([
  'title'        => 'TITLE',
  'updatedAt'    => null,            // Carbon|string|null
  'items'        => [],              // [['label'=>'Male','value'=>0,'percent'=>'(0%)','hint'=>null], ...]
  'columns'      => 1,               // jumlah kolom grid internal
  'class'        => '',
  'showPercent'  => true,
  'forceLight'   => true,            // paksa background putih
])

@php
  $nowLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
    : 'Updated just now';

  $normalized = collect($items)->map(fn($it) => [
    'label'   => $it['label']   ?? '-',
    'value'   => $it['value']   ?? 0,
    'percent' => $it['percent'] ?? null,
    'hint'    => $it['hint']    ?? null,
  ]);

  // Tentukan kelas grid berdasarkan kolom
  $gridColsClass = match($columns){
    2 => 'sm:tw-grid-cols-2',
    3 => 'sm:tw-grid-cols-3',
    4 => 'sm:tw-grid-cols-4',
    default => 'sm:tw-grid-cols-1'
  };

  $containerSkin = $forceLight
    ? 'tw-bg-white tw-border-gray-200 dark:tw-bg-white dark:tw-border-gray-200'
    : 'tw-bg-white tw-border-gray-200 dark:tw-bg-slate-800 dark:tw-border-gray-700';
@endphp

<div class="tw-rounded-3xl tw-border tw-shadow-sm {{ $containerSkin }} tw-p-5 {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-4">
    <h5 class="tw-text-sm tw-font-semibold tw-text-gray-800 tw-tracking-wide tw-m-0">{{ strtoupper($title) }}</h5>
    <span class="tw-text-[11px] tw-text-gray-500">{{ $nowLabel }}</span>
  </div>

  <div class="tw-grid tw-gap-4 {{ $gridColsClass }}">
    @foreach($normalized as $row)
      <div class="tw-flex tw-flex-col tw-items-stretch">
        <div class="tw-border tw-border-gray-300 tw-rounded-lg tw-px-4 tw-py-3 tw-bg-white hover:tw-border-indigo-500 tw-transition">
          <div class="tw-flex tw-items-center tw-justify-between">
            <span class="tw-text-sm tw-font-medium tw-text-gray-800">{{ $row['label'] }}</span>
            @if($row['hint'])
              <i class="ti ti-info-circle tw-text-gray-400 tw-text-xs" data-bs-toggle="tooltip" title="{{ $row['hint'] }}"></i>
            @endif
          </div>
          <div class="tw-mt-2 tw-text-base tw-font-semibold tw-text-gray-900">
            {{ $row['value'] }}
            @if($showPercent && $row['percent'])
              <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $row['percent'] }}</span>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>