@props([
  'title'   => 'User by Devices',
  'chartId' => 'devices-donut-chart',
  // Opsional: kirim data dari controller
  'labels'  => ['Desktop','Tablet','Mobile'],
  'series'  => [80,10,10],
])

@php
  $labelsJson = json_encode($labels);
  $seriesJson = json_encode($series);
@endphp

<div class="card tw-rounded-2xl tw-shadow-sm tw-border tw-border-gray-100">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ $title }}</h5>
  </div>
  <div class="card-body">
    <div id="{{ $chartId }}"
         style="min-height: 320px"
         data-labels='@json($labelsJson)'
         data-series='@json($seriesJson)'></div>

    <!-- Legend kustom akan diisi via JS -->
    <div data-legend-for="{{ $chartId }}" class="tw-grid tw-grid-cols-3 tw-gap-y-2 tw-mt-4"></div>
  </div>
</div>