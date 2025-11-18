@props([
  // Jika tiles kosong/tidak dikirim, kita pakai defaultTiles di bawah
  'tiles' => [],
  'colsSm' => 2, 'colsMd' => 3, 'colsLg' => 3, 'colsXl' => 3,
  'dense' => true,
  'tileMinH' => 60,
  'class' => '',
])

@php
  // Default tiles (warna & ikon sesuai contoh)
  $defaultTiles = [
    ['label'=>'Solid Contributor','count'=>82,  'percent'=>'0,68%','icon'=>'ti ti-motorbike', 'gradient'=>['#F97316','#EA580C']],
    ['label'=>'Performer',        'count'=>1130,'percent'=>'9,37%','icon'=>'ti ti-trophy',    'gradient'=>['#16A34A','#15803D']],
    ['label'=>'Star',             'count'=>1268,'percent'=>'10,52%','icon'=>'ti ti-rocket',    'gradient'=>['#1D4ED8','#1E40AF']],
    ['label'=>'Slow Starter',     'count'=>371, 'percent'=>'3,08%','icon'=>'ti ti-bicycle',   'gradient'=>['#D97706','#B45309']],
    ['label'=>'Average',          'count'=>2409,'percent'=>'19,98%','icon'=>'ti ti-car',       'gradient'=>['#7C3AED','#6D28D9']],
    ['label'=>'Potential',        'count'=>3090,'percent'=>'25,63%','icon'=>'ti ti-rocket',    'gradient'=>['#65A30D','#4D7C0F']],
    ['label'=>'Unfit',            'count'=>52,  'percent'=>'0,43%','icon'=>'ti ti-run',       'gradient'=>['#991B1B','#7F1D1D']],
    ['label'=>'Slow Starter 2',   'count'=>197, 'percent'=>'1,63%','icon'=>'ti ti-run',       'gradient'=>['#DC2626','#B91C1C']],
    ['label'=>'Career Person',    'count'=>207, 'percent'=>'1,72%','icon'=>'ti ti-briefcase', 'gradient'=>['#BE185D','#9D174D']],
  ];

  // Fallback: kalau tiles tidak diisi atau kosong, pakai default
  if (!is_array($tiles) || count($tiles) === 0) {
    $tiles = $defaultTiles;
  }

  $gapCls = $dense ? 'tw-gap-2 md:tw-gap-3' : 'tw-gap-4';
  $grid   = "tw-grid $gapCls sm:tw-grid-cols-{$colsSm} md:tw-grid-cols-{$colsMd} lg:tw-grid-cols-{$colsLg} xl:tw-grid-cols-{$colsXl}";
@endphp

<div class="{{ $grid }} {{ $class }}">
  @foreach($tiles as $t)
    @php
      $g0 = $t['gradient'][0] ?? '#4f46e5';
      $g1 = $t['gradient'][1] ?? '#3730a3';
    @endphp
    <div class="tw-rounded-xl tw-text-white tw-px-4 tw-py-3 tw-flex tw-flex-col tw-shadow-sm"
         style="background:linear-gradient(135deg, {{ $g0 }} 0%, {{ $g1 }} 100%); min-height:{{ (int)$tileMinH }}px;">
      <div class="tw-flex tw-justify-between tw-items-start tw-mb-1">
        <span class="tw-text-[12px] tw-font-semibold tw-leading-none">{{ $t['label'] }}</span>
        <i class="{{ $t['icon'] }} tw-text-[16px] tw-opacity-90"></i>
      </div>
      <div class="tw-text-lg tw-font-semibold tw-leading-none">
        {{ number_format((int)($t['count'] ?? 0)) }}
      </div>
      <div class="tw-text-[11px] tw-font-medium tw-opacity-95 tw-mt-1">
        {{ $t['percent'] ?? '0%' }}
      </div>
    </div>
  @endforeach
</div>