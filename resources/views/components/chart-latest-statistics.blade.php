@props([
  // Boleh kirim data dari controller, jika kosong akan pakai default di JS
  'seriesData' => null,     // contoh: [270,85,185,...]
  'categories' => null,     // contoh: ['7/12','8/12',...]
  'title' => 'Person Grade',
])

@php
  $seriesJson = $seriesData ? json_encode($seriesData) : '';
  $catsJson   = $categories ? json_encode($categories) : '';
@endphp

<div class="card tw-rounded-2xl tw-shadow-sm tw-border tw-border-gray-100">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ $title }}</h5>
    <div class="d-flex align-items-center gap-2">
      <button class="btn btn-text-secondary btn-sm" type="button" aria-label="Pick Date">
        <i class="ti ti-calendar"></i>
      </button>
      <button class="btn btn-text-secondary btn-sm" type="button" aria-label="More">
        <i class="ti ti-chevron-down"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div
      id="latest-stats-chart"
      class="tw-w-full"
      style="min-height: 320px"
      data-series='@json($seriesJson)'
      data-categories='@json($catsJson)'>
    </div>
  </div>
</div>