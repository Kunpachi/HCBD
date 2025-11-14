@props([
  'title'         => 'Gender',
  'subtitle'      => null,
  'updatedAt'     => null,
  'period'        => '30d',
//   'periodOptions' => ['7d'=>'7d','30d'=>'30d','ytd'=>'YTD'],
  'male'          => 0,
  'female'        => 0,
  'malePct'       => '(0%)',
  'femalePct'     => '(0%)',
  'class'         => 'tw-h-full',
  's1'            => 0,
  's2'            => 0,
  's3'            => 0,
  's1Pct'         => '(0%)',
  's2Pct'         => '(0%)',
  's3Pct'         => '(0%)',
])

<x-hr-box
  variant="chip"
  forceLight="true"          {{-- background putih --}}
  {{-- invertText="false"         teks jadi hitam --}}
  :title="$title"
  :subtitle="$subtitle"
  :updatedAt="$updatedAt"
  :period="$period"
  {{-- :periodOptions="$periodOptions" --}}
  :items="[
    [
      'label'=>'Male',
      'value'=>$male,
      'percent'=>$malePct,
      'hint'=>'Proporsi laki-laki dari total pegawai.',
      'chipIcon'=>'ti ti-gender-male',
      'chipBg'=>'tw-bg-blue-100',
      'chipText'=>'tw-text-blue-600'
    ],
    [
      'label'=>'Female',
      'value'=>$female,
      'percent'=>$femalePct,
      'hint'=>'Proporsi perempuan dari total pegawai.',
      'chipIcon'=>'ti ti-gender-female',
      'chipBg'=>'tw-bg-amber-100',
      'chipText'=>'tw-text-amber-600'
    ],
    ['label'=>'S1','value'=>$s1,'percent'=>$s1Pct,'chipIcon'=>'ti ti-school','chipBg'=>'tw-bg-indigo-100','chipText'=>'tw-text-indigo-600'],
    ['label'=>'S2','value'=>$s2,'percent'=>$s2Pct,'chipIcon'=>'ti ti-school','chipBg'=>'tw-bg-teal-100','chipText'=>'tw-text-teal-600'],
    ['label'=>'S3','value'=>$s3,'percent'=>$s3Pct,'chipIcon'=>'ti ti-school','chipBg'=>'tw-bg-rose-100','chipText'=>'tw-text-rose-600'],
  ]"
  :class="$class"
  :itemsPerRow="2"
/>