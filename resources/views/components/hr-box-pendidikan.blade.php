@props([
  'title'       => 'Pendidikan',
  'updatedAt'   => null,

  // Data
  's1'          => 0,
  's2'          => 0,
  's3'          => null,     // jika null, kolom S3 tidak ditampilkan

  's1Pct'       => '(0%)',
  's2Pct'       => '(0%)',
  's3Pct'       => null,     // tampil jika S3 ada

  // Tampilan
  'class'       => '',
  'compact'     => true,     // samakan gaya ringkas seperti generation/total
  'linkBase'    => null,     // opsional: contoh route('hr.education'); jika diisi, ikon menjadi tautan: #s1, #s2, #s3
])

@php
  $updatedLabel   = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
    : 'Updated just now';

  // Ukuran ringkas
  $chipSizeClass  = $compact ? 'tw-w-9 tw-h-9 tw-rounded-lg' : 'tw-w-11 tw-h-11 tw-rounded-xl';
  $iconSizeClass  = $compact ? 'tw-text-base' : 'tw-text-lg';
  $valueTextClass = $compact ? 'tw-text-sm' : 'tw-text-base';
  $titleTextClass = $compact ? 'tw-text-xs' : 'tw-text-sm';
  $outerPadding   = $compact ? 'tw-px-4 tw-pt-4 tw-pb-4' : 'tw-px-5 tw-pt-5 tw-pb-5';

  $hasS3 = !is_null($s3);
  $gridColsClass = $hasS3 ? 'sm:tw-grid-cols-3' : 'sm:tw-grid-cols-2';

  // Helper render chip (anchor bila linkBase ada)
  $chip = function($href, $bg, $icon, $iconColor) use ($chipSizeClass, $iconSizeClass, $linkBase) {
    if ($linkBase && $href) {
      return '<a href="'.e($linkBase.$href).'" class="'.$chipSizeClass.' tw-flex tw-items-center tw-justify-center '.$bg.' hover:tw-scale-[1.02] tw-transition" title="Lihat tabel '.$href.'"><i class="'.$icon.' '.$iconSizeClass.' '.$iconColor.'"></i></a>';
    }
    return '<div class="'.$chipSizeClass.' tw-flex tw-items-center tw-justify-center '.$bg.'"><i class="'.$icon.' '.$iconSizeClass.' '.$iconColor.'"></i></div>';
  };
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white {{ $outerPadding }} {{ $class }}">
  <div class="tw-flex tw-items-start tw-justify-between tw-mb-4">
    <h5 class="{{ $titleTextClass }} tw-font-semibold tw-tracking-wide tw-text-gray-800 tw-m-0">
      {{ strtoupper($title) }}
    </h5>
    <span class="tw-text-[11px] tw-text-gray-500">{{ $updatedLabel }}</span>
  </div>

  <div class="tw-grid tw-gap-4 {{ $gridColsClass }}">
    {{-- S1 --}}
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#s1', 'tw-bg-indigo-100', 'ti ti-school', 'tw-text-indigo-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $s1 }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $s1Pct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">S1</div>
      </div>
    </div>

    {{-- S2 --}}
    <div class="tw-flex tw-items-center tw-gap-3">
      {!! $chip('#s2', 'tw-bg-teal-100', 'ti ti-school', 'tw-text-teal-600') !!}
      <div class="tw-flex tw-flex-col tw-leading-tight">
        <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
          {{ $s2 }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $s2Pct }}</span>
        </div>
        <div class="tw-text-[11px] tw-text-gray-500">S2</div>
      </div>
    </div>

    {{-- S3 (opsional) --}}
    @if($hasS3)
      <div class="tw-flex tw-items-center tw-gap-3">
        {!! $chip('#s3', 'tw-bg-rose-100', 'ti ti-school', 'tw-text-rose-600') !!}
        <div class="tw-flex tw-flex-col tw-leading-tight">
          <div class="{{ $valueTextClass }} tw-font-semibold tw-text-gray-900">
            {{ $s3 }} <span class="tw-text-[11px] tw-font-medium tw-ml-1 tw-text-gray-500">{{ $s3Pct ?? '(0%)' }}</span>
          </div>
          <div class="tw-text-[11px] tw-text-gray-500">S3</div>
        </div>
      </div>
    @endif
  </div>
</div>