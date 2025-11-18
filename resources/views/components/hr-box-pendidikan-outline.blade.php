@props([
  's1'      => 0,
  's2'      => 0,
  // 's3'      => 0,
  's1Pct'   => '(0%)',
  's2Pct'   => '(0%)',
  // 's3Pct'   => '(0%)',
  'updatedAt' => null,
  // 'class'     => 'tw-h-full',
])

<x-hr-outline-box
  title="Pendidikan"
  :updatedAt="$updatedAt"
  :items="[
    ['label'=>'S1','value'=>$s1,'percent'=>$s1Pct,'hint'=>'Sarjana'],
    ['label'=>'S2','value'=>$s2,'percent'=>$s2Pct,'hint'=>'Magister'],
    // ['label'=>'S3','value'=>$s3,'percent'=>$s3Pct,'hint'=>'Doktor'],
  ]"
  columns="3"
  {{-- :class="$class" --}}
/>