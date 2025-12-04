@props([
  'title' => 'TITLE',
  'pct' => 0,
  'year' => 2025,
  'formasi' => 0,
  'include' => ['jmlPeg'=>0,'gap'=>0,'gapPct'=>0],
  'exclude' => ['jmlPeg'=>0,'gap'=>0,'gapPct'=>0],
  // tampilan
  'size' => 170,
  'ringThickness' => 30,
  'blue' => '#083BD9',
  'red' => '#E00000',
  // latar belakang siluet di belakang donut
  'skylineSvg' => '
    <svg viewBox="0 0 560 200" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <rect width="100%" height="100%" fill="transparent"/>
      <g fill="#E9EDF5">
        <rect x="20" y="140" width="40" height="40" rx="4"/>
        <rect x="80" y="120" width="30" height="60" rx="4"/>
        <rect x="120" y="100" width="24" height="80" rx="4"/>
        <rect x="160" y="130" width="36" height="50" rx="4"/>
        <rect x="210" y="80" width="26" height="100" rx="4"/>
        <rect x="250" y="115" width="28" height="65" rx="4"/>
        <rect x="290" y="90" width="20" height="90" rx="4"/>
        <rect x="320" y="130" width="34" height="50" rx="4"/>
        <rect x="360" y="70" width="22" height="110" rx="4"/>
        <rect x="392" y="120" width="40" height="60" rx="4"/>
        <rect x="440" y="135" width="30" height="45" rx="4"/>
      </g>
    </svg>
  ',
])

@php
  $fmtPct = fn($n) => number_format((float)$n, 1, ',', '.') . '%';
  $fmtNum = fn($n) => number_format((float)$n, 0, ',', '.');
  $donutSizePct = max(50, min(85, round(100 - (2 * ($ringThickness / max(1, $size)) * 100))));
  $id = 'jtDonut'.md5($title.$pct.$size.uniqid('', true));

  $gapBadge = function($v){
    $cl = $v >= 0 ? '#16A34A' : '#DC2626';
    $bg = $v >= 0 ? 'rgba(22,163,74,.12)' : 'rgba(220,38,38,.12)';
    $sign = $v > 0 ? '+' : '';
    return ['text' => $sign . number_format((float)$v, 0, ',', '.'), 'fg'=>$cl, 'bg'=>$bg];
  };
  $incGap = $gapBadge($include['gap'] ?? 0);
  $excGap = $gapBadge($exclude['gap'] ?? 0);
@endphp

<style>
  .jt-card {
    border-radius: 12px;
    background: #fff;
    border: 1px solid #e7eaf3;
    padding: 10px;
  }
  .jt-head {
    background: #083BD9;
    color: #fff;
    font-weight: 800;
    font-size: 14px;
    text-align: center;
    padding: 6px 10px;
    border-radius: 8px;
    letter-spacing: .3px;
    text-transform: uppercase;
  }

  .jt-hero {
    position: relative;
    margin: 8px 0 6px;
    height: calc({{ (int)$size }}px + 30px); /* ruang ekstra untuk skyline */
    overflow: visible;
  }
  .jt-skyline {
    position: absolute;
    inset: 0 0 auto 0;
    height: 100%;
    opacity: .65; /* samar */
    pointer-events: none;
  }

  .donut-wrap {
    position: relative;
    width: var(--jt-size, {{ (int)$size }}px);
    height: var(--jt-size, {{ (int)$size }}px);
    margin: 0 auto;
    z-index: 1;
  }
  .donut-canvas {
    width: 100%;
    height: 100%;
    display: block;
    overflow: visible;
  }
  .donut-center-label {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    font-size: 22px;
    font-weight: 900;
    color: #000;
    pointer-events: none;
  }

  /* Tabel ringkas menempel di bawah donut */
  .jt-table {
    margin-top: 4px;
    width: 100%;
  }
  .jt-row {
    display: grid;
    grid-template-columns: 140px 1fr 1fr 1fr;
    gap: 4px;
    align-items: center;
  }
  .jt-hd {
    background: #0A3BD9;
    color: #fff;
    font-weight: 800;
    font-size: 12px;
    padding: 6px 8px;
    border-radius: 8px;
  }
  
  .jt-hd.orange {
    background: #D97B00; /* oranye untuk exclude */
  }
  .jt-hd.dark {
    background: #0B2C7D; /* biru tua untuk include */
  }

  .jt-cell {
    background: #fff;
    border: 1px solid #e0e6f3;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 12px;
    font-weight: 700;
    color: #1f2937;
  }
  .jt-data3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 6px;
    align-items: center;
  }
  .jt-cell-muted {
    background: #f8fafc;
    border: 1px solid #e0e6f3;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 12px;
    font-weight: 800;
    color: #1f2937;
  }
  
  .badge {
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 999px;
    display: inline-block;
  }

  /* Kompak: jarak antar blok kecil supaya kesan rapih */
  .jt-block { margin-top: 6px; }
