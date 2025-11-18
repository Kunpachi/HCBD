@props([
  'male'      => 0,
  'female'    => 0,
  'malePct'   => '(0%)',
  'femalePct' => '(0%)',
  'updatedAt' => null,
  // 'class'     => 'tw-h-full',
])

<x-hr-outline-box
  title="Gender"
  :updatedAt="$updatedAt"
  :items="[
    ['label'=>'Male','value'=>$male,'percent'=>$malePct,'hint'=>'Proporsi laki-laki'],
    ['label'=>'Female','value'=>$female,'percent'=>$femalePct,'hint'=>'Proporsi perempuan'],
  ]"
  columns="2"
  {{-- :class="$class" --}}
/>