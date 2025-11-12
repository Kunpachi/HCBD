@extends('layouts.app')

@section('title','Dashboard')

@section('content')
@php
  // Data contoh; ambil dari controller bila tersedia
  $labels = ['7/12','8/12','9/12','10/12','11/12','12/12','13/12','14/12','15/12','16/12','17/12','18/12','19/12','20/12','21/12'];
  $balanceSeries = [270,190,210,180,260,245,65,85,185,150,160,95,140,95,60];
  $revenueSeries = [180,150,135,160,175,220,200,210,190,205,215,230,210,195,185];
  $totalUsers = isset($users) ? count($users) : 0;
@endphp

{{-- ROW: Metric cards (8) --}}
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Jumlah Pegawai" :value="$totalUsers" percent="(100%)" bg="tw-bg-indigo-500" icon="ti ti-users"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Jumlah Talent" value="0" percent="(+95%)" bg="tw-bg-teal-400" icon="ti ti-user-plus"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Male" value="0" percent="(0%)" bg="tw-bg-blue-500" icon="ti ti-gender-male"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Female" :value="$totalUsers" percent="(+6%)" bg="tw-bg-amber-400" icon="ti ti-gender-female"/>
  </div>

  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Disability" value="0" percent="(+0%)" bg="tw-bg-cyan-500" icon="ti ti-accessible"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen Z" value="0" percent="(+0%)" bg="tw-bg-indigo-500" icon="ti ti-flame"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen Y" value="0" percent="(+0%)" bg="tw-bg-gray-600" icon="ti ti-shield-check"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen X" value="0" percent="(-0%)" bg="tw-bg-red-500" icon="ti ti-user-exclamation"/>
  </div>
</div>

{{-- ROW: Bar chart + Donut (optional, sesuaikan jika sudah punya) --}}
<div class="row g-4 mb-4">
  <div class="col-12 col-xl-8">
    <x-chart-latest-statistics />
  </div>
  <div class="col-12 col-xl-4">
    <x-chart-user-devices chartId="devices-donut-chart"
      :labels="['Desktop','Tablet','Mobile']"
      :series="[80,10,10]" />
  </div>
</div>

{{-- ROW: 2 Line charts --}}
<div class="row g-4">
  <div class="col-12 col-xl-8">
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
  </div>

  <div class="col-12 col-xl-4">
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
  </div>
</div>
@endsection