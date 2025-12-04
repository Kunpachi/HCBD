@props([
  'title' => 'Consolidated HCBD & HCMD',
  'updatedAt' => null,

  // Angka-angka inti
  'formasi' => 0,           // total formasi (rencana kebutuhan)
  'jumlahPegawai' => 0,     // headcount aktual
  'gap' => null,            // selisih formasi - aktual (jika null dihitung otomatis)
  'gapPct' => null,         // persen gap (jika null dihitung otomatis)

  // Opsi tampilan
  'class' => '',
])

@php
  $updatedLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s'))
    : now()->format('Y-m-d H:i:s');

  $gapVal = is_null($gap) ? ((int)$formasi - (int)$jumlahPegawai) : (int)$gap;
  $gapPctVal = !is_null($gapPct)
    ? $gapPct
    : ($formasi > 0 ? round(($gapVal / $formasi) * 100, 1).'%' : '0%');

  $fmt = fn($n) => number_format((int)$n, 0, ',', '.');
  $chip = function(string $label, string|int $value, string $iconClass, string $bgHex){
    return <<<HTML
      <div class="tw-flex tw-items-center tw-gap-2">
        <div class="tw-w-8 tw-h-8 tw-rounded-xl tw-flex tw-items-center tw-justify-center" style="background:{$bgHex}1A">
          <i class="{$iconClass}" style="color:{$bgHex}"></i>
        </div>
        <div>
          <div class="tw-text-sm tw-font-semibold">{$value}</div>
          <div class="tw-text-[11px] tw-text-gray-500">{$label}</div>
        </div>
      </div>
    HTML;
  };

  // Warna gap chip: hijau jika positif (kebutuhan belum terpenuhi), merah jika negatif (kelebihan), abu jika 0
  $gapColor = $gapVal > 0 ? '#16a34a' : ($gapVal < 0 ? '#ef4444' : '#64748b');
@endphp

<div class="tw-rounded-2xl tw-bg-white tw-border tw-border-gray-200 tw-p-5 {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-3">
    <div class="tw-text-sm tw-font-semibold tw-text-gray-800">{{ strtoupper($title) }}</div>
    <div class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</div>
  </div>

  <div class="tw-flex tw-items-center tw-flex-wrap tw-gap-5">
    {!! $chip('Formasi Pegawai', $fmt($formasi), 'ti ti-clipboard-list', '#0ea5e9') !!}
    {!! $chip('Jumlah Pegawai', $fmt($jumlahPegawai), 'ti ti-users', '#22c55e') !!}
    <div class="tw-flex tw-items-center tw-gap-2">
      <div class="tw-w-8 tw-h-8 tw-rounded-xl tw-flex tw-items-center tw-justify-center" style="background:{{ $gapColor }}1A">
        <i class="ti ti-arrows-left-right" style="color:{{ $gapColor }}"></i>
      </div>
      <div>
        <div class="tw-text-sm tw-font-semibold" style="color:{{ $gapColor }}">{{ $gapVal >= 0 ? '+'.$fmt($gapVal) : $fmt($gapVal) }}</div>
        <div class="tw-text-[11px] tw-text-gray-500">GAP</div>
      </div>
    </div>
    {!! $chip('%Gap', is_string($gapPctVal)?$gapPctVal:($gapPctVal.'%'), 'ti ti-percent', '#a78bfa') !!}
  </div>
</div>