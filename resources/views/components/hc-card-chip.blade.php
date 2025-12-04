@props([
  'icon' => 'ti ti-info-circle',
  'label' => '',
  'value' => '',
  'fg' => '#374151',   // warna teks angka utama
  'bg' => '#e5e7eb',   // dasar untuk chip ikon (akan ditambah transparency)
])

@php
  $valueStr = is_numeric($value) ? number_format((int)$value, 0, ',', '.') : (string)$value;
@endphp

<div class="tw-flex tw-items-center tw-gap-2">
  <div class="tw-w-9 tw-h-9 tw-rounded-2xl tw-flex tw-items-center tw-justify-center" style="background:{{ $bg }}1A">
    <i class="{{ $icon }}" style="color:{{ $fg }};"></i>
  </div>
  <div>
    <div class="tw-text-sm tw-font-semibold" style="color:{{ $fg }};">{{ $valueStr }}</div>
    <div class="tw-text-[11px] tw-text-gray-500">{{ $label }}</div>
  </div>
</div>