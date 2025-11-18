@extends('layouts.app')

@section('title','Dashboard')

@section('content')
@php
  // Fallback agar tidak undefined
  $totalEmployees   = $totalEmployees   ?? 0;
  $totalTalent      = $totalTalent      ?? 0;
  $totalDisability  = $totalDisability  ?? 0;

  $male             = $male             ?? 0;
  $female           = $female           ?? 0;

  // Pendidikan
  $s1               = $s1               ?? 0;
  $s2               = $s2               ?? 0;
  $s3               = $s3               ?? 0;

  // Generation
  $genX             = $genX             ?? 0;
  $genY             = $genY             ?? 0;
  $genZ             = $genZ             ?? 0;

  // Helper persen
  $pct = function($v,$t){ return $t>0 ? '(' . round($v/$t*100) . '%)' : '(0%)'; };

  // Persentase
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

{{-- OPSIONAL: Info sample --}}
@if(!empty($usingSample))
  <div class="alert alert-info tw-text-sm tw-mb-4">
    Menampilkan data sample (database belum terhubung).
  </div>
@endif

{{-- ROW 1: 3 kolom (Total | Gender | GAP) --}}
<div class="row g-4 mb-4">
  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-total
      :totalEmployees="$totalEmployees"
      :totalTalent="$totalTalent"
      :totalDisability="$totalDisability"
      :totalPct="$totalPct"
      :talentPct="$talentPct"
      :disabilityPct="$disabilityPct"
      :updatedAt="now()"
      class="tw-h-full tw-w-full"
    />
  </div>

  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-gender
      :male="$male"
      :female="$female"
      :malePct="$malePct"
      :femalePct="$femalePct"
      :totalEmployees="$totalEmployees"
      :updatedAt="now()"
      :linkBase="route('hr.gender')"
      class="tw-h-full tw-w-full"
    />
  </div>

  <div class="col-12 col-xl-4 d-flex">
    <x-hr-box-gap
      :male="$male"
      :female="$female"
      :totalEmployees="$totalEmployees"
      :updatedAt="now()"
      :linkBase="route('hr.gap')"
      class="tw-h-full tw-w-full"
    />
  </div>
</div>

{{-- ROW 2: 2 kolom (Generation | Pendidikan) --}}
<div class="row g-4 mb-5">
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-box-generation
      :genX="$genX"
      :genY="$genY"
      :genZ="$genZ"
      :genXPct="$genXPct"
      :genYPct="$genYPct"
      :genZPct="$genZPct"
      :updatedAt="now()"
      :linkBase="route('hr.generation')"
      class="tw-h-full tw-w-full"
    />
  </div>

  <div class="col-12 col-xl-6 d-flex">
    <x-hr-box-pendidikan
      :s1="$s1"
      :s2="$s2"
      :s3="$s3"
      :s1Pct="$s1Pct"
      :s2Pct="$s2Pct"
      :s3Pct="$s3Pct"
      :updatedAt="now()"
      :linkBase="route('hr.education') ?? null"
      class="tw-h-full tw-w-full" 
    />
  </div>

  <div class="row g-4 mb-5">
  {{-- Gunakan 8/4 sejak lg supaya tidak 50/50 --}}
  <div class="col-12 col-lg-8 col-xl-8 d-flex">
    <x-hr-talentmap-card
      :tiles="$tmTiles ?? null"          {{-- biarkan null agar komponen pakai default tiles-nya --}}
      :noData="$tmNoData ?? 0"
      :totalTalentmap="$tmTotal ?? 3251"
      :percentTalentmap="$tmPercent ?? '25,53%'"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>

  <div class="col-12 col-lg-4 col-xl-4 d-flex">
    {{-- Agar pasti tampil, kirim fallback grades/series jika variabel belum ada --}}
    <x-hr-person-grade-card
      chartId="person-grade-chart"
      :grades="$pgLabels ?? ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','4A','4B','4C','5A','5B']"
      :series="$pgSeries ?? [49,509,1073,3171,2793,366,1884,1130,786,215,20,23,18,10,3,3]"
      :updatedAt="now()"
      height="320"
      class="tw-w-full"
    />
  </div>
</div>

{{-- <div class="row g-4 mb-5">
  <div class="col-12 col-xl-6 d-flex">
    <x-hr-retirement-chart
      chartId="retirement-chart"
      :years="$retirementYears ?? ['2025','2026','2027','2028','2029']"
      :series="$retirementSeries ?? [43,222,248,231,238]"
      height="300"
      title="Pegawai Pensiun"
      class="tw-w-full"
    />
  </div>
</div> --}}
  {{-- <div class="row g-4 mb-5">
    <div class="col-12 col-xl-6">
      <x-hr-assessment-year-chart />
    </div>
    <div class="col-12 col-xl-6"> --}}
      {{-- Bisa isi kartu lain / donut talentmap tingkat lanjut --}}
      {{-- <div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-6 tw-text-sm tw-text-gray-500">
        Placeholder konten tambahan.
      </div>
    </div> --}}
  </div>
</div>
@endsection