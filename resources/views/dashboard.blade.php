@extends('layouts.app')
@section('title','Dashboard')
@section('content')

@php
  $totalEmployees   = $totalEmployees   ?? 0;
  $totalTalent      = $totalTalent      ?? 0;
  $totalDisability  = $totalDisability  ?? 0;
  $male = $male ?? 0; $female = $female ?? 0;
  $s1 = $s1 ?? 0; $s2 = $s2 ?? 0; $s3 = $s3 ?? 0;
  $genX = $genX ?? 0; $genY = $genY ?? 0; $genZ = $genZ ?? 0;
  $pct = fn($v,$t) => $t>0 ? '(' . round($v/$t*100) . '%)' : '(0%)';
  $totalPct      = $totalEmployees ? '(100%)' : '(0%)';
  $talentPct     = $talentPct     ?? $pct($totalTalent,$totalEmployees);
  $disabilityPct = $disabilityPct ?? $pct($totalDisability,$totalEmployees);
  $malePct       = $malePct       ?? $pct($male,$totalEmployees);
  $femalePct     = $femalePct     ?? $pct($female,$totalEmployees);
  $s1Pct         = $s1Pct         ?? $pct($s1,$totalEmployees);
  $s2Pct         = $s2Pct         ?? $pct($s2,$totalEmployees);
  $s3Pct         = $s3Pct         ?? $pct($s3,$totalEmployees);
  $genXPct       = $genXPct       ?? $pct($genX,$totalEmployees);
  $genYPct       = $genYPct       ?? $pct($genY,$totalEmployees);
  $genZPct       = $genZPct       ?? $pct($genZ,$totalEmployees);
@endphp

@if(!empty($usingSample))
  <div class="alert alert-info tw-text-sm tw-mb-4">Menampilkan data sample (database belum terhubung).</div>
@endif

<div class="row g-4 mb-4">
  <div class="col-12 col-xl-6 d-flex">
    <x-hc-consolidated-inner-card
      :formasi="$formasiConsolidated ?? 0"
      :jumlahPegawai="$jumlahConsolidated ?? 0"
      :gap="($gapConsolidated ?? null)"      {{-- null = otomatis formasi - jumlah --}}
      :gapPct="($gapPctConsolidated ?? null)"{{-- null = otomatis (gap/formasi)*100 --}}
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
  <div class="col-12 col-xl-6 d-flex">
     <x-hc-hcbd-consolidated-only-inner-card
      :formasi="$formasiHCBD ?? 0"
      :jumlahPegawai="$jumlahHCBD ?? 0"
      :gap="($gapHCBD ?? null)"
      :gapPct="($gapPctHCBD ?? null)"
      :male="$maleHCBD ?? 0"
      :female="$femaleHCBD ?? 0"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
</div>


<div class="row g-4 mb-4">
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-box-generation :genX="$genX" :genY="$genY" :genZ="$genZ"
                         :genXPct="$genXPct" :genYPct="$genYPct" :genZPct="$genZPct"
                         :updatedAt="now()" class="tw-w-full"/>
  </div>
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-box-pendidikan :s1="$s1" :s2="$s2" :s3="$s3"
                         :s1Pct="$s1Pct" :s2Pct="$s2Pct" :s3Pct="$s3Pct"
                         :updatedAt="now()" class="tw-w-full"/>
  </div>
</div>

<div class="row g-4 mb-5">
  <div class="col-12 col-xl-6 d-flex">
    {{-- <x-hr-talentmap-legacy-card
      :noData="$tmNoData ?? 0"
      :totalTalentmap="$tmTotal ?? 3251"
      :percentTalentmap="$tmPercent ?? '25,53%'"
      :tiles="$tmTiles ?? null"
      :updatedAt="now()"
      contentMaxWidth="470"
      tileWidth="145"
      tileHeight="74"
      columns="3"
      class="tw-w-full"
    /> --}}
    <x-hr-talentmap-legacy-card
      :noData="$tmNoData ?? 0"
      :totalTalentmap="$tmTotal ?? 3251"
      :percentTalentmap="$tmPercent ?? '25,53%'"
      :tiles="$tmTiles ?? null"
      :updatedAt="now()"
      contentMaxWidth="470"
      tileWidth="145"
      tileHeight="74"
      columns="3"
      class="tw-w-full"
    />
   
  </div>
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-person-grade-legacy-card
      chartId="person-grade-chart"
      :grades="$pgLabels ?? null"
      :series="$pgSeries ?? null"
      :updatedAt="now()"
      chartHeight="210"
      class="tw-w-full"
    />
  </div>
</div>

<div class="row g-4 mb-5">
  <div class="col-12 col-xl-6 d-flex">
   <x-hr-retirement-legacy-card
      chartId="retirement-chart"
      :years="$retirementYears ?? ['2025','2026','2027','2028','2029']"
      :series="$retirementSeries ?? [43,222,248,231,238]"
      :updatedAt="now()"
      chartHeight="140"
      class="tw-w-full"
    />
  </div> 

   <div class="col-12 col-xl-6 d-flex">
     <x-hr-assessment-year-card
      chartId="assessment-year-chart"
      :years="$assessmentYears ?? ['2018','2019','2020','2021','2022','2023','2024','2025']"
      :series="$assessmentSeries ?? [3,3,9,947,690,996,4769,1565]"
      :updatedAt="now()"
      chartHeight="140"
      class="tw-w-full"
    />
  </div>
  
</div>

<div class="row g-4 mb-5">
  <div class="col-12 d-flex">
    {{-- <x-hr-soccer-field-card
      :row="[
        'field' => 'Grand Total',
        'target' => '100%',
        'totalEmployees' => $sfTotal ?? 12852,
        'pctField' => '100%',
        'pctGapField' => ($sfGapPct ?? '-1,0%'),
        'gapPegawai' => ($sfGapCount ?? 125),
      ]"
      :updatedAt="now()"
      class="tw-w-full"
    /> --}}
    <x-hr-soccer-field-card
      :rows="[
        ['name'=>'Sales','target'=>'21%','totalEmployees'=>2574,'pctField'=>'20,0%','pctGapField'=>'-1,0%','gapPegawai'=>125],
        ['name'=>'Bisnis Non Sales','target'=>'30%','totalEmployees'=>3952,'pctField'=>'30,8%','pctGapField'=>'0,8%','gapPegawai'=>-97],
        ['name'=>'IT & Digital','target'=>'3%','totalEmployees'=>371,'pctField'=>'2,9%','pctGapField'=>'-0,1%','gapPegawai'=>15],
        ['name'=>'Operations','target'=>'34%','totalEmployees'=>4630,'pctField'=>'36,0%','pctGapField'=>'2,0%','gapPegawai'=>-261],
        ['name'=>'Shared Service','target'=>'12%','totalEmployees'=>1325,'pctField'=>'10,3%','pctGapField'=>'-1,7%','gapPegawai'=>218],
      ]"
      :grandTotal="[
        'target'=>'100%',
        'totalEmployees'=>12852,
        'pctField'=>'100%',
        'pctGapField'=>'0,0%',
        'gapPegawai'=>125-97+15-261+218, // contoh perhitungan
      ]"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
                              

</div>
@endsection