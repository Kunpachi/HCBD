@php
  // Pastikan $tmTiles optional; jika tidak ada akan pakai default di komponen
  $tmNoData  = $tmNoData  ?? 0;
  $tmTotal   = $tmTotal   ?? 3251;
  $tmPercent = $tmPercent ?? '25,53%';

  $pgLabels  = $pgLabels ?? ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B'];
  $pgSeries  = $pgSeries ?? [49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3];
@endphp

<div class="row g-4 mb-5">
  <div class="col-12 col-lg-8 d-flex">
    <x-hr-talentmap-card
      :tiles="$tmTiles ?? null"
      :noData="$tmNoData"
      :totalTalentmap="$tmTotal"
      :percentTalentmap="$tmPercent"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
  <div class="col-12 col-lg-4 d-flex">
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