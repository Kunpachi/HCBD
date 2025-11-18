@extends('layouts.app')
@section('title','Gender')
@section('content')
<div class="tw-space-y-8">

  <div id="male" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <h3 class="tw-text-base tw-font-semibold tw-mb-3">Male</h3>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>NIP</th><th>Nama</th><th>Unit Kerja</th><th>Job Title</th><th>Posisi</th><th>Grade</th><th>Gender</th>
          </tr>
        </thead>
        <tbody>
          @forelse($male as $r)
            <tr>
              <td>{{ $r['NIP'] }}</td>
              <td>{{ $r['Nama'] }}</td>
              <td>{{ $r['Unit'] }}</td>
              <td>{{ $r['JobTitle'] }}</td>
              <td>{{ $r['Posisi'] }}</td>
              <td>{{ $r['Grade'] }}</td>
              <td>{{ $r['Gender'] }}</td>
            </tr>
          @empty
            <tr><td colspan="7" class="tw-text-center tw-text-gray-500">Tidak ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div id="female" class="tw-rounded-2xl tw-border tw-border-gray-200 tw-bg-white tw-p-5">
    <h3 class="tw-text-base tw-font-semibold tw-mb-3">Female</h3>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th>NIP</th><th>Nama</th><th>Unit Kerja</th><th>Job Title</th><th>Posisi</th><th>Grade</th><th>Gender</th>
          </tr>
        </thead>
        <tbody>
          @forelse($female as $r)
            <tr>
              <td>{{ $r['NIP'] }}</td>
              <td>{{ $r['Nama'] }}</td>
              <td>{{ $r['Unit'] }}</td>
              <td>{{ $r['JobTitle'] }}</td>
              <td>{{ $r['Posisi'] }}</td>
              <td>{{ $r['Grade'] }}</td>
              <td>{{ $r['Gender'] }}</td>
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