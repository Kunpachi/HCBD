@props([
  // Data tile: label, count, percent, icon (ti icon), color classes
  'tiles' => [
    ['label'=>'Solid Contributor','count'=>82,'percent'=>'0,68%','icon'=>'ti ti-motorbike','bg'=>'tw-bg-orange-500','gradient'=>['#F97316','#EA580C']],
    ['label'=>'Performer','count'=>1130,'percent'=>'9,37%','icon'=>'ti ti-trophy','bg'=>'tw-bg-green-600','gradient'=>['#16A34A','#15803D']],
    ['label'=>'Star','count'=>1268,'percent'=>'10,52%','icon'=>'ti ti-rocket','bg'=>'tw-bg-blue-700','gradient'=>['#1D4ED8','#1E40AF']],
    ['label'=>'Slow Starter','count'=>371,'percent'=>'3,08%','icon'=>'ti ti-bicycle','bg'=>'tw-bg-amber-600','gradient'=>['#D97706','#B45309']],
    ['label'=>'Average','count'=>2409,'percent'=>'19,98%','icon'=>'ti ti-car','bg'=>'tw-bg-violet-600','gradient'=>['#7C3AED','#6D28D9']],
    ['label'=>'Potential','count'=>3090,'percent'=>'25,63%','icon'=>'ti ti-rocket','bg'=>'tw-bg-lime-600','gradient'=>['#65A30D','#4D7C0F']],
    ['label'=>'Unfit','count'=>52,'percent'=>'0,43%','icon'=>'ti ti-run','bg'=>'tw-bg-red-800','gradient'=>['#991B1B','#7F1D1D']],
    ['label'=>'Slow Starter 2','count'=>197,'percent'=>'1,63%','icon'=>'ti ti-run','bg'=>'tw-bg-red-600','gradient'=>['#DC2626','#B91C1C']],
    ['label'=>'Career Person','count'=>207,'percent'=>'1,72%','icon'=>'ti ti-briefcase','bg'=>'tw-bg-pink-700','gradient'=>['#BE185D','#9D174D']],
  ],
  'noData'         => 0,
  'totalTalentmap' => 3251,
  'percentTalentmap'=> '25,53%',
  'showHeader'     => true,
])

@php
  // Hitung total dari tiles jika ingin otomatis
  $sum = array_sum(array_map(fn($t)=>$t['count'], $tiles));
@endphp

<div class="tw-space-y-3">
  @if($showHeader)
    <div class="tw-flex tw-flex-wrap tw-items-end tw-gap-x-6 tw-gap-y-1">
      <div class="tw-font-semibold tw-text-xl tw-text-blue-800 tw-flex tw-items-center tw-gap-2">
        <span class="tw-text-blue-700">Talentmap</span>
      </div>
      <div class="tw-text-sm tw-text-gray-600">
        No Data <span class="tw-font-semibold">{{ number_format($noData) }}</span>
      </div>
      <div class="tw-text-sm tw-text-gray-600">
        Total <span class="tw-font-semibold">{{ number_format($totalTalentmap) }}</span>
      </div>
      <div class="tw-text-sm tw-text-gray-600">
        <span class="tw-font-semibold">{{ $percentTalentmap }}</span>
        <span class="tw-italic tw-text-gray-500">(belum memiliki talentmapping)</span>
      </div>
    </div>
  @endif

  <div class="tw-grid tw-gap-3 sm:tw-grid-cols-3 md:tw-grid-cols-3">
    @foreach($tiles as $t)
      <div class="tw-rounded-lg tw-text-white tw-px-3 tw-py-2 tw-flex tw-flex-col tw-shadow-sm"
           style="background:linear-gradient(135deg, {{ $t['gradient'][0] }} 0%, {{ $t['gradient'][1] }} 100%);">
        <div class="tw-flex tw-justify-between tw-items-start tw-mb-1">
          <span class="tw-text-[11px] tw-font-semibold">{{ $t['label'] }}</span>
          <i class="{{ $t['icon'] }} tw-text-[16px] tw-opacity-80"></i>
        </div>
        <div class="tw-text-lg tw-font-semibold leading-none">
          {{ number_format($t['count']) }}
        </div>
        <div class="tw-text-[11px] tw-mt-1 tw-font-medium tw-opacity-90">
          {{ $t['percent'] }}
        </div>
      </div>
    @endforeach
  </div>
  <div class="tw-text-[10px] tw-text-gray-500 tw-mt-1">
    Total tile count: {{ number_format($sum) }}
  </div>
</div>