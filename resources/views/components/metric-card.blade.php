{{-- @props([
  'label'    => 'Label',
  'value'    => '0',
  'percent'  => null,
  'color'    => 'primary',     // boleh token: primary|success|danger|warning|info|secondary
  'icon'     => 'ti ti-users',
  'variant'  => 'default',     // default|minimal
  'showMeta' => true,
  'bg'       => null,          // override: kelas bg mentah (mis. "tw-bg-indigo-500" atau "bg-primary")
])
@php
  $bgMap = [
    'primary'   => 'bg-primary',
    'success'   => 'bg-success',
    'danger'    => 'bg-danger',
    'warning'   => 'bg-warning',
    'info'      => 'bg-info',
    'secondary' => 'bg-secondary',
  ];
  $bg = $bgMap[$color] ?? 'bg-primary';

  $trendClass = 'tw-text-green-500';
  if ($percent && str_contains($percent,'-')) {
      $trendClass = 'tw-text-red-500';
  }

  $isMinimal = $variant === 'minimal';

  // Kelas wrapper card
  $cardClass = $isMinimal
      ? 'card tw-rounded-xl tw-shadow-sm tw-border tw-border-gray-100'
      : 'card h-100';

  // Kelas body
  $bodyClass = $isMinimal
      ? 'card-body tw-flex tw-items-start tw-gap-3 tw-py-3 tw-px-4'
      : 'card-body d-flex align-items-start';

  // Kelas avatar
  $avatarClass = $isMinimal
      ? 'tw-w-10 tw-h-10 tw-flex tw-items-center tw-justify-center tw-rounded-lg '.$bg.' tw-text-white'
      : 'avatar flex-shrink-0 me-3';

@endphp

<div class="{{ $cardClass }}">
  <div class="{{ $bodyClass }}">
    <div class="{{ $avatarClass }}">
      <i class="{{ $icon }} tw-text-lg"></i>
    </div>
    <div class="tw-flex-1">
      <div class="tw-text-sm tw-font-medium tw-text-gray-600">{{ $label }}</div>
      <div class="tw-font-bold tw-text-xl tw-leading-none tw-mt-1">
        {{ $value }}
        @if($percent)
          <span class="tw-text-xs tw-font-medium tw-ml-1 {{ $trendClass }}">{{ $percent }}</span>
        @endif
      </div>
      @if(!$isMinimal && $showMeta)
        <div class="tw-text-[11px] tw-text-gray-400 tw-mt-1">Recent analytics</div>
      @endif
    </div>
  </div>
</div> --}}

@props([
  'label'    => 'Label',
  'value'    => '0',
  'percent'  => null,
  'color'    => 'primary',     // boleh token: primary|success|danger|warning|info|secondary
  'icon'     => 'ti ti-users',
  'variant'  => 'default',     // default|minimal
  'showMeta' => true,
  'bg'       => null,          // override: kelas bg mentah (mis. "tw-bg-indigo-500" atau "bg-primary")
])

@php
  // Map token → kelas Bootstrap (tetap kompatibel dengan pemakaian lama)
  $bgMap = [
    'primary'   => 'bg-primary',
    'success'   => 'bg-success',
    'danger'    => 'bg-danger',
    'warning'   => 'bg-warning',
    'info'      => 'bg-info',
    'secondary' => 'bg-secondary',
  ];

  // Jika user kirim prop "bg", pakai itu. Jika tidak, cek "color":
  // - Jika color sudah kelas mentah (tw-… atau bg-… atau hex), pakai apa adanya.
  // - Jika color token, pakai map. Jika tak dikenal, fallback bg-primary.
  $isRawColor = is_string($color) && (
      str_contains($color, 'tw-') ||
      str_starts_with($color, 'bg-') ||
      str_starts_with($color, '#')
  );

  $resolvedBg = $bg
      ? $bg
      : ($isRawColor
          ? $color
          : ($bgMap[$color] ?? 'bg-primary'));

  // Warna tren
  $trendClass = 'tw-text-gray-400';
  if ($percent) {
    if (str_contains($percent, '+')) $trendClass = 'tw-text-green-500';
    elseif (str_contains($percent, '-')) $trendClass = 'tw-text-red-500';
  }

  $isMinimal = $variant === 'minimal';

  // Kelas wrapper card
  $cardClass = $isMinimal
      ? 'card tw-rounded-xl tw-shadow-sm tw-border tw-border-gray-100'
      : 'card h-100';

  // Kelas body
  $bodyClass = $isMinimal
      ? 'card-body tw-flex tw-items-start tw-gap-3 tw-py-3 tw-px-4'
      : 'card-body d-flex align-items-start';

  // Kelas avatar
  $avatarClass = $isMinimal
      ? 'tw-w-10 tw-h-10 tw-flex tw-items-center tw-justify-center tw-rounded-lg '.$resolvedBg.' tw-text-white'
      : 'avatar flex-shrink-0 me-3';
@endphp

<div class="{{ $cardClass }}">
  <div class="{{ $bodyClass }}">
    <div class="{{ $avatarClass }}">
      <i class="{{ trim($icon) }} tw-text-lg"></i>
    </div>
    <div class="tw-flex-1">
      <div class="tw-text-sm tw-font-medium tw-text-gray-600">{{ $label }}</div>
      <div class="tw-font-bold tw-text-xl tw-leading-none tw-mt-1">
        {{ $value }}
        @if($percent)
          <span class="tw-text-xs tw-font-medium tw-ml-1 {{ $trendClass }}">{{ $percent }}</span>
        @endif
      </div>
      @if(!$isMinimal && $showMeta)
        <div class="tw-text-[11px] tw-text-gray-400 tw-mt-1">Recent analytics</div>
      @endif
    </div>
  </div>
</div>