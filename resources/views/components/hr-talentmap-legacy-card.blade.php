@props([
  'noData'=>0,
  'totalTalentmap'=>0,
  'percentTalentmap'=>'0%',
  'updatedAt'=>null,
  'tiles'=>[],
  'groupCounts'=>[
    'Solid Contributor'=>7,'Performer'=>8,'Star'=>9,'Slow Starter'=>4,
    'Average'=>5,'Potential'=>6,'Unfit'=>1,'Slow Starter 2'=>2,'Career Person'=>3,
  ],
  'iconMap'=>[
    'Solid Contributor'=>'ti ti-circle-dot',
    'Performer'=>'ti ti-medal',
    'Star'=>'ti ti-star',
    'Slow Starter'=>'ti ti-clock-pause',
    'Average'=>'ti ti-gauge',
    'Potential'=>'ti ti-rocket',
    'Unfit'=>'ti ti-alert-triangle',
    'Slow Starter 2'=>'ti ti-clock-pause',
    'Career Person'=>'ti ti-briefcase',
  ],
  /* Tile layout */
  'tileWidth'=>140,
  'tileHeight'=>72,
  'columns'=>3,
  'gap'=>12,
  'class'=>'',
])

@php
  $updatedLabel = $updatedAt
      ? (is_string($updatedAt)?$updatedAt:$updatedAt->format('Y-m-d H:i:s'))
      : now()->format('Y-m-d H:i:s');

  $defaultTiles = [
    ['label'=>'Solid Contributor','count'=>82,'percent'=>'0,68%','gradient'=>['#F97316','#EA580C']],
    ['label'=>'Performer','count'=>1130,'percent'=>'9,37%','gradient'=>['#16A34A','#15803D']],
    ['label'=>'Star','count'=>1268,'percent'=>'10,52%','gradient'=>['#1D4ED8','#1E40AF']],
    ['label'=>'Slow Starter','count'=>371,'percent'=>'3,08%','gradient'=>['#D97706','#B45309']],
    ['label'=>'Average','count'=>2409,'percent'=>'19,98%','gradient'=>['#7C3AED','#6D28D9']],
    ['label'=>'Potential','count'=>3090,'percent'=>'25,63%','gradient'=>['#65A30D','#4D7C0F']],
    ['label'=>'Unfit','count'=>52,'percent'=>'0,43%','gradient'=>['#991B1B','#7F1D1D']],
    ['label'=>'Slow Starter 2','count'=>197,'percent'=>'1,63%','gradient'=>['#DC2626','#B91C1C']],
    ['label'=>'Career Person','count'=>207,'percent'=>'1,72%','gradient'=>['#BE185D','#9D174D']],
  ];
  if(!is_array($tiles) || !count($tiles)) $tiles = $defaultTiles;

  $norm = collect($tiles)->map(function($t) use($iconMap,$groupCounts){
    $label = $t['label'] ?? 'Unknown';
    return [
      'label'    => $label,
      'display'  => $groupCounts[$label] ?? null ? $label.' ('.$groupCounts[$label].')' : $label,
      'count'    => (int)($t['count'] ?? 0),
      'percent'  => $t['percent'] ?? '0%',
      'icon'     => $t['icon'] ?? ($iconMap[$label] ?? 'ti ti-dots'),
      'gradient' => $t['gradient'] ?? ['#4f46e5','#3730a3'],
    ];
  });

  $contentMaxWidth = $columns * $tileWidth + ($columns - 1) * $gap;
@endphp

<div class="hc-card tw-p-0 {{ $class }}">
  <div class="hc-card-header-blue">
    <div class="tw-flex tw-items-center tw-gap-2">
      <i class="ti ti-users-group tw-text-white tw-text-[15px]"></i>
      <span class="tw-text-[12px] tw-font-semibold tw-tracking-wide tw-text-white">{{ strtoupper('Talentmap') }}</span>
    </div>
    <span class="tw-text-[11px] tw-font-medium tw-text-white/90">{{ $updatedLabel }}</span>
  </div>

  <div class="tw-px-5 tw-pt-1 tw-pb-2 tw-text-[11px] tw-text-gray-800 tw-flex tw-flex-wrap tw-gap-x-5 tw-gap-y-1"
       style="max-width:{{ $contentMaxWidth }}px;">
    <div>No Data <span class="tw-font-semibold">{{ number_format((int)$noData) }}</span></div>
    <div>Total <span class="tw-font-semibold">{{ number_format((int)$totalTalentmap) }}</span></div>
    <div><span class="tw-font-semibold">{{ $percentTalentmap }}</span> <span class="tw-italic tw-text-gray-500">(belum memiliki talentmapping)</span></div>
  </div>

  <div class="hc-card-body tw-px-5 tw-pb-4 tw-pt-0">
    <div class="hc-scroll tw-overflow-y-auto">
      <div class="hc-talentmap-grid" style="max-width:{{ $contentMaxWidth }}px;">
        @foreach($norm as $tile)
          @php($g0=$tile['gradient'][0]) @php($g1=$tile['gradient'][1])
          <div class="hc-talentmap-item" style="width:{{ $tileWidth }}px;">
            <div class="tw-rounded-lg tw-text-white tw-shadow-sm tw-flex tw-flex-col"
                 style="background:linear-gradient(135deg, {{ $g0 }} 0%, {{ $g1 }} 100%);
                        height:{{ $tileHeight }}px; padding:9px 11px;">
              <div class="tw-flex tw-items-start tw-justify-between tw-mb-1">
                <span class="tw-text-[10px] tw-font-semibold tw-leading-tight tw-pr-2 tw-line-clamp-1">{{ $tile['display'] }}</span>
                <i class="{{ $tile['icon'] }} tw-text-[15px] tw-opacity-90"></i>
              </div>
              <div class="tw-text-[15px] tw-font-semibold tw-leading-none">{{ number_format($tile['count']) }}</div>
              <div class="tw-text-[10px] tw-font-medium tw-opacity-95 tw-mt-1">{{ $tile['percent'] }}</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>