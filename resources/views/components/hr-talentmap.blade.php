@props([
  'tiles' => [],
  'colsSm' => 3, 'colsMd' => 4, 'colsLg' => 5, 'colsXl' => 6,
  'dense' => true,
  'compact' => true,
  'tileMinH' => 52,
  'class' => '',
  'iconMap' => [
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
])

@php
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
  if (!is_array($tiles) || !count($tiles)) $tiles = $defaultTiles;

  $gapCls = $dense ? 'tw-gap-2 md:tw-gap-2.5' : 'tw-gap-3';
  $grid = "tw-grid $gapCls sm:tw-grid-cols-{$colsSm} md:tw-grid-cols-{$colsMd} lg:tw-grid-cols-{$colsLg} xl:tw-grid-cols-{$colsXl}";

  $labelSize   = 'tw-text-[10px]';
  $valueSize   = 'tw-text-[14px] tw-font-semibold';
  $percentSize = 'tw-text-[10px] tw-font-medium';
  $iconSize    = 'tw-text-[14px]';
  $padTile     = 'tw-px-3 tw-py-2';

  $normalized = collect($tiles)->map(function($t) use ($iconMap){
    return [
      'label'=> $t['label'] ?? 'Unknown',
      'count'=> (int)($t['count'] ?? 0),
      'percent'=> $t['percent'] ?? '0%',
      'gradient'=> $t['gradient'] ?? ['#4f46e5','#3730a3'],
      'icon'=> $t['icon'] ?? ($iconMap[$t['label'] ?? ''] ?? 'ti ti-dots'),
    ];
  });
@endphp

<div class="{{ $grid }} {{ $class }}">
  @foreach($normalized as $tile)
    @php($g0=$tile['gradient'][0]) @php($g1=$tile['gradient'][1])
    <div class="tw-rounded-xl tw-text-white {{ $padTile }} tw-flex tw-flex-col tw-shadow-sm"
         style="background:linear-gradient(135deg, {{ $g0 }} 0%, {{ $g1 }} 100%); min-height:{{ (int)$tileMinH }}px;">
      <div class="tw-flex tw-items-center tw-justify-between tw-mb-1">
        <span class="{{ $labelSize }} tw-font-semibold tw-leading-none tw-pr-2 tw-line-clamp-1">{{ $tile['label'] }}</span>
        <i class="{{ $tile['icon'] }} {{ $iconSize }} tw-opacity-90"></i>
      </div>
      <div class="tw-flex tw-items-baseline tw-justify-between">
        <div class="{{ $valueSize }} tw-leading-none">
          {{ number_format($tile['count']) }}
        </div>
        <div class="{{ $percentSize }} tw-leading-none tw-opacity-95">
          {{ $tile['percent'] }}
        </div>
      </div>
    </div>
  @endforeach
</div>