</style>

<div class="jt-card">
  <div class="jt-head">{{ strtoupper($title) }}</div>

  <div class="jt-hero">
    <!-- Skyline background -->
    <div class="jt-skyline">
      {!! $skylineSvg !!}
    </div>
    <!-- Donut -->
    <div class="donut-wrap" style="--jt-size: {{ (int)$size }}px;">
      <div id="{{ $id }}" class="donut-canvas"></div>
      <div id="{{ $id }}-center" class="donut-center-label">{{ $fmtPct($pct) }}</div>
    </div>
  </div>

  <div class="jt-table">
    <!-- Formasi -->
    <div class="jt-row jt-block">
      <div class="jt-hd">Formasi {{ $year }}</div>
      <div class="jt-cell" style="grid-column: span 3;">
        
        <span style="margin-left:10px;">{{ $fmtNum($formasi) }}</span>
      </div>
    </div>

    <!-- include Non Layer* -->
    <div class="jt-row jt-block">
      <div class="jt-hd dark">include Non Layer*</div>
      <div class="jt-hd dark">Jml Peg</div>
      <div class="jt-hd dark">GAP (+/-)</div>
      <div class="jt-hd dark">% GAP</div>
    </div>
    <div class="jt-row">
      <div class="jt-cell-muted"></div>
      <div class="jt-cell">{{ $fmtNum($include['jmlPeg'] ?? 0) }}</div>
      @php $g = $incGap; @endphp
      <div class="jt-cell">
        <span class="badge" style="color: {{ $g['fg'] }}; background: {{ $g['bg'] }};">{{ $g['text'] }}</span>
      </div>
      <div class="jt-cell">{{ $fmtPct($include['gapPct'] ?? 0) }}</div>
    </div>

    <!-- exclude Non Layer* -->
    <div class="jt-row jt-block">
      <div class="jt-hd orange">exclude Non Layer*</div>
      <div class="jt-hd orange">Jml Peg</div>
      <div class="jt-hd orange">GAP (+/-)</div>
      <div class="jt-hd orange">% GAP</div>
    </div>
    @php $g2 = $excGap; @endphp
    <div class="jt-row">
      <div class="jt-cell-muted"></div>
      <div class="jt-cell">{{ $fmtNum($exclude['jmlPeg'] ?? 0) }}</div>
      <div class="jt-cell">
        <span class="badge" style="color: {{ $g2['fg'] }}; background: {{ $g2['bg'] }};">{{ $g2['text'] }}</span>
      </div>
      <div class="jt-cell">{{ $fmtPct($exclude['gapPct'] ?? 0) }}</div>
    </div>
  </div>
</div>

@push('after-scripts')
<script>
(function(){
  const el = document.getElementById('{{ $id }}');
  const center = document.getElementById('{{ $id }}-center');
  if(!el || !center) return;

  function ensureApex(cb){
    if(window.ApexCharts){ cb(true); return; }
    let s=document.getElementById('apexcharts-cdn');
    if(!s){
      s=document.createElement('script');
      s.id='apexcharts-cdn';
      s.src='https://cdn.jsdelivr.net/npm/apexcharts@latest';
      s.onload=()=>cb(true); s.onerror=()=>cb(false);
      document.head.appendChild(s);
    } else {
      s.addEventListener('load',()=>cb(true),{once:true});
      s.addEventListener('error',()=>cb(false),{once:true});
    }
  }

  ensureApex(ok=>{
    if(!ok) return;
    const fulfilled = {{ (float)$pct }};
    const remaining = Math.max(0, 100 - fulfilled);
    const fmt = (n)=>Number(n).toLocaleString('de-DE',{minimumFractionDigits:1,maximumFractionDigits:1})+'%';

    const options = {
      chart: {
        type: 'donut',
        width: {{ (int)$size }},
        height: {{ (int)$size }},
        animations: { enabled: true },
        toolbar: { show: false },
        sparkline: { enabled: true },
        foreColor: '#000',
        events: {
          dataPointSelection: function(_e,_ctx,cfg){
            center.textContent = fmt(cfg.seriesIndex === 0 ? fulfilled : remaining);
          },
          mouseLeave: function(){ center.textContent = fmt(fulfilled); }
        }
      },
      series: [fulfilled, remaining],
      labels: ['Terpenuhi','Belum Terpenuhi'],
      colors: ['{{ $blue }}','{{ $red }}'],
      stroke: { width: 2, colors: ['#FFFFFF'] },
      dataLabels: { enabled: false },
      legend: { show: false },
      plotOptions: {
        pie: {
          startAngle: -90,
          endAngle: 270,
          donut: {
            size: '{{ (int)$donutSizePct }}%',
            labels: { show: false, name:{show:false}, value:{show:false}, total:{show:false} }
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

    new ApexCharts(el, options).render();
  });
})();
</script>
@endpush