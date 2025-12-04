@extends('layouts.app')

@section('content')
<div class="tw-grid tw-grid-cols-1 xl:tw-grid-cols-3 tw-gap-4">
  <!-- Kolom kiri (sidebar area untuk kartu) -->
  <div class="tw-space-y-4">
    <x-sidebar-retirement-card
      :items="[
        ['code'=>'BPDF','color'=>'#FF0000','data'=>[35,174,162,166,194],'years'=>[2025,2026,2027,2028,2029]],
        ['code'=>'BPIO','color'=>'#FF0000','data'=>[2,10,13,10,3],'years'=>[2025,2026,2027,2028,2029]],
        ['code'=>'BPRM','color'=>'#FF0000','data'=>[3,21,16,31,2],'years'=>[2025,2026,2027,2028,2029]],
        ['code'=>'BPWF','color'=>'#FF0000','data'=>[2,7,20,21,39],'years'=>[2025,2026,2027,2028,2029]],
      ]"
    />
    <!-- Tambahkan kartu sidebar lain di sini jika diperlukan -->
  </div>

  <!-- Kolom konten utama (grafik besar, tabel, dsb.) -->
  <div class="xl:tw-col-span-2 tw-space-y-4">
    {{-- Konten utama Management Anda yang sudah ada --}}
    @include('hr.partials.management-main')
  </div>
</div>
@endsection

@push('after-scripts')
{{-- Apex scripts akan dipush dari komponen --}}
@endpush