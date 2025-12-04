@extends('layouts.app')

@section('content')
<div class="tw-space-y-4">
  <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-4">
    @foreach($cards as $card)
      <x-hc-jt-donut-card
        :title="$card['title']"
        :pct="$card['pct']"
        :year="$card['year']"
        :formasi="$card['formasi']"
        :include="$card['include']"
        :exclude="$card['exclude']"
        size="190"
        ringThickness="32"
      />
    @endforeach
  </div>
</div>
@endsection

@push('after-scripts')
{{-- ApexCharts di-push dari komponen --}}
@endpush