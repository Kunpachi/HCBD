@extends('layouts.app')
@section('title','Import Data Karyawan')
@section('content')
  @if(session('success'))
    <div class="alert alert-success small">{{ session('success') }}</div>
  @endif
  <form method="POST" action="{{ route('import.pegawai.import') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required accept=".xlsx,.xls">
    <button type="submit" class="btn btn-primary btn-sm mt-2">
      <i class="ti ti-upload"></i> Import
    </button>
  </form>
@endsection