@props([
  'items' => [],
  'class' => '',
  // Ukuran fleksibel
  'containerWidth' => '100%',
  'rowHeight' => 160,
  'lineWidth' => 3,
  'markerSize' => 6,
  'dataLabelFont' => 12,
  'bpTitleFont' => 28,
  'gridDash' => 3,
  // Tampilkan baris tahun manual di bawah chart? Default: tidak (hindari duplikasi dengan sumbu X)
  'showYearsRow' => false,
])

@php
  if(!is_array($items) || !count($items)){
    $items = [
      ['code'=>'BPDF','color'=>'#FF0000','data'=>[35,174,162,166,194],'years'=>[2025,2026,2027,2028,2029]],
      ['code'=>'BPIO','color'=>'#FF0000','data'=>[2,10,13,10,3],'years'=>[2025,2026,2027,2028,2029]],
      ['code'=>'BPRM','color'=>'#FF0000','data'=>[3,21,16,31,2],'years'=>[2025,2026,2027,2028,2029]],
      ['code'=>'BPWF','color'=>'#FF0000','data'=>[2,7,20,21,39],'years'=>[2025,2026,2027,2028,2029]],
    ];
  }
@endphp

<style>
  .retire-card {
    border-radius: 12px;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.08);
    padding: 12px;
    width: var(--retire-width, 100%);
  }
  .retire-header {
    background: #0A3BD9; color: #fff; border-radius: 12px; padding: 10px 14px;
    display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 16px;
  }
  .retire-icon {
    width: 16px; height: 16px; display: inline-block; border-radius: 50%;
    background: #fff; mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="black" d="M16 11c1.66 0 3-1.34 3-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3m-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3m0 2c-2.67 0-8 1.34-8 4v2h10v-2c0-2.66-5.33-4-8-4m8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.91 1.97 3.45v2h10v-2c0-2.66-5.33-4-8-4Z"/></svg>') center/contain no-repeat;
  }
  .retire-row { margin-top: 18px; }
  .retire-code { font-weight: 900; margin-bottom: 6px; }
  .sparkline { width: 100%; }
  .years { display: flex; justify-content: space-between; font-size: 12px; color: #7a7a7a; padding: 0 4px; margin-top: 6px; }
</style>

<div class="retire-card {{ $class }}" style="--retire-width: {{ $containerWidth }};">
  <div class="retire-header">
    <span class="retire-icon"></span>
    <span>Pegawai Pensiun</span>
  </div>

  @foreach($items as $i => $bp)
    @php
      $chartId = "retireSpark{$i}";
      $color = $bp['color'] ?? '#FF0000';
      $years = $bp['years'] ?? [];
      $data  = $bp['data'] ?? [];
    @endphp
    <div class="retire-row">
      <div class="retire-code" style="color: {{ $color }}; font-size: {{ (int)$bpTitleFont }}px;">{{ $bp['code'] ?? 'BP' }}</div>
      <div>
        <div id="{{ $chartId }}" class="sparkline" style="height: {{ (int)$rowHeight }}px;"></div>
        @if($showYearsRow && is_array($years) && count($years))
          <div class="years">
            @foreach($years as $y)
              <span>{{ $y }}</span>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    @push('after-scripts')
    <script>
      (function(){
        const el = document.getElementById('{{ $chartId }}');
        if(!el) return;

        function ensureApex(cb){
          if(window.ApexCharts){ cb(true); return; }
          let s=document.getElementById('apexcharts-cdn');
          if(!s){
            s=document.createElement('script');
            s.id='apexcharts-cdn';
            s.src='https://cdn.jsdelivr.net/npm/apexcharts@latest';
            s.onload=()=>cb(true);
            s.onerror=()=>cb(false);
            document.head.appendChild(s);
          } else {
            s.addEventListener('load',()=>cb(true),{once:true});
            s.addEventListener('error',()=>cb(false),{once:true});
          }
        }

        ensureApex(ok=>{
          if(!ok) return;
          const seriesData = {!! json_encode($data, JSON_UNESCAPED_UNICODE) !!};
          const years = {!! json_encode($years, JSON_UNESCAPED_UNICODE) !!};

          const options = {
            chart: {
              type: 'line',
              height: {{ (int)$rowHeight }},
              width: '100%',
              toolbar: { show: false },
              sparkline: { enabled: false }
            },
            stroke: { curve: 'smooth', width: {{ (int)$lineWidth }} },
            series: [{ name: '{{ $bp['code'] ?? 'BP' }}', data: seriesData }],
            colors: ['#1E5BFF'],
            markers: {
              size: {{ (int)$markerSize }},
              colors: ['#1E5BFF'],
              strokeColors: '#ffffff',
              strokeWidth: 3
            },
            dataLabels: {
              enabled: true,
              style: { fontSize: '{{ (int)$dataLabelFont }}px', fontWeight: '800' },
              offsetY: -10,
              background: {
                enabled: true,
                foreColor: '#ffffff',
                borderRadius: 6,
                padding: 6,
                opacity: 1,
                borderWidth: 0,
                dropShadow: { enabled: false }
              }
            },
            tooltip: { enabled: true },
            xaxis: {
              categories: years,
              labels: { style: { fontSize: '12px' } },
              axisBorder: { show: false },
              axisTicks: { show: false }
            },
            yaxis: {
              min: Math.min.apply(null, seriesData) - 2,
              max: Math.max.apply(null, seriesData) + 2,
              labels: { show: false }
            },
            grid: { show: true, strokeDashArray: {{ (int)$gridDash }}, borderColor: '#eaeef6' }
          };

          new ApexCharts(el, options).render();
        });
      })();
    </script>
    @endpush
  @endforeach
</div>