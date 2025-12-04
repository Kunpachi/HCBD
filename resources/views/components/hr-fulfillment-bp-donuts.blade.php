@props([
  'items' => [],
  'size' => 88,
  'ringThickness' => 20,
  'class' => '',
  'blue' => '#083BD9',
  'red'  => '#E00000',
  'textColor' => '#000000',
])

@php
  if(!is_array($items) || count($items) < 4){
    $items = [
      ['label'=>'BP-Risk Management','value'=>99.1],
      ['label'=>'BP-Distribution & Funding','value'=>97.0],
      ['label'=>'BP-IT & Operations','value'=>97.6],
      ['label'=>'BP-Wholesale, Consumer & Finance','value'=>98.8],
    ];
  }
  $donutSizePct = max(50, min(85, round(100 - (2 * ($ringThickness / $size) * 100))));
  $fmtPct = fn($n) => number_format((float)$n, 1, ',', '.') . '%';
@endphp

<style>
  .bp-strip-wrap { width: 100%; }
  .bp-strip {
    background: #083BD9;
    color: #fff;
    border-radius: 10px;
    padding: 4px 8px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    align-items: center;
  }
  .bp-strip > div { text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .bp-donut-row { margin-top: 6px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; align-items: start; justify-items: center; }
  .donut-wrap { position: relative; width: var(--donut-size, 88px); height: var(--donut-size, 88px); overflow: visible; }
  .bp-donut-canvas { width: 100%; height: 100%; display: block; overflow: visible; }
  .donut-center-label { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); font-size: 12px; font-weight: 800; color: {{ $textColor }}; line-height: 1; pointer-events: none; z-index: 2; }
  .apexcharts-tooltip { z-index: 10 !important; }
</style>

<div class="bp-strip-wrap {{ $class }}">
  <div class="bp-strip">
    @foreach($items as $it)
      <div>{{ $it['label'] ?? '-' }}</div>
    @endforeach
  </div>

  <div class="bp-donut-row">
    @foreach($items as $i => $it)
      @php
        $id  = 'bpKpiDonut'.$i;
        $pct = (float)($it['value'] ?? 0);
      @endphp

      <div class="donut-wrap" style="--donut-size: {{ (int)$size }}px;">
        <div id="{{ $id }}" class="bp-donut-canvas"></div>
        <!-- Overlay angka default: Terpenuhi (biru) -->
        <div class="donut-center-label" id="{{ $id }}-center">{{ $fmtPct($pct) }}</div>
      </div>

      @push('after-scripts')
      <script>
        (function(){
          const chartEl = document.getElementById('{{ $id }}');
          const centerEl = document.getElementById('{{ $id }}-center');
          if(!chartEl || !centerEl) return;

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
            const fulfilled = {{ $pct }};
            const remaining = Math.max(0, 100 - fulfilled);

            // Helper: format ke 1 desimal dengan koma
            const fmt = (n)=>Number(n).toLocaleString('de-DE',{minimumFractionDigits:1,maximumFractionDigits:1})+'%';

            const options = {
              chart: {
                type: 'donut',
                width: {{ (int)$size }},
                height: {{ (int)$size }},
                foreColor: '#000000',
                animations: { enabled: true },
                toolbar: { show: false },
                sparkline: { enabled: true },
                events: {
                  // Update label tengah saat klik segmen
                  dataPointSelection: function(event, chartContext, config) {
                    const idx = config.seriesIndex; // 0 = Terpenuhi, 1 = Belum Terpenuhi
                    if (idx === 0) {
                      centerEl.textContent = fmt(fulfilled);
                    } else if (idx === 1) {
                      centerEl.textContent = fmt(remaining);
                    }
                  },
                  // Reset ke default (Terpenuhi) saat mouse keluar chart
                  mouseLeave: function() {
                    centerEl.textContent = fmt(fulfilled);
                  }
                }
              },
              series: [fulfilled, remaining],
              labels: ['Terpenuhi', 'Belum Terpenuhi'],
              colors: ['{{ $blue }}','{{ $red }}'],
              stroke: { width: 2, colors: ['#FFFFFF'] },
              dataLabels: { enabled: false },
              legend: { show: false },
              plotOptions: {
                pie: {
                  startAngle: -90,
                  endAngle: 270,
                  expandOnClick: true, // agar klik segmen terasa
                  donut: {
                    size: '{{ (int)$donutSizePct }}%',
                    labels: {
                      show: false, // kita pakai overlay manual
                      name: { show: false },
                      value: { show: false },
                      total: { show: false }
                    }
                  }
                }
              },
              tooltip: {
                enabled: true,
                y: {
                  formatter: function(val, opts){
                    const label = opts.seriesIndex === 0 ? 'Terpenuhi' : 'Belum Terpenuhi';
                    const pctTxt = Number(val).toFixed(1).replace('.', ',') + '%';
                    return label + ': ' + pctTxt;
                  }
                }
              }
            };

            const chart = new ApexCharts(chartEl, options);
            chart.render();

            // Optional: reset ke default saat klik di luar chart area
            document.addEventListener('click', function(e){
              if(!chartEl.contains(e.target)){
                centerEl.textContent = fmt(fulfilled);
              }
            });
          });
        })();
      </script>
      @endpush
    @endforeach
  </div>
</div>