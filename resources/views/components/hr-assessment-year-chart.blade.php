@props([
  'chartId' => 'assessment-year-chart',
  'years'   => ['2018','2020','2021','2022','2023','2024','2025'],
  'series'  => [3,9,947,690,996,4769,1565],
  'height'  => 200,
  'title'   => 'Tahun Assessment',
])

<div class="tw-rounded-2xl tw-border tw-border-blue-700/60 tw-bg-white tw-overflow-hidden">
  <div class="tw-bg-blue-700 tw-text-white tw-px-4 tw-py-2 tw-flex tw-items-center tw-gap-2">
    <i class="ti ti-clock-hour-4 tw-text-sm"></i>
    <span class="tw-text-xs tw-font-semibold tracking-wide">{{ strtoupper($title) }}</span>
  </div>
  <div class="tw-p-3">
    <div id="{{ $chartId }}" style="height:{{ $height }}px"></div>
  </div>
</div>

@push('after-scripts')
<script>
(function(){
  const el = document.querySelector('#{{ $chartId }}');
  if(!el || typeof ApexCharts === 'undefined') return;
  const options = {
    chart:{ type:'line', height:{{ $height }}, toolbar:{show:false}, zoom:{enabled:false}, fontFamily:'inherit' },
    series:[{ name:'Assessment', data:@json($series) }],
    xaxis:{ categories:@json($years), labels:{ style:{ fontSize:'11px' } } },
    stroke:{ width:3, curve:'smooth', colors:['#e02424'] },
    markers:{ size:4, strokeWidth:2, strokeColors:'#fff', colors:['#e02424'] },
    dataLabels:{
      enabled:true,
      style:{ fontSize:'11px', fontWeight:600 },
      formatter:(val)=> val.toLocaleString()
    },
    yaxis:{ labels:{ style:{ fontSize:'11px' } } },
    grid:{ strokeDashArray:3, borderColor:'#e2e8f0' },
    tooltip:{ y:{ formatter:val=> val.toLocaleString() } }
  };
  new ApexCharts(el, options).render();
})();
</script>
@endpush