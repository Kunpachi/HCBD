@props([
  'title' => 'Section',
  'items' => [],   // array of item: [icon, label, value, fg, bg]
])

<div class="tw-flex tw-items-center tw-gap-6 tw-flex-wrap">
  <div class="tw-text-[11px] tw-font-semibold tw-text-gray-700 tw-uppercase">{{ $title }}</div>
  <div class="tw-flex tw-items-center tw-gap-5 tw-flex-wrap">
    @foreach($items as $it)
      <x-hc-card-chip
        :icon="$it['icon'] ?? 'ti ti-info-circle'"
        :label="$it['label'] ?? ''"
        :value="$it['value'] ?? ''"
        :fg="$it['fg'] ?? '#374151'"
        :bg="$it['bg'] ?? '#e5e7eb'"
      />
    @endforeach
  </div>
</div>