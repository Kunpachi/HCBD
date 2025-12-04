@props([
  'rows' => [],
  'grandTotal' => null,
  'class' => '',
])

@php
  $fmt = fn($n) => number_format((int)$n,0,',','.');
  if(!is_array($rows) || !count($rows)){
    $rows = [
      ['dept'=>'Distribution & Funding','formasi'=>7748,'include'=>['jml'=>7514,'gap'=>-234,'pct'=>'97,0%'],'exclude'=>['jml'=>7477,'gap'=>-271,'pct'=>'96,5%']],
      ['dept'=>'IT & Operations','formasi'=>1389,'include'=>['jml'=>1356,'gap'=>-33,'pct'=>'97,6%'],'exclude'=>['jml'=>1352,'gap'=>-37,'pct'=>'97,3%']],
      ['dept'=>'Risk Management','formasi'=>1100,'include'=>['jml'=>1090,'gap'=>-10,'pct'=>'99,1%'],'exclude'=>['jml'=>1025,'gap'=>-75,'pct'=>'93,2%']],
      ['dept'=>'Wholesale, Consumer Banking & Finance','formasi'=>2123,'include'=>['jml'=>2097,'gap'=>-26,'pct'=>'98,8%'],'exclude'=>['jml'=>2062,'gap'=>-61,'pct'=>'97,1%']],
    ];
  }
  if(!is_array($grandTotal)){
    $sumForm = collect($rows)->sum('formasi');
    $sumIncJ = collect($rows)->sum(fn($r)=>$r['include']['jml']??0);
    $sumIncG = collect($rows)->sum(fn($r)=>$r['include']['gap']??0);
    $sumExcJ = collect($rows)->sum(fn($r)=>$r['exclude']['jml']??0);
    $sumExcG = collect($rows)->sum(fn($r)=>$r['exclude']['gap']??0);
    $grandTotal = [
      'formasi'=> $sumForm,
      'include'=> ['jml'=>$sumIncJ,'gap'=>$sumIncG,'pct'=>'97,5%'],
      'exclude'=> ['jml'=>$sumExcJ,'gap'=>$sumExcG,'pct'=>'96,4%'],
    ];
  }

  // SATU definisi grid konsisten untuk semua baris (kolom 2 = Formasi)
  // [Dept | Formasi | Inc Jml | Inc GAP | Inc % | Exc Jml | Exc GAP | Exc %]
  $gridCols = '1fr 90px 90px 90px 70px 90px 90px 70px';

  $gapBg = function($n){ return $n >= 0 ? 'rgba(16,185,129,0.15)' : 'rgba(239,68,68,0.15)'; };
  $gapColor = function($n){ return $n >= 0 ? '#16a34a' : '#ef4444'; };
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-0 {{ $class }}">
  <!-- Header biru muda: judul kolom -->
  <div class="tw-px-3 tw-py-2 tw-rounded-t-2xl tw-bg-[#eaf2ff] tw-text-blue-800 tw-text-[11px] tw-font-semibold">
    <div class="tw-grid tw-gap-3" style="grid-template-columns: {{ $gridCols }};">
      <div>HCBD Department</div>
      <div class="tw-text-right">Formasi</div>
      <div class="tw-col-span-3 tw-text-center">include Non Layer*</div>
      <div class="tw-col-span-3 tw-text-center">exclude Non Layer*</div>
    </div>
  </div>

  <!-- Subheader: label detail (harus sejajar dengan grid di atas) -->
  <div class="tw-px-3 tw-py-2 tw-bg-[#f6f8ff] tw-text-[11px] tw-text-blue-700 tw-border-b tw-border-gray-200">
    <div class="tw-grid tw-items-center tw-gap-3" style="grid-template-columns: {{ $gridCols }};">
      <div></div>  <!-- Dept -->
      <div></div>  <!-- Formasi -->
      <div class="tw-text-right">Jml Peg</div>
      <div class="tw-text-right">GAP (+/-)</div>
      <div class="tw-text-right">% GAP</div>
      <div class="tw-text-right">Jml Peg</div>
      <div class="tw-text-right">GAP (+/-)</div>
      <div class="tw-text-right">% GAP</div>
    </div>
  </div>

  <!-- Body -->
  <div class="tw-text-[11px] tw-text-gray-800">
    @foreach($rows as $r)
      @php
        $incGap = (int)($r['include']['gap'] ?? 0);
        $excGap = (int)($r['exclude']['gap'] ?? 0);
      @endphp
      <div class="tw-grid tw-items-center tw-px-3 tw-py-2 tw-border-b tw-border-gray-100 tw-gap-3" style="grid-template-columns: {{ $gridCols }};">
        <div class="tw-font-medium">{{ $r['dept'] }}</div>
        <!-- Formasi tepat di kolom 2, right-aligned -->
        <div class="tw-text-right tw-font-semibold">{{ $fmt($r['formasi'] ?? 0) }}</div>

        <div class="tw-text-right">{{ $fmt($r['include']['jml'] ?? 0) }}</div>
        <div class="tw-text-right tw-font-semibold" style="background:{{ $gapBg($incGap) }}; color:{{ $gapColor($incGap) }};">
          {{ ($incGap>=0?'+':'').$fmt($incGap) }}
        </div>
        <div class="tw-text-right">{{ $r['include']['pct'] ?? '-' }}</div>

        <div class="tw-text-right">{{ $fmt($r['exclude']['jml'] ?? 0) }}</div>
        <div class="tw-text-right tw-font-semibold" style="background:{{ $gapBg($excGap) }}; color:{{ $gapColor($excGap) }};">
          {{ ($excGap>=0?'+':'').$fmt($excGap) }}
        </div>
        <div class="tw-text-right">{{ $r['exclude']['pct'] ?? '-' }}</div>
      </div>
    @endforeach
  </div>

  <!-- Footer grand total -->
  <div class="tw-px-3 tw-py-2 tw-rounded-b-2xl tw-bg-[#083BD9] tw-text-white tw-text-[11px] tw-font-semibold">
    <div class="tw-grid tw-items-center tw-gap-3" style="grid-template-columns: {{ $gridCols }};">
      <div>Grand Total</div>
      <!-- Formasi grand total tepat di kolom 2, right-aligned -->
      <div class="tw-text-right">{{ $fmt($grandTotal['formasi'] ?? 0) }}</div>

      <div class="tw-text-right">{{ $fmt($grandTotal['include']['jml'] ?? 0) }}</div>
      <div class="tw-text-right">{{ ($grandTotal['include']['gap'] ?? 0) >= 0 ? '+'.$fmt($grandTotal['include']['gap']) : $fmt($grandTotal['include']['gap']) }}</div>
      <div class="tw-text-right">{{ $grandTotal['include']['pct'] ?? '-' }}</div>

      <div class="tw-text-right">{{ $fmt($grandTotal['exclude']['jml'] ?? 0) }}</div>
      <div class="tw-text-right">{{ ($grandTotal['exclude']['gap'] ?? 0) >= 0 ? '+'.$fmt($grandTotal['exclude']['gap']) : $fmt($grandTotal['exclude']['gap']) }}</div>
      <div class="tw-text-right">{{ $grandTotal['exclude']['pct'] ?? '-' }}</div>
    </div>
  </div>
</div>