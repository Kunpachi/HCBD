@props([
  'tiles' => [],
  // Optional data utk label tambahan di header
  'noData' => 0,
  'totalTalentmap' => 0,
  'percentTalentmap' => '0%',
  // Styling
  'tileWidth' => 145,        // px lebar tiap tile (sesuaikan kalau perlu)
  'tileHeight' => 74,        // px tinggi minimum tile
  'columns' => 3,            // jumlah kolom tetap (seperti contoh dashboard 1)
  'class' => '',
  'showHeader' => false,     // header statistik biasanya ditangani card pembungkus
  // Ikon mapping agar mudah ganti
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
  // Apakah menampilkan badge jumlah kategori (angka dalam tanda kurung) di label
  'groupCounts' => [
    'Solid Contributor' => 7,
    'Performer'         => 8,
    'Star'              => 9,
    'Slow Starter'      => 4,
    'Average'           => 5,
    'Potential'         => 6,
    'Unfit'             => 1,
    'Slow Starter 2'    => 2,
    'Career Person'     => 3,
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
  if(!is_array($tiles) || !count($tiles)) $tiles = $defaultTiles;

  // Normalisasi & apply icon + group count
  $normalized = collect($tiles)->map(function($t) use ($iconMap,$groupCounts){
    $label = $t['label'] ?? 'Unknown';
    $count = (int)($t['count'] ?? 0);
    $percent = $t['percent'] ?? '0%';
    $icon = $t['icon'] ?? ($iconMap[$label] ?? 'ti ti-dots');
    $gradient = $t['gradient'] ?? ['#4f46e5','#3730a3'];
    $group = $groupCounts[$label] ?? null;
    $labelDisplay = $group ? $label . ' (' . $group . ')' : $label;
    return compact('label','labelDisplay','count','percent','icon','gradient');
  });

  // CSS manual grid agar tile tidak melar (width fixed)
  // Menggunakan inline-grid agar tetap responsif wrap.
@endphp

<div class="tw-flex tw-flex-wrap tw-gap-2 {{ $class }}" style="max-width: {{ $columns * ($tileWidth + 8) }}px;">
  @foreach($normalized as $tile)
    @php($g0=$tile['gradient'][0]) @php($g1=$tile['gradient'][1])
    <div class="tw-rounded-lg tw-text-white tw-flex tw-flex-col tw-shadow-sm"
         style="background:linear-gradient(135deg, {{ $g0 }} 0%, {{ $g1 }} 100%);
                width:{{ $tileWidth }}px; min-height:{{ $tileHeight }}px; padding:10px 12px;">
      <div class="tw-flex tw-items-start tw-justify-between tw-mb-1">
        <span class="tw-text-[10px] tw-font-semibold tw-leading-tight tw-line-clamp-1">{{ $tile['labelDisplay'] }}</span>
        <i class="{{ $tile['icon'] }} tw-text-[15px] tw-opacity-90"></i>
      </div>
      <div class="tw-text-[15px] tw-font-semibold tw-leading-none">{{ number_format($tile['count']) }}</div>
      <div class="tw-text-[10px] tw-font-medium tw-opacity-95 tw-mt-1">{{ $tile['percent'] }}</div>
    </div>
  @endforeach
</div>