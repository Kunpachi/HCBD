@props([
  'chartId'=>'person-grade-chart',
  'grades'=>null,'series'=>null,
  'height'=>180,'updatedAt'=>null,'class'=>'',
  'title'=>'Person Grade',
  'contentMaxWidth' => 470,  // agar sejajar secara visual bila ingin sempit
])

@php
  $defaultGrades=['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B'];
  $defaultSeries=[49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3];
  if(!is_array($grades)||!count($grades)) $grades=$defaultGrades;
  if(!is_array($series)||!count($series)) $series=$defaultSeries;
  $updatedLabel=$updatedAt?(is_string($updatedAt)?$updatedAt:$updatedAt->diffForHumans()):'Updated just now';
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-px-4 tw-pt-4 tw-pb-4 {{ $class }}" style="max-width: {{ $contentMaxWidth }}px;">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-2">
    <h5 class="tw-text-xs tw-font-semibold tw-tracking-wide tw-text-blue-700 tw-m-0">{{ $title }}</h5>
    <span class="tw-text-[10px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>
  <div id="{{ $chartId }}" style="height:{{ (int)$height }}px;"></div>
</div>

@push('after-scripts')
<script>
(function(){
  const el=document.querySelector('#{{ $chartId }}');
  if(!el||typeof ApexCharts==='undefined') return;
  new ApexCharts(el,{
    chart:{type:'bar',height:{{ (int)$height }},toolbar:{show:false},fontFamily:'inherit'},
    series:[{name:'Jumlah',data:@json($series)}],
    xaxis:{categories:@json($grades),labels:{style:{fontSize:'10px'}}},
    plotOptions:{bar:{columnWidth:'55%',borderRadius:3}},
    dataLabels:{enabled:true,formatter:v=>(v||0).toLocaleString(),style:{fontSize:'10px',colors:['#0d47a1']}},
    colors:['#0d60ff'],
    grid:{strokeDashArray:3,borderColor:'#e2e8f0'},
    yaxis:{labels:{style:{fontSize:'10px'}}},
    tooltip:{y:{formatter:v=>(v||0).toLocaleString()}}
  }).render();
})();
</script>
@endpush