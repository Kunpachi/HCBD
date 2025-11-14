@props([
  'updatedAt' => null,
  // Data yang dikirim controller (boleh null, akan fallback ke 0)
  'totalEmployees'   => 0,
  'totalTalent'      => 0,
  'totalDisability'  => 0,
  'male'             => 0,
  'female'           => 0,
  'genX'             => 0,
  'genY'             => 0,
  'genZ'             => 0,
  // Persentase (opsional). Jika tidak dikirim, dihitung sederhana.
  'malePct'          => null,
  'femalePct'        => null,
  'genXPct'          => null,
  'genYPct'          => null,
  'genZPct'          => null,
  'talentPct'        => null,
  'disabilityPct'    => null,
])

@php
  $totalEmployees = (int)$totalEmployees;
  $calcPct = function($val) use ($totalEmployees) {
    if (!$totalEmployees) return '(0%)';
    return '(' . round(($val / max(1,$totalEmployees))*100) . '%)';
  };

  $malePct        = $malePct        ?? $calcPct($male);
  $femalePct      = $femalePct      ?? $calcPct($female);
  $genXPct        = $genXPct        ?? $calcPct($genX);
  $genYPct        = $genYPct        ?? $calcPct($genY);
  $genZPct        = $genZPct        ?? $calcPct($genZ);
  $talentPct      = $talentPct      ?? $calcPct($totalTalent);
  $disabilityPct  = $disabilityPct  ?? $calcPct($totalDisability);

  $updatedLabel = $updatedAt
      ? (is_string($updatedAt) ? $updatedAt : $updatedAt->diffForHumans())
      : 'Updated just now';

  $items = [
    // Kelompok Total
    [
      'label'=>'Jumlah Pegawai','value'=>$totalEmployees,'percent'=>'(100%)',
      'icon'=>'ti ti-users','bg'=>'tw-bg-indigo-500'
    ],
    [
      'label'=>'Jumlah Talent','value'=>$totalTalent,'percent'=>$talentPct,
      'icon'=>'ti ti-user-plus','bg'=>'tw-bg-teal-400'
    ],
    [
      'label'=>'Disability','value'=>$totalDisability,'percent'=>$disabilityPct,
      'icon'=>'ti ti-accessible','bg'=>'tw-bg-cyan-500'
    ],

    // Kelompok Gender
    [
      'label'=>'Male','value'=>$male,'percent'=>$malePct,
      'icon'=>'ti ti-gender-male','bg'=>'tw-bg-blue-500'
    ],
    [
      'label'=>'Female','value'=>$female,'percent'=>$femalePct,
      'icon'=>'ti ti-gender-female','bg'=>'tw-bg-amber-400'
    ],

    // Kelompok Generation
    [
      'label'=>'Gen X','value'=>$genX,'percent'=>$genXPct,
      'icon'=>'ti ti-user-exclamation','bg'=>'tw-bg-red-500'
    ],
    [
      'label'=>'Gen Y','value'=>$genY,'percent'=>$genYPct,
      'icon'=>'ti ti-shield-check','bg'=>'tw-bg-gray-600'
    ],
    [
      'label'=>'Gen Z','value'=>$genZ,'percent'=>$genZPct,
      'icon'=>'ti ti-flame','bg'=>'tw-bg-indigo-500'
    ],
  ];
@endphp

<div class="card tw-rounded-2xl tw-border tw-border-gray-100 tw-shadow-sm tw-overflow-hidden">
  <div class="card-body tw-px-6 tw-py-5">
    <div class="tw-flex tw-items-start tw-justify-between tw-mb-5 tw-gap-4">
      <div class="tw-flex tw-flex-col">
        <h4 class="tw-text-lg tw-font-semibold tw-m-0">HR Statistics</h4>
        <span class="tw-text-xs tw-text-gray-400">Summary</span>
      </div>
      <div class="tw-text-xs tw-text-gray-500">{{ $updatedLabel }}</div>
    </div>

    <!-- Grid flexible -->
    <div class="tw-flex tw-flex-wrap tw-gap-x-8 tw-gap-y-6">
      @foreach($items as $it)
        <div class="tw-flex tw-items-center tw-gap-4 tw-min-w-[140px]">
          <div class="tw-w-11 tw-h-11 tw-rounded-xl tw-flex tw-items-center tw-justify-center tw-text-white {{ $it['bg'] }}">
            <i class="{{ $it['icon'] }} tw-text-xl"></i>
          </div>
          <div class="tw-flex tw-flex-col tw-leading-tight">
            <div class="tw-text-base tw-font-semibold">
              {{ $it['value'] }}
              <span class="tw-text-xs tw-font-medium tw-ml-1 tw-text-gray-400">{{ $it['percent'] }}</span>
            </div>
            <div class="tw-text-xs tw-text-gray-500">{{ $it['label'] }}</div>
          </div>
        </div>
      @endforeach
    </div>

  </div>
</div>