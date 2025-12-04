@extends('layouts.app')
@section('title','Pemenuhan Kepegawaian')

@section('content')
<div class="tw-space-y-6">

  
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

    <div class="tw-space-y-6">

      {{-- Donut KPI BP --}}
      <x-hr-fulfillment-bp-donuts
        :items="$bpDonuts ?? [
          ['label'=>'BP-Risk Management','value'=>99.1],
          ['label'=>'BP-Distribution & Funding','value'=>97.0],
          ['label'=>'BP-IT & Operations','value'=>97.6],
          ['label'=>'BP-Wholesale, Consumer & Finance','value'=>98.8],
        ]"
        size="100"
        ringThickness="22"
      />
      

      {{-- Tabel pemenuhan --}}
      <x-hr-fulfillment-bp-table
        :rows="$fulfillmentRows ?? []"
        :grandTotal="$fulfillmentGrand ?? null"
      />

    </div>
    <div class="row g-4 mb-5">
      <x-hc-retirement-card-bp
          :items="[
            ['code'=>'BPDF','color'=>'#FF0000','data'=>[35,174,162,166,194],'years'=>[2025,2026,2027,2028,2029]],
            ['code'=>'BPIO','color'=>'#FF0000','data'=>[2,10,13,10,3],'years'=>[2025,2026,2027,2028,2029]],
            ['code'=>'BPRM','color'=>'#FF0000','data'=>[3,21,16,31,2],'years'=>[2025,2026,2027,2028,2029]],
            ['code'=>'BPWF','color'=>'#FF0000','data'=>[2,7,20,21,39],'years'=>[2025,2026,2027,2028,2029]],
          ]"
          
      />
    </div>
  </div>

  @if(!empty($breakdown))
  <div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <div class="tw-text-sm tw-font-semibold tw-text-gray-800 tw-mb-3">Breakdown Pemenuhan</div>
    <div class="tw-overflow-x-auto">
      <table class="tw-w-full tw-text-[11px]">
        <thead class="tw-bg-gray-100 tw-text-gray-700">
          <tr>
            <th class="tw-px-3 tw-py-2 tw-text-left">Unit</th>
            <th class="tw-px-3 tw-py-2 tw-text-right">Formasi</th>
            <th class="tw-px-3 tw-py-2 tw-text-right">Aktual</th>
            <th class="tw-px-3 tw-py-2 tw-text-right">GAP</th>
            <th class="tw-px-3 tw-py-2 tw-text-right">%GAP</th>
          </tr>
        </thead>
        <tbody>
          @foreach($breakdown as $b)
            @php
              $gapUnit = ($b['formasi'] ?? 0) - ($b['aktual'] ?? 0);
              $gapPctUnit = ($b['formasi'] ?? 0) > 0 ? round(($gapUnit / $b['formasi']) * 100, 1).'%' : '0%';
            @endphp
            <tr class="tw-border-t">
              <td class="tw-px-3 tw-py-2">{{ $b['name'] ?? '-' }}</td>
              <td class="tw-px-3 tw-py-2 tw-text-right">{{ number_format($b['formasi'] ?? 0,0,',','.') }}</td>
              <td class="tw-px-3 tw-py-2 tw-text-right">{{ number_format($b['aktual'] ?? 0,0,',','.') }}</td>
              <td class="tw-px-3 tw-py-2 tw-text-right">{{ ($gapUnit>=0?'+':'').number_format($gapUnit,0,',','.') }}</td>
              <td class="tw-px-3 tw-py-2 tw-text-right">{{ $gapPctUnit }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif

</div>
@endsection