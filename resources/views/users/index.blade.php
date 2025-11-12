@extends('layouts.app')

@section('title','User Management')

@section('content')


<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Jumlah Pegawai" :value="count($users)" percent="(100%)" bg="tw-bg-indigo-500" icon="ti ti-users"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Jumlah Talent" value="0" percent="(+95%)" bg="tw-bg-teal-400" icon="ti ti-user-plus"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Male" value="0" percent="(0%)" bg="tw-bg-blue-500" icon="ti ti-gender-male"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Female" :value="count($users)" percent="(+6%)" bg="tw-bg-amber-400" icon="ti ti-gender-female"/>
  </div>

  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Disability" value="0" percent="(+0%)" bg="tw-bg-cyan-500" icon="ti ti-accessible"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen Z" value="0" percent="(+0%)" bg="tw-bg-indigo-500" icon="ti ti-rocket"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen Y" value="0" percent="(+0%)" bg="tw-bg-gray-600" icon="ti ti-shield-check"/>
  </div>
  <div class="col-6 col-md-3">
    <x-metric-card variant="minimal" label="Gen X" value="0" percent="(-0%)" bg="tw-bg-red-500" icon="ti ti-flame"/>
  </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-xl-8">
      <x-chart-latest-statistics/>
    </div>
    <div class="col-12 col-xl-4">
      <x-chart-user-devices chartId="devices-donut-chart"
        :labels="['Desktop','Tablet','Mobile']"
        :series="[80,10,10]" />
    </div>
</div>

@include('dashboard')

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">7</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">10</a></li>
                    <li><a class="dropdown-item" href="#">25</a></li>
                </ul>
            </div>
            <input type="text" placeholder="Search User" class="form-control form-control-sm" style="width:220px">
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle">Export</button>
            </div>
            <button class="btn btn-primary btn-sm">
                <i class="ti ti-plus me-1"></i> Add New User
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Verified</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td class="d-flex align-items-center gap-2">
                        <div class="tw-w-9 tw-h-9 tw-rounded-full tw-bg-indigo-100 tw-flex tw-items-center tw-justify-center tw-font-bold tw-text-indigo-600">
                            {{ strtoupper(substr($user['name'],0,2)) }}
                        </div>
                        <div>
                            <div class="tw-font-medium">{{ $user['name'] }}</div>
                            <small class="tw-text-gray-400">{{ $user['email'] }}</small>
                        </div>
                    </td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        @if($user['verified'])
                            <span class="badge bg-success"><i class="ti ti-check"></i></span>
                        @else
                            <span class="badge bg-secondary"><i class="ti ti-x"></i></span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-inline-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-text-secondary"><i class="ti ti-edit"></i></button>
                            <button class="btn btn-sm btn-text-danger"><i class="ti ti-trash"></i></button>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-sm btn-text-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Detail</a></li>
                                    <li><a class="dropdown-item" href="#">Reset Password</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Tidak ada user</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection