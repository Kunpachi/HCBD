@php
  // Sample data (ganti dari controller bila sudah tersedia)
  $tmTiles = $tmTiles ?? [
    ['label'=>'Solid Contributor','count'=>82,  'percent'=>'0,68%','icon'=>'ti ti-motorbike','gradient'=>['#F97316','#EA580C']],
    ['label'=>'Performer',        'count'=>1130,'percent'=>'9,37%','icon'=>'ti ti-trophy',   'gradient'=>['#16A34A','#15803D']],
    ['label'=>'Star',             'count'=>1268,'percent'=>'10,52%','icon'=>'ti ti-rocket',   'gradient'=>['#1D4ED8','#1E40AF']],
    ['label'=>'Slow Starter',     'count'=>371, 'percent'=>'3,08%','icon'=>'ti ti-bicycle',  'gradient'=>['#D97706','#B45309']],
    ['label'=>'Average',          'count'=>2409,'percent'=>'19,98%','icon'=>'ti ti-car',      'gradient'=>['#7C3AED','#6D28D9']],
    ['label'=>'Potential',        'count'=>3090,'percent'=>'25,63%','icon'=>'ti ti-rocket',   'gradient'=>['#65A30D','#4D7C0F']],
    ['label'=>'Unfit',            'count'=>52,  'percent'=>'0,43%','icon'=>'ti ti-run',      'gradient'=>['#991B1B','#7F1D1D']],
    ['label'=>'Slow Starter 2',   'count'=>197, 'percent'=>'1,63%','icon'=>'ti ti-run',      'gradient'=>['#DC2626','#B91C1C']],
    ['label'=>'Career Person',    'count'=>207, 'percent'=>'1,72%','icon'=>'ti ti-briefcase','gradient'=>['#BE185D','#9D174D']],
  ];
  $tmNoData  = $tmNoData ?? 0;
  $tmTotal   = $tmTotal ?? 3251;
  $tmPercent = $tmPercent ?? '25,53%';

  $pgLabels  = $pgLabels ?? ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B'];
  $pgSeries  = $pgSeries ?? [49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3];
@endphp

<div class="row g-4 mb-5">
  <div class="col-12 col-xxl-8 d-flex">
    <x-hr-talentmap-card
      :tiles="$tmTiles"
      :noData="$tmNoData"
      :totalTalentmap="$tmTotal"
      :percentTalentmap="$tmPercent"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
  <div class="col-12 col-xxl-4 d-flex">
    <x-hr-person-grade-card
      chartId="person-grade-chart"
      :grades="$pgLabels"
      :series="$pgSeries"
      :updatedAt="now()"
      height="320"
      class="tw-w-full"
    />
  </div>
</div>