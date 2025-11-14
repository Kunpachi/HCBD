@props([
  'title'         => 'Pendidikan',
  'subtitle'      => null,
  'updatedAt'     => null,
  'period'        => '30d',
  'periodOptions' => ['7d'=>'7d','30d'=>'30d','ytd'=>'YTD'],
  's1'            => 0,
  's2'            => 0,
  's3'            => 0,
  's1Pct'         => '(0%)',
  's2Pct'         => '(0%)',
  's3Pct'         => '(0%)',
  'class'         => 'tw-h-full',
])

<x-hr-box
  variant="chip"
  forceLight="true"     {{-- background putih --}}
  invertText="false"    {{-- teks hitam --}}
  :title="$title"
  :subtitle="$subtitle"
  :updatedAt="$updatedAt"
  :period="$period"
  :periodOptions="$periodOptions"
  :items="[
    [
      'label'=>'S1',
      'value'=>$s1,
      'percent'=>$s1Pct,
      'hint'=>'Sarjana (S1).',
      'chipIcon'=>'ti ti-school',
      'chipBg'=>'tw-bg-indigo-100',
      'chipText'=>'tw-text-indigo-600'
    ],
    [
      'label'=>'S2',
      'value'=>$s2,
      'percent'=>$s2Pct,
      'hint'=>'Magister (S2).',
      'chipIcon'=>'ti ti-school',
      'chipBg'=>'tw-bg-teal-100',
      'chipText'=>'tw-text-teal-600'
    ],
    [
      'label'=>'S3',
      'value'=>$s3,
      'percent'=>$s3Pct,
      'hint'=>'Doktor (S3).',
      'chipIcon'=>'ti ti-school',
      'chipBg'=>'tw-bg-rose-100',
      'chipText'=>'tw-text-rose-600'
    ],
  ]"
  :class="$class"
  :itemsPerRow="3"  {{-- S1, S2, S3 sejajar --}}
/>