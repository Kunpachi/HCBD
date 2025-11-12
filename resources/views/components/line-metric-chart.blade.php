@props([
  'chartId'     => 'line-metric-chart-1',
  'title'       => 'Balance',
  'subtitle'    => 'Commercial networks & enterprises',
  'value'       => null,          // contoh: "$ 100,000"
  'delta'       => null,          // contoh: "-20%" atau "+12%"
  'color'       => '#F7A827',     // warna garis utama
  'series'      => [],            // array angka
  'labels'      => [],            // array label x-axis
  'height'      => 320,
  'smooth'      => true,
  'showGrid'    => true,
  'showMarkers' => false,
])

@php
  $isPositive = $delta && str_starts_with($delta, '+');
  $deltaClass = $isPositive ? 'tw-bg-green-50 tw-text-green-600' : 'tw-bg-gray-100 tw-text-gray-600';
@endphp

<div class="card tw-rounded-xl tw-shadow-sm tw-border tw-border-gray-100" data-line-chart-wrapper="{{ $chartId }}">
  <div class="card-header tw-border-none tw-bg-transparent tw-pb-0">
    <div class="tw-flex tw-items-start tw-justify-between tw-gap-4">
      <div>
        <h5 class="tw-text-lg tw-font-semibold tw-mb-0">{{ $title }}</h5>
        @if($subtitle)
          <p class="tw-text-sm tw-text-gray-500 tw-mt-1 tw-mb-0">{{ $subtitle }}</p>
        @endif
      </div>
      @if($value || $delta)
        <div class="tw-text-right tw-flex tw-flex-col tw-items-end tw-gap-1">
          @if($value)
            <div class="tw-text-xl tw-font-semibold tw-text-gray-700">{{ $value }}</div>
          @endif
          @if($delta)
            <span class="tw-inline-flex tw-items-center tw-text-xs tw-font-medium tw-px-2 tw-py-1 tw-rounded {{ $deltaClass }}">
              {{ $delta }}
            </span>
          @endif
        </div>
      @endif
    </div>
  </div>
  <div class="card-body tw-pt-2">
    <div id="{{ $chartId }}"
         data-line-chart="true"
         data-series='@json($series)'
         data-labels='@json($labels)'
         data-color='{{ $color }}'
         data-height='{{ $height }}'
         data-smooth='{{ $smooth ? "1" : "0" }}'
         data-grid='{{ $showGrid ? "1" : "0" }}'
         data-markers='{{ $showMarkers ? "1" : "0" }}'
         style="min-height: {{ $height }}px"></div>
  </div>
</div>