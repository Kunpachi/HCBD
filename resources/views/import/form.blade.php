@extends('layouts.app')

@section('title', 'Import Pegawai')

@section('content')
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Import Pegawai</h5>
    </div>
    <div class="card-body">
      <form id="import-form">
        <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Upload & Import</button>
      </form>

      <hr>
      <pre id="log" class="mt-3" style="white-space:pre-wrap;background:#f6f8fa;padding:12px;border-radius:8px;">Menunggu upload...</pre>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.getElementById('import-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  const log = document.getElementById('log');
  log.textContent = 'Mengunggah & memproses...';

  const fd = new FormData();
  const file = document.getElementById('file').files[0];
  if (!file) { log.textContent = 'Pilih file terlebih dahulu.'; return; }
  fd.append('file', file);

  try {
    const res = await fetch('{{ route('import.pegawai.import') }}', {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
      },
      body: fd
    });
    const data = await res.json();
    log.textContent = JSON.stringify(data, null, 2);
  } catch (err) {
    log.textContent = 'Gagal: ' + (err?.message || String(err));
  }
});
</script>
@endpush