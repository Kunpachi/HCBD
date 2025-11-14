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

    $pctNum  = is_string($percent) ? (int) preg_replace('/[^\d]/','', $percent) : (is_numeric($percent) ? (int)$percent : null);
    if ($pctNum !== null) $pctNum = max(0, min(100,$pctNum));

    return compact('label','value','percent','hint','chipIcon','chipBg','chipText','pctNum');
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
    default => 'sm:tw-grid-cols-1'
  };
@endphp

<div id="{{ $boxId }}"
     data-hr-box
     data-period="{{ $period }}"
     class="{{ $containerBase }} {{ $containerSkin }} {{ $class }}">
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
      <div class="tw-flex tw-items-center tw-gap-2">
        {{-- <div class="tw-text-[11px] {{ $labelTextClass }}">{{ $updatedLabel }}</div> --}}
        <div class="tw-hidden sm:tw-flex tw-items-center tw-gap-1 hr-box-periods">
          {{-- @foreach($periodOptions as $key => $label)
            <button type="button"
                    class="hr-pill {{ $period === $key ? 'is-active' : '' }}"
                    data-period="{{ $key }}"
                    aria-pressed="{{ $period === $key ? 'true' : 'false' }}">
              {{ $label }}
            </button>
          @endforeach --}}
        </div>
      </div>
    </div>
  </div>

  <div class="tw-px-5 tw-pb-5">
    @if($variant === 'chip')
      @if($useGrid)
        <div class="tw-grid tw-gap-4 {{ $gridColsClass }}">
          @foreach($normalized as $row)
            <div class="tw-flex tw-items-center tw-gap-4">
              <div class="tw-w-11 tw-h-11 tw-rounded-xl tw-flex tw-items-center tw-justify-center {{ $row['chipBg'] }}">
                <i class="{{ $row['chipIcon'] }} tw-text-xl {{ $row['chipText'] }}"></i>
              </div>
              <div class="tw-flex tw-flex-col tw-leading-tight">
                <div class="tw-text-lg tw-font-semibold {{ $valueTextClass }}">
                  {{ $row['value'] }}
                  @if($showPercent && $row['percent'])
                    <span class="tw-text-xs tw-font-medium tw-ml-2 {{ $labelTextClass }}">{{ $row['percent'] }}</span>
                  @endif
                </div>
                <div class="tw-text-xs {{ $labelTextClass }}">{{ $row['label'] }}</div>
                {{-- @if(!is_null($row['pctNum']))
                  <div class="kpi-progress tw-mt-2"><span style="width: {{ $row['pctNum'] }}%"></span></div>
                @endif --}}
              </div>
              @if($row['hint'])
                <i class="ti ti-info-circle {{ $labelTextClass }} tw-text-sm" data-bs-toggle="tooltip" title="{{ $row['hint'] }}"></i>
              @endif
            </div>
          @endforeach
        </div>
      @else
        <div class="tw-flex tw-flex-col tw-gap-4">
          @foreach($normalized as $row)
            <div class="tw-flex tw-items-center tw-gap-4">
              <div class="tw-w-11 tw-h-11 tw-rounded-xl tw-flex tw-items-center tw-justify-center {{ $row['chipBg'] }}">
                <i class="{{ $row['chipIcon'] }} tw-text-xl {{ $row['chipText'] }}"></i>
              </div>
              <div class="tw-flex tw-flex-col tw-leading-tight">
                <div class="tw-text-lg tw-font-semibold {{ $valueTextClass }}">
                  {{ $row['value'] }}
                  @if($showPercent && $row['percent'])
                    <span class="tw-text-xs tw-font-medium tw-ml-2 {{ $labelTextClass }}">{{ $row['percent'] }}</span>
                  @endif
                </div>
                <div class="tw-text-xs {{ $labelTextClass }}">{{ $row['label'] }}</div>
                {{-- @if(!is_null($row['pctNum']))
                  <div class="kpi-progress tw-mt-2"><span style="width: {{ $row['pctNum'] }}%"></span></div>
                @endif --}}
              </div>
              @if($row['hint'])
                <i class="ti ti-info-circle {{ $labelTextClass }} tw-text-sm" data-bs-toggle="tooltip" title="{{ $row['hint'] }}"></i>
              @endif
            </div>
          @endforeach
        </div>
      @endif
    @else
      <div class="tw-flex tw-flex-col {{ $layoutClass }} tw-gap-3">
        @foreach($normalized as $row)
          <div class="tw-w-full tw-flex {{ $center ? 'tw-justify-center' : 'tw-justify-between' }}">
            <div class="tw-inline-flex tw-flex-col tw-min-w-[180px] tw-px-4 tw-py-2.5 tw-border tw-border-gray-300 dark:tw-border-gray-600 tw-rounded-md tw-bg-white/80 dark:tw-bg-slate-700/60 hover:tw-border-indigo-500 hover:tw-shadow-sm tw-transition">
              <div class="tw-flex tw-items-start tw-justify-between tw-gap-2">
                <span class="tw-text-xs tw-font-medium {{ $labelTextClass }}">{{ $row['label'] }}</span>
                @if($row['hint'])
                  <i class="ti ti-info-circle {{ $labelTextClass }} tw-text-xs" data-bs-toggle="tooltip" title="{{ $row['hint'] }}"></i>
                @endif
              </div>
              <div class="tw-text-base tw-font-semibold {{ $valueTextClass }}">
                {{ $row['value'] }}
                @if($showPercent && $row['percent'])
                  <span class="tw-text-[10px] tw-font-medium tw-ml-1 {{ $labelTextClass }}">{{ $row['percent'] }}</span>
                @endif
              </div>
              {{-- @if(!is_null($row['pctNum']))
                <div class="kpi-progress tw-mt-2"><span style="width: {{ $row['pctNum'] }}%"></span></div>
              @endif --}}
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>