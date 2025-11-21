@props([
  // DOM id unik untuk chart
  'chartId'        => 'retirement-chart',
  // Kategori tahun (string[])
  'years'          => null,
  // Data jumlah pensiun per tahun (number[])
  'series'         => null,
  // Tinggi area chart (bukan tinggi card total)
  'chartHeight'    => 140,
  // Waktu update (Carbon|string|null)
  'updatedAt'      => null,
  // Judul
  'title'          => 'Pegawai Pensiun',
  // Ikon header (Tabler Icons)
  'icon'           => 'ti ti-walk',
  // Warna garis
  'lineColor'      => '#0d60ff',
  // Gunakan format angka lokal (1.234)
  'useLocaleFormat'=> true,
  // Class tambahan
  'class'          => '',
  // Header gradient
  'headerFrom'     => '#0053D9',
  'headerTo'       => '#0038A8',
])

@php
  // Fallback data sesuai gambar
  $defaultYears  = ['2025','2026','2027','2028','2029'];
  $defaultSeries = [43,222,248,231,238];
  if (!is_array($years)  || !count($years))  $years  = $defaultYears;
  if (!is_array($series) || !count($series)) $series = $defaultSeries;

  $updatedLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s'))
    : now()->format('Y-m-d H:i:s');
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-0 {{ $class }}">
  <!-- Header biru -->
  <div class="tw-rounded-t-2xl tw-px-4 tw-py-2 tw-flex tw-items-center tw-justify-between"
       style="background:linear-gradient(90deg, {{ $headerFrom }} 0%, {{ $headerTo }} 100%);">
    <div class="tw-flex tw-items-center tw-gap-2">
      <i class="{{ $icon }} tw-text-white tw-text-sm"></i>
      <span class="tw-text-[11px] tw-font-semibold tw-tracking-wide tw-text-white">{{ $title }}</span>
    </div>
    <span class="tw-text-[10px] tw-font-medium tw-text-white/90">{{ $updatedLabel }}</span>
  </div>

  <!-- Chart container -->
  <div class="tw-px-3 tw-pt-3 tw-pb-2">
    <div id="{{ $chartId }}" style="height:{{ (int)$chartHeight }}px;"></div>
  </div>
</div>

@push('after-scripts')
<script>
(function(){
  const el = document.getElementById('{{ $chartId }}');
  if(!el) return;

  // Muat ApexCharts jika belum ada
  function ensureApex(cb){
    if(window.ApexCharts){ cb(true); return; }
    let s = document.getElementById('apexcharts-cdn');
    if(!s){
      s = document.createElement('script');
      s.id = 'apexcharts-cdn';
      s.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
      s.async = true;
      s.onload = () => cb(true);
      s.onerror = () => cb(false);
      document.head.appendChild(s);
    } else {
      s.addEventListener('load', () => cb(true), { once:true });
      s.addEventListener('error', () => cb(false), { once:true });
    }
  }

  const years  = @json($years);
  const data   = @json($series);
  const useLoc = {{ $useLocaleFormat ? 'true' : 'false' }};

  function fmt(v){
    if(v==null) return '';
    return useLoc ? Number(v).toLocaleString('de-DE') : String(v);
  }

  const options = {
    chart: { type:'line', height: {{ (int)$chartHeight }}, toolbar:{ show:false }, fontFamily:'inherit' },
    series: [{ name:'Jumlah', data: data }],
    stroke: { curve:'smooth', width:3 },
    markers: { size:4, strokeWidth:2, strokeColors:'#ffffff' },
    colors: ['{{ $lineColor }}'],
    xaxis: {
      categories: years,
      labels: { style:{ fontSize:'10px' } },
      axisTicks: { show:false },
      axisBorder: { show:false }
    },
    yaxis: {
      labels: { style:{ fontSize:'10px' }, formatter: (v)=>fmt(v) },
      decimalsInFloat: 0
    },
    dataLabels: {
      enabled: true,
      offsetY: -8,
      background: { enabled:false },
      style: { fontSize:'11px', fontWeight:600, colors:['#0D3FAA'] },
      formatter: (v)=>fmt(v)
    },
    grid: {
      strokeDashArray: 3,
      borderColor: '#e5e7eb',
      padding: { top: 0, right: 6, left: 6, bottom: 0 }
    },
    tooltip: { y: { formatter: (v)=>fmt(v) } },
    legend: { show:false }
  };

  ensureApex((ok) => {
    if(!ok){ console.error('[Retirement] gagal memuat ApexCharts'); return; }
    // Hindari double-render
    if(el.__chartInstance){ try { el.__chartInstance.destroy(); } catch(e){} }
    const chart = new ApexCharts(el, options);
    el.__chartInstance = chart;
    chart.render();
  });
})();
</script>
@endpush