@extends('layouts.app')
@section('title','Total Kepegawaian')
@section('content')
<div class="tw-space-y-8">

  <div id="pegawai" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <div class="tw-flex tw-items-center tw-justify-between tw-mb-3">
      <h3 class="tw-text-base tw-font-semibold">Jumlah Pegawai</h3>
      <a href="#talent" class="tw-text-xs tw-text-indigo-600">→ Talent</a>
    </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>NIP</th><th>Nama</th><th>Unit Kerja</th><th>Job Title</th><th>Posisi</th><th>Grade</th><th>Gender</th><th>Generation</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pegawai as $r)
            <tr>
              <td>{{ $r['NIP'] }}</td>
              <td>{{ $r['Nama'] }}</td>
              <td>{{ $r['Unit'] }}</td>
              <td>{{ $r['JobTitle'] }}</td>
              <td>{{ $r['Posisi'] }}</td>
              <td>{{ $r['Grade'] }}</td>
              <td>{{ $r['Gender']}}</td>
              <td>{{ $r['Generation']}}</td>
              <td>{{ $r['Status'] }}</td>
            </tr>
          @empty
            <tr><td colspan="7" class="tw-text-center tw-text-gray-500">Tidak ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div id="talent" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <div class="tw-flex tw-items-center tw-justify-between tw-mb-3">
      <h3 class="tw-text-base tw-font-semibold">Jumlah Talent</h3>
      <a href="#disability" class="tw-text-xs tw-text-indigo-600">→ Disability</a>
    </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>NIP</th><th>Nama</th><th>Unit Kerja</th><th>Job Title</th><th>Posisi</th><th>Grade</th><th>Gender</th><th>Generation</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($talent as $r)
            <tr>
              <td>{{ $r['NIP'] }}</td>
              <td>{{ $r['Nama'] }}</td>
              <td>{{ $r['Unit'] }}</td>
              <td>{{ $r['JobTitle'] }}</td>
              <td>{{ $r['Posisi'] }}</td>
              <td>{{ $r['Grade'] }}</td>
              <td>{{ $r['Gender']}}</td>
              <td>{{ $r['Generation']}}</td>
              <td>{{ $r['Status'] }}</td>
            </tr>
          @empty
            <tr><td colspan="7" class="tw-text-center tw-text-gray-500">Tidak ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div id="disability" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <h3 class="tw-text-base tw-font-semibold tw-mb-3">Disability</h3>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>NIP</th><th>Nama</th><th>Unit Kerja</th><th>Job Title</th><th>Posisi</th><th>Grade</th><th>Gender</th><th>Generation</th><th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($disability as $r)
            <tr>
              <td>{{ $r['NIP'] }}</td>
              <td>{{ $r['Nama'] }}</td>
              <td>{{ $r['Unit'] }}</td>
              <td>{{ $r['JobTitle'] }}</td>
              <td>{{ $r['Posisi'] }}</td>
              <td>{{ $r['Grade'] }}</td>
              <td>{{ $r['Status'] }}</td>
            </tr>
          @empty
            <tr><td colspan="7" class="tw-text-center tw-text-gray-500">Tidak ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection