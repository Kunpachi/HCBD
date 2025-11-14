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
  $genX             = $genX             ?? 0;
  $genY             = $genY             ?? 0;
  $genZ             = $genZ             ?? 0;

  $pct = function($v,$t){ return $t>0 ? '(' . round($v/$t*100) . '%)' : '(0%)'; };

  $totalPct      = $totalEmployees ? '(100%)' : '(0%)';
  $talentPct     = $talentPct     ?? $pct($totalTalent,$totalEmployees);
  $disabilityPct = $disabilityPct ?? $pct($totalDisability,$totalEmployees);
  $malePct       = $malePct       ?? $pct($male,$totalEmployees);
  $femalePct     = $femalePct     ?? $pct($female,$totalEmployees);
  $genXPct       = $genXPct       ?? $pct($genX,$totalEmployees);
  $genYPct       = $genYPct       ?? $pct($genY,$totalEmployees);
  $genZPct       = $genZPct       ?? $pct($genZ,$totalEmployees);

  // Chart demo data
  $labels        = $labels        ?? ['7/12','8/12','9/12','10/12','11/12','12/12','13/12','14/12','15/12','16/12','17/12','18/12','19/12','20/12','21/12'];
  $balanceSeries = $balanceSeries ?? [270,190,210,180,260,245,65,85,185,150,160,95,140,95,60];
  $revenueSeries = $revenueSeries ?? [180,150,135,160,175,220,200,210,190,205,215,230,210,195,185];
@endphp

{{-- OPSIONAL: Info sample --}}
@if(!empty($usingSample))
  <div class="alert alert-info tw-text-sm tw-mb-4">
    Menampilkan data sample (database belum terhubung).
  </div>
@endif

{{-- HR Boxes (3 kolom terpisah) --}}
<div class="row g-4 mb-5">
  <div class="col-12 col-lg-4">
    <x-hr-box-total
      :totalEmployees="$totalEmployees"
      :totalTalent="$totalTalent"
      :totalDisability="$totalDisability"
      :totalPct="$totalPct"
      :talentPct="$talentPct"
      :disabilityPct="$disabilityPct"
      class="tw-h-full"
    />
  </div>
  <div class="col-12 col-lg-4">
    <x-hr-box-gender
      :male="$male"
      :female="$female"
      :malePct="$malePct"
      :femalePct="$femalePct"
      class="tw-h-full"
    />
  </div>
  
  <div class="col-12 col-lg-4">
    <x-hr-box-generation
      :genX="$genX"
      :genY="$genY"
      :genZ="$genZ"
      :genXPct="$genXPct"
      :genYPct="$genYPct"
      :genZPct="$genZPct"
      class="tw-h-full"
    />
  </div>
</div>

{{-- Chart section tetap --}}
<div class="row g-4 mb-4">
  <div class="col-12 col-xl-8">
    @if (View::exists('components.chart-latest-statistics'))
      <x-chart-latest-statistics />
    @else
      <div class="card tw-rounded-xl tw-p-4 tw-text-sm tw-text-gray-500">Komponen chart-latest-statistics belum tersedia.</div>
    @endif
  </div>
  <div class="col-12 col-xl-4">
    @if (View::exists('components.chart-user-devices'))
      <x-chart-user-devices chartId="devices-donut-chart"
        :labels="['Desktop','Tablet','Mobile']"
        :series="[80,10,10]" />
    @else
      <div class="card tw-rounded-xl tw-p-4 tw-text-sm tw-text-gray-500">Komponen chart-user-devices belum tersedia.</div>
    @endif
  </div>
</div>

<div class="row g-4">
  <div class="col-12 col-xl-8">
    @if (View::exists('components.line-metric-chart'))
      <x-line-metric-chart
        chartId="balance-chart"
        title="Balance"
        subtitle="Commercial networks & enterprises"
        value="$ 100,000"
        delta="-20%"
        color="#F7A827"
        :series="$balanceSeries"
        :labels="$labels"
        height="320"
      />
    @else
      <div class="card tw-rounded-xl tw-p-4 tw-text-sm tw-text-gray-500">Komponen line-metric-chart belum tersedia.</div>
    @endif
  </div>

  <div class="col-12 col-xl-4">
    @if (View::exists('components.line-metric-chart'))
      <x-line-metric-chart
        chartId="revenue-chart"
        title="Revenue"
        subtitle="Monthly recurring revenue"
        value="$ 42,500"
        delta="+12%"
        color="#16C9B2"
        :series="$revenueSeries"
        :labels="$labels"
        height="320"
        showMarkers="true"
      />
    @else
      <div class="card tw-rounded-xl tw-p-4 tw-text-sm tw-text-gray-500">Komponen line-metric-chart belum tersedia.</div>
    @endif
  </div>
</div>
@endsection