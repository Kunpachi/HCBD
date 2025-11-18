@props([
  'chartId' => 'person-grade-chart',
  'grades'  => ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B'],
  'series'  => [49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3], // sample
  'height'  => 230,
  'title'   => 'Person Grade',
])

<div class="tw-rounded-2xl tw-border tw-border-blue-700/60 tw-bg-white tw-overflow-hidden">
  <div class="tw-bg-blue-700 tw-text-white tw-px-4 tw-py-2 tw-flex tw-items-center tw-gap-2">
    <i class="ti ti-users-group tw-text-sm"></i>
    <span class="tw-text-xs tw-font-semibold tracking-wide">{{ strtoupper($title) }}</span>
  </div>
  <div class="tw-p-3">
    <div id="{{ $chartId }}" class="tw-w-full" style="height:{{ $height }}px"></div>
  </div>
</div>

@push('after-scripts')
<script>
(function(){
  const el = document.querySelector('#{{ $chartId }}');
  if(!el || typeof ApexCharts === 'undefined') return;
  const options = {
    chart: {
      type: 'bar',
      height: {{ $height }},
      toolbar: { show:false },
      fontFamily: 'inherit'
    },
    series: [{
      name: 'Jumlah',
      data: @json($series)
    }],
    xaxis: {
      categories: @json($grades),
      labels: { style:{ fontSize:'11px' } }
    },
    dataLabels: {
      enabled: true,
      style:{ fontSize:'11px', colors:['#0d47a1'] },
      formatter: (val)=> val.toLocaleString()
    },
    plotOptions: {
      bar: {
        columnWidth: '45%',
        borderRadius: 3
      }
    },
    colors: ['#0d60ff'],
    yaxis: {
      labels:{ style:{ fontSize:'11px' } }
    },
    grid: {
      strokeDashArray: 3,
      borderColor: '#e2e8f0'
    },
    tooltip: {
      y: { formatter: val => val.toLocaleString() }
    }
  };
  new ApexCharts(el, options).render();
})();
</script>
@endpush