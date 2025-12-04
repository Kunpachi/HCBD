@props([
  'title' => 'Soccer Field (Consolidated)',
  'icon'  => 'ti ti-ball-football',
  'updatedAt' => null,

  // Data baris kategori (array of arrays)
  // Setiap item:
  // [
  //   'name' => 'Sales',
  //   'target' => '21%',
  //   'totalEmployees' => 2574,
  //   'pctField' => '20,0%',
  //   'pctGapField' => '-1,0%',  // bisa negatif/positif
  //   'gapPegawai' => 125        // angka, bisa negatif
  // ]
  'rows' => [],

  // Data grand total (opsional, jika kosong akan dihitung dari rows)
  // ['target'=>'100%','totalEmployees'=>12852,'pctField'=>'100%','pctGapField'=>'-1,0%','gapPegawai'=>125]
  'grandTotal' => null,

  // Opsi tampilan
  'class' => '',
  'headerFrom' => '#0053D9',
  'headerTo'   => '#0038A8',
  'useLocaleFormat' => true,
])

@php
  $updatedLabel = $updatedAt
    ? (is_string($updatedAt) ? $updatedAt : $updatedAt->format('Y-m-d H:i:s'))
    : now()->format('Y-m-d H:i:s');

  // Fallback rows contoh seperti screenshot
  if (!is_array($rows) || !count($rows)) {
    $rows = [
      ['name'=>'Sales','target'=>'21%','totalEmployees'=>2574,'pctField'=>'20,0%','pctGapField'=>'-1,0%','gapPegawai'=>125],
      ['name'=>'Bisnis Non Sales','target'=>'30%','totalEmployees'=>3952,'pctField'=>'30,8%','pctGapField'=>'0,8%','gapPegawai'=>-97],
      ['name'=>'IT & Digital','target'=>'3%','totalEmployees'=>371,'pctField'=>'2,9%','pctGapField'=>'-0,1%','gapPegawai'=>15],
      ['name'=>'Operations','target'=>'34%','totalEmployees'=>4630,'pctField'=>'36,0%','pctGapField'=>'2,0%','gapPegawai'=>-261],
      ['name'=>'Shared Service','target'=>'12%','totalEmployees'=>1325,'pctField'=>'10,3%','pctGapField'=>'-1,7%','gapPegawai'=>218],
    ];
  }

  // Hitung grand total jika tidak disediakan
  if (!is_array($grandTotal)) {
    $sumEmp = collect($rows)->sum('totalEmployees');
    $sumGap = collect($rows)->sum('gapPegawai');
    $grandTotal = [
      'target'         => '100%',
      'totalEmployees' => $sumEmp,
      'pctField'       => '100%',
      'pctGapField'    => '0,0%',
      'gapPegawai'     => $sumGap,
    ];
  }

  $fmtInt = function($v) use ($useLocaleFormat){
    $n = (int)$v;
    return $useLocaleFormat ? number_format($n,0,',','.') : (string)$n;
  };

  // Helper latar untuk kolom GAP Pegawai
  $bgGapPegawai = function($n){
    return $n > 0 ? 'rgba(16,185,129,0.18)' : ($n < 0 ? 'rgba(239,68,68,0.18)' : 'rgba(148,163,184,0.20)');
  };
  $textGapPegawai = function($n){
    return $n > 0 ? '#16a34a' : ($n < 0 ? '#ef4444' : '#64748b');
  };

  // Latar untuk kolom % GAP Field (oranye muda netral)
  $bgPctGapField = 'rgba(245,158,11,0.18)'; // amber-500/18
@endphp

<div class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-0 {{ $class }}">
  <!-- Header biru penuh -->
  <div class="tw-rounded-t-2xl tw-px-5 tw-py-2.5 tw-flex tw-items-center tw-justify-between"
       style="background:linear-gradient(90deg, {{ $headerFrom }} 0%, {{ $headerTo }} 100%);">
    <div class="tw-flex tw-items-center tw-gap-2">
      <i class="{{ $icon }} tw-text-white tw-text-sm"></i>
      <span class="tw-text-[12px] tw-font-semibold tw-tracking-wide tw-text-white">{{ $title }}</span>
    </div>
    <span class="tw-text-[11px] tw-font-medium tw-text-white/90">{{ $updatedLabel }}</span>
  </div>

  <!-- Isi -->
  <div class="tw-px-5 tw-pt-3 tw-pb-4">

    <!-- Header tabel (light blue) -->
    <div class="tw-rounded-lg tw-bg-[#eaf2ff] tw-text-blue-800 tw-text-[11px] tw-font-semibold tw-flex tw-items-center tw-px-3 tw-py-2 tw-gap-3">
      <div class="tw-flex-1">Soccer Field 2025</div>
      <div class="tw-w-24 tw-text-right">Target Field ’25</div>
      <div class="tw-w-28 tw-text-right">Jml Pegawai</div>
      <div class="tw-w-24 tw-text-right">% Field</div>
      <div class="tw-w-24 tw-text-right">% GAP Field</div>
      <div class="tw-w-28 tw-text-right">GAP Pegawai</div>
    </div>

    <!-- Body tabel: baris kategori -->
    <div class="tw-text-[11px] tw-text-gray-800 tw-divide-y tw-divide-gray-100">
      @foreach($rows as $r)
        @php
          $gap = (int)($r['gapPegawai'] ?? 0);
          $gapBg = $bgGapPegawai($gap);
          $gapTxt= $textGapPegawai($gap);
        @endphp
        <div class="tw-flex tw-items-center tw-px-3 tw-py-2 tw-gap-3">
          <div class="tw-flex-1">{{ $r['name'] ?? '-' }}</div>
          <div class="tw-w-24 tw-text-right">{{ $r['target'] ?? '-' }}</div>
          <div class="tw-w-28 tw-text-right">{{ $fmtInt($r['totalEmployees'] ?? 0) }}</div>
          <div class="tw-w-24 tw-text-right">{{ $r['pctField'] ?? '-' }}</div>
          <div class="tw-w-24 tw-text-right" style="background:{{ $bgPctGapField }};">{{ $r['pctGapField'] ?? '-' }}</div>
          <div class="tw-w-28 tw-text-right tw-font-semibold" style="background:{{ $gapBg }}; color:{{ $gapTxt }};">
            <span class="tw-inline-block tw-px-2 tw-py-0.5">{{ ($gap>=0?'+':'').$fmtInt($gap) }}</span>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Footer Grand Total -->
    <div class="tw-mt-2 tw-rounded tw-bg-[#083bd9] tw-text-white tw-text-[11px] tw-font-semibold tw-flex tw-items-center tw-px-3 tw-py-2 tw-gap-3">
      <div class="tw-flex-1">Grand Total</div>
      <div class="tw-w-24 tw-text-right">{{ $grandTotal['target'] ?? '100%' }}</div>
      <div class="tw-w-28 tw-text-right">{{ $fmtInt($grandTotal['totalEmployees'] ?? 0) }}</div>
      <div class="tw-w-24 tw-text-right">{{ $grandTotal['pctField'] ?? '100%' }}</div>
      <div class="tw-w-24 tw-text-right">{{ $grandTotal['pctGapField'] ?? '0,0%' }}</div>
      <div class="tw-w-28 tw-text-right">{{ ($grandTotal['gapPegawai'] ?? 0) >= 0 ? '+'.$fmtInt($grandTotal['gapPegawai'] ?? 0) : $fmtInt($grandTotal['gapPegawai'] ?? 0) }}</div>
    </div>

    <div class="tw-text-[10px] tw-text-gray-400 tw-mt-2">Data soccer field mengacu pada klasifikasi HCSD.</div>
  </div>
</div>