@props([
  'boxId'         => 'hr-box-'.uniqid(),
  'title'         => 'TITLE',
  'subtitle'      => null,
  'updatedAt'     => null,
  'period'        => '30d',
//   'periodOptions' => ['7d'=>'7d','30d'=>'30d','ytd'=>'YTD'],
  'items'         => [],                 // item: label, value, percent, hint, chipIcon, chipBg, chipText
  'center'        => false,
  'showPercent'   => true,
  'class'         => '',
  'variant'       => 'chip',             // 'chip' | 'outline'
  'itemsPerRow'   => 1,
  'invertText'    => false,              // paksa teks putih
  'forceLight'    => false,              // paksa background putih + teks gelap meski dark mode aktif
])

@php
//   $updatedLabel = $updatedAt
//       ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
//       : 'Updated just now';

  $normalized = collect($items)->map(function($it){
    $label    = $it['label']   ?? '-';
    $value    = $it['value']   ?? 0;
    $percent  = $it['percent'] ?? null;
    $hint     = $it['hint']    ?? null;
    $chipIcon = $it['chipIcon']?? 'ti ti-dots';
    $chipBg   = $it['chipBg']  ?? 'tw-bg-gray-100';
    $chipText = $it['chipText']?? 'tw-text-gray-600';
    $chipHref = $it['chipHref']?? null;

    $pctNum  = is_string($percent) ? (int) preg_replace('/[^\d]/','', $percent) : (is_numeric($percent) ? (int)$percent : null);
    if ($pctNum !== null) $pctNum = max(0, min(100,$pctNum));

    return compact('label','value','percent','hint','chipIcon','chipBg','chipText','pctNum','chipHref');
  });

  $layoutClass = $center ? 'tw-items-center' : 'tw-items-start';

  // Kontainer: putih jika forceLight, atau ikut tema
  $containerBase = 'tw-rounded-2xl tw-border tw-shadow-sm';
  $containerSkin = $forceLight
    ? 'tw-bg-white tw-border-gray-200 dark:tw-bg-white dark:tw-border-gray-200'
    : 'tw-bg-white tw-border-gray-200 dark:tw-bg-slate-800 dark:tw-border-gray-700';

  // Warna teks (title/value/label). Jika forceLight=true, hindari dark: override agar tetap hitam.
  $titleTextClass = $invertText
    ? 'tw-text-white'
    : ($forceLight ? 'tw-text-gray-800' : 'tw-text-gray-800 dark:tw-text-gray-100');

  $valueTextClass = $invertText
    ? 'tw-text-white'
    : ($forceLight ? 'tw-text-gray-900' : 'tw-text-gray-900 dark:tw-text-gray-100');

  $labelTextClass = $invertText
    ? 'tw-text-white/70'
    : ($forceLight ? 'tw-text-gray-500' : 'tw-text-gray-500 dark:tw-text-gray-400');

  // Grid helper (hindari class dinamis yang tidak discan Tailwind)
  $useGrid = $itemsPerRow > 1;
  $gridColsClass = match($itemsPerRow){
    2 => 'sm:tw-grid-cols-2',
    3 => 'sm:tw-grid-cols-3',
    4 => 'sm:tw-grid-cols-4',
    default => 'sm:tw-grid-cols-1'
  };
@endphp

<div id="{{ $boxId }}" class="{{ $containerBase }} {{ $containerSkin }} {{ $class }}">
  <div class="tw-px-5 tw-pt-5 tw-pb-2">
    <div class="tw-flex tw-items-start tw-justify-between tw-gap-4">
      <div>
        <h5 class="tw-text-sm tw-font-semibold tw-tracking-wide {{ $titleTextClass }} tw-mb-0">
          {{ strtoupper($title) }}
        </h5>
        @if($subtitle)
          <div class="tw-text-xs {{ $labelTextClass }}">{{ $subtitle }}</div>
        @endif
      </div>
      {{-- <div class="tw-text-[11px] {{ $labelTextClass }}">{{ $updatedLabel }}</div> --}}
    </div>

    {{-- @if(is_array($meta) && count($meta))
      <div class="tw-flex tw-flex-wrap tw-gap-2 tw-mt-3">
        @foreach($meta as $m)
          <div class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-gray-200 tw-bg-gray-50 tw-px-2.5 tw-py-1">
            <span class="tw-text-[11px] tw-font-semibold tw-text-gray-700">{{ $m['label'] ?? 'META' }}:</span>
            <span class="tw-text-[11px] tw-font-semibold tw-text-gray-900">{{ $m['value'] ?? '-' }}</span>
            @if(!empty($m['percent']))
              <span class="tw-text-[11px] tw-text-gray-500">{{ $m['percent'] }}</span>
            @endif
          </div>
        @endforeach
      </div>
    @endif --}}
  </div>

  <div class="tw-px-5 tw-pb-5">
    @if($variant === 'chip')
      <div class="{{ $useGrid ? 'tw-grid '.$gridColsClass : 'tw-flex tw-flex-col' }} tw-gap-4">
        @foreach($normalized as $row)
          <div class="tw-flex tw-items-center tw-gap-4">
            @if($row['chipHref'])
              <a href="{{ $row['chipHref'] }}" class="tw-w-11 tw-h-11 tw-rounded-xl tw-flex tw-items-center tw-justify-center {{ $row['chipBg'] }} hover:tw-scale-[1.02] tw-transition" title="Lihat tabel {{ $row['label'] }}">
                <i class="{{ $row['chipIcon'] }} tw-text-xl {{ $row['chipText'] }}"></i>
              </a>
            @else
              <div class="tw-w-11 tw-h-11 tw-rounded-xl tw-flex tw-items-center tw-justify-center {{ $row['chipBg'] }}">
                <i class="{{ $row['chipIcon'] }} tw-text-xl {{ $row['chipText'] }}"></i>
              </div>
            @endif

            <div class="tw-flex tw-flex-col tw-leading-tight">
              <div class="tw-text-base tw-font-semibold {{ $valueTextClass }}">
                {{ $row['value'] }}
                @if($showPercent && $row['percent'])
                  <span class="tw-text-[11px] tw-font-medium tw-ml-2 {{ $labelTextClass }}">{{ $row['percent'] }}</span>
                @endif
              </div>
              <div class="tw-text-xs {{ $labelTextClass }}">{{ $row['label'] }}</div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="tw-flex tw-flex-col {{ $layoutClass }} tw-gap-3">
        @foreach($normalized as $row)
          <div class="tw-w-full tw-flex {{ $center ? 'tw-justify-center' : 'tw-justify-between' }}">
            <div class="tw-inline-flex tw-flex-col tw-min-w-[180px] tw-max-w-full tw-px-4 tw-py-2.5 tw-border tw-border-gray-300 tw-rounded-md tw-bg-white hover:tw-border-indigo-500 hover:tw-shadow-sm tw-transition">
              <div class="tw-flex tw-items-start tw-justify-between tw-gap-2">
                <span class="tw-text-xs tw-font-medium {{ $labelTextClass }}">{{ $row['label'] }}</span>
              </div>
              <div class="tw-text-base tw-font-semibold {{ $valueTextClass }}">
                {{ $row['value'] }}
                @if($showPercent && $row['percent'])
                  <span class="tw-text-[10px] tw-font-medium tw-ml-1 {{ $labelTextClass }}">{{ $row['percent'] }}</span>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>