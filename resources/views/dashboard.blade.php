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
  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-total :totalEmployees="$totalEmployees" :totalTalent="$totalTalent"
                    :totalDisability="$totalDisability" :totalPct="$totalPct"
                    :talentPct="$talentPct" :disabilityPct="$disabilityPct"
                    :updatedAt="now()" class="tw-w-full"/>
  </div>
  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-gender :male="$male" :female="$female"
                     :malePct="$malePct" :femalePct="$femalePct"
                     :totalEmployees="$totalEmployees" :updatedAt="now()" class="tw-w-full"/>
  </div>
  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-gap :male="$male" :female="$female" :totalEmployees="$totalEmployees"
                  :updatedAt="now()" class="tw-w-full"/>
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

{{-- <div class="row g-4 mb-5">
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-retirement-legacy-card
      chartId="retirement-chart"
      :years="$retirementYears ?? ['2025','2026','2027','2028','2029']"
      :series="$retirementSeries ?? [43,222,248,231,238]"
      :updatedAt="now()"
      chartHeight="140"
      class="tw-w-full"
    />
  </div> --}}

  {{-- <div class="col-12 col-xl-6 d-flex">
    <x-hr-retirement-legacy-card
      chartId="retirement-chart"
      :years="$retirementYears ?? ['2025','2026','2027','2028','2029']"
      :series="$retirementSeries ?? [43,222,248,231,238]"
      :updatedAt="now()"
      chartHeight="140"
      class="tw-w-full"
    />
  </div> --}}
{{-- </div> --}}
@endsection