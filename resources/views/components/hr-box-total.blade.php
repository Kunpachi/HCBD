@props([
  'title'           => 'Total Kepegawaian',
  'subtitle'        => null,
  'updatedAt'       => null,
  'period'          => '30d',
  // 'periodOptions'   => ['7d'=>'7d','30d'=>'30d','ytd'=>'YTD'],
  'totalEmployees'  => 0,
  'totalTalent'     => 0,
  'totalDisability' => 0,
  'totalPct'        => '(0%)',
  'talentPct'       => '(0%)',
  'disabilityPct'   => '(0%)',
  'class'           => 'tw-h-full',
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
      'label'=>'Jumlah Pegawai',
      'value'=>$totalEmployees,
      'percent'=>$totalPct,
      'hint'=>'Total karyawan aktif.',
      'chipIcon'=>'ti ti-users',
      'chipBg'=>'tw-bg-indigo-100',
      'chipText'=>'tw-text-indigo-600'
    ],
    [
      'label'=>'Jumlah Talent',
      'value'=>$totalTalent,
      'percent'=>$talentPct,
      'hint'=>'Karyawan yang terklasifikasi sebagai talent.',
      'chipIcon'=>'ti ti-user-plus',
      'chipBg'=>'tw-bg-teal-100',
      'chipText'=>'tw-text-teal-600'
    ],
    [
      'label'=>'Disability',
      'value'=>$totalDisability,
      'percent'=>$disabilityPct,
      'hint'=>'Karyawan dengan kebutuhan khusus.',
      'chipIcon'=>'ti ti-accessible',
      'chipBg'=>'tw-bg-cyan-100',
      'chipText'=>'tw-text-cyan-600'
    ],
  ]"
  :class="$class"
/>