@props([
  'title'         => 'Generation',
  'subtitle'      => null,
  'updatedAt'     => null,
  'period'        => '30d',
  // 'periodOptions' => ['7d'=>'7d','30d'=>'30d','ytd'=>'YTD'],
  'genX'          => 0,
  'genY'          => 0,
  'genZ'          => 0,
  'genXPct'       => '(0%)',
  'genYPct'       => '(0%)',
  'genZPct'       => '(0%)',
  'class'         => 'tw-h-full',
])

<x-hr-box
  variant="chip"
  forceLight="true"
  :title="$title"
  :subtitle="$subtitle"
  :updatedAt="$updatedAt"
  :period="$period"
  {{-- :periodOptions="$periodOptions" --}}
  :items="[
    [
      'label'=>'Gen X',
      'value'=>$genX,
      'percent'=>$genXPct,
      'hint'=>'Kelahiran ~1965–1980 (estimasi).',
      'chipIcon'=>'ti ti-user-exclamation',
      'chipBg'=>'tw-bg-rose-100',
      'chipText'=>'tw-text-rose-600'
    ],
    [
      'label'=>'Gen Y',
      'value'=>$genY,
      'percent'=>$genYPct,
      'hint'=>'Millennials, ~1981–1996.',
      'chipIcon'=>'ti ti-shield-check',
      'chipBg'=>'tw-bg-slate-200',
      'chipText'=>'tw-text-slate-700'
    ],
    [
      'label'=>'Gen Z',
      'value'=>$genZ,
      'percent'=>$genZPct,
      'hint'=>'~1997–2012.',
      'chipIcon'=>'ti ti-flame',
      'chipBg'=>'tw-bg-indigo-100',
      'chipText'=>'tw-text-indigo-600'
    ],
  ]"
  :class="$class"
/>