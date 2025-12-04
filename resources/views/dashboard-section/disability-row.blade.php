<div class="row g-4 mb-4">
  <div class="col-12 d-flex">
    <x-hc-disability-card
      :totalEmployees="$jumlahHCBD ?? 0"
      :disabilityCount="$totalDisability ?? 0"
      :updatedAt="now()"
      class="tw-w-full"
    />
  </div>
</div>