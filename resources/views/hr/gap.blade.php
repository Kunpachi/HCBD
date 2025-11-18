@extends('layouts.app')
@section('title','GAP')
@section('content')
<div class="tw-space-y-8">
  <div id="gap" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <h3 class="tw-text-base tw-font-semibold tw-mb-3">GAP (Kebutuhan + Pensiun - Ada)</h3>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead><tr>
          <th>Kategori</th><th>Kebutuhan</th><th>Pensiun (periode)</th><th>Ada</th><th>GAP</th>
        </tr></thead>
        <tbody>
          @forelse($rows as $r)
            <tr>
              <td>{{ $r['Kategori'] }}</td>
              <td>{{ $r['Kebutuhan'] }}</td>
              <td>{{ $r['Pensiun'] }}</td>
              <td>{{ $r['Ada'] }}</td>
              <td>{{ $r['GAP'] }}</td>
            </tr>
          @empty
            <tr><td colspan="5" class="tw-text-center tw-text-gray-500">Tidak ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div id="gap-percent" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <h3 class="tw-text-base tw-font-semibold tw-mb-3">GAP%</h3>
    <p class="tw-text-sm tw-text-gray-600">Menampilkan selisih dalam persen (bisa dihitung berdasar kebutuhan).</p>
  </div>
</div>
@endsection