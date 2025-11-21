@props([
  'chartId'        => 'person-grade-chart',
  'grades'         => null,
  'series'         => null,
  'chartHeight'    => 210,
  'updatedAt'      => null,
  'title'          => 'Person Grade',
  'headerFrom'     => '#0053D9',
  'headerTo'       => '#003EB3',
  'barColor'       => '#004BFF',
  'useLocaleFormat'=> true,
  'class'          => '',
  'retryDelay'     => 300,   // ms jeda retry menunggu ApexCharts
  'maxRetry'       => 10,    // jumlah maksimal percobaan render
])

@php
  $defaultGrades = ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B'];
  $defaultSeries = [49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3];

  if(!is_array($grades) || !count($grades)) $grades = $defaultGrades;
  if(!is_array($series) || !count($series)) $series = $defaultSeries;

  $updatedLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s'))
    : now()->format('Y-m-d H:i:s');
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-0 {{ $class }}">
  <div class="tw-rounded-t-2xl tw-px-4 tw-py-2 tw-flex tw-items-center tw-justify-between"
       style="background:linear-gradient(90deg, {{ $headerFrom }} 0%, {{ $headerTo }} 100%);">
    <div class="tw-flex tw-items-center tw-gap-2">
      <i class="ti ti-users-group tw-text-white tw-text-sm"></i>
      <span class="tw-text-[11px] tw-font-semibold tw-tracking-wide tw-text-white">{{ strtoupper($title) }}</span>
    </div>
    <span class="tw-text-[10px] tw-font-medium tw-text-white/90">{{ $updatedLabel }}</span>
  </div>

  <div class="tw-px-3 tw-pt-3 tw-pb-2">
    <div id="{{ $chartId }}" style="height:{{ (int)$chartHeight }}px;"></div>
  </div>
</div>

@push('after-scripts')
<script>
(function(){
  const chartId     = '{{ $chartId }}';
  const chartHeight = {{ (int)$chartHeight }};
  const barColor    = '{{ $barColor }}';
  const useLocale   = {{ $useLocaleFormat ? 'true' : 'false' }};
  const retryDelay  = {{ (int)$retryDelay }};
  const maxRetry    = {{ (int)$maxRetry }};
  const grades      = @json($grades);
  const rawData     = @json($series);

  let attempts = 0;

  function fmt(v){
    if(v==null) return '';
    return useLocale ? Number(v).toLocaleString('de-DE') : String(v);
  }

  function buildOptions(){
    return {
      chart: { type:'bar', height:chartHeight, toolbar:{ show:false }, fontFamily:'inherit' },
      series: [{ name:'Jumlah', data: rawData }],
      xaxis: {
        categories: grades,
        labels: { style:{ fontSize:'10px' }, rotate:0 },
        axisBorder:{ show:true, color:'#666' },
        axisTicks:{ show:false }
      },
      yaxis: {
        labels:{ style:{ fontSize:'10px' }, formatter: v => fmt(v) }
      },
      plotOptions: {
        bar:{ columnWidth:'42%', borderRadius:0, dataLabels:{ position:'top' } }
      },
      dataLabels: {
        enabled:true,
        offsetY:-6,
        style:{ fontSize:'11px', fontWeight:600, colors:['#0D3FAA'] },
        formatter: val => fmt(val)
      },
      colors:[barColor],
      grid:{ strokeDashArray:3, borderColor:'#e5e7eb', padding:{ top:5, right:5, left:5, bottom:0 } },
      tooltip:{ y:{ formatter: v => fmt(v) } },
      legend:{ show:false }
    };
  }

  function ensureApex(callback){
    if(window.ApexCharts){ callback(true); return; }
    let s = document.getElementById('apexcharts-cdn');
    if(!s){
      s = document.createElement('script');
      s.id = 'apexcharts-cdn';
      s.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
      s.async = true;
      s.onload = () => callback(true);
      s.onerror = () => callback(false);
      document.head.appendChild(s);
    } else {
      s.addEventListener('load', () => callback(true), { once:true });
      s.addEventListener('error', () => callback(false), { once:true });
    }
  }

  function tryRender(){
    const el = document.getElementById(chartId);
    if(!el){
      console.warn('[PersonGrade] Elemen chartId tidak ditemukan:', chartId);
      return;
    }
    if(!window.ApexCharts){
      if(attempts < maxRetry){
        attempts++;
        setTimeout(tryRender, retryDelay);
      } else {
        console.error('[PersonGrade] ApexCharts belum tersedia setelah retry:', attempts);
      }
      return;
    }
    // Cegah double render
    if(el.__chartInstance){
      try { el.__chartInstance.destroy(); } catch(e){}
    }
    const options = buildOptions();
    const chart = new ApexCharts(el, options);
    el.__chartInstance = chart;
    chart.render();
    console.info('[PersonGrade] Chart rendered attempts=', attempts);
  }

  // Jalankan
  ensureApex(ok => {
    if(!ok){ console.error('[PersonGrade] Gagal load ApexCharts CDN'); return; }
    tryRender();
  });
})();
</script>
@endpush