@extends('layouts.auth')

@section('title','Masuk - Dashboard')

@section('content')
<div class="tw-w-full tw-max-w-5xl">
  <div class="card tw-rounded-2xl tw-border tw-border-gray-100 tw-shadow-md overflow-hidden">
    <div class="row g-0">
      <!-- Panel ilustrasi/brand -->
      <div class="col-lg-6 d-none d-lg-block tw-bg-gradient-to-br tw-from-indigo-500 tw-to-purple-500">
        <div class="tw-h-full tw-w-full tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-white tw-p-10">
          <div class="tw-flex tw-items-center tw-gap-3 tw-mb-6">
            <div class="tw-w-11 tw-h-11 tw-rounded-xl tw-bg-white/20 tw-flex tw-items-center tw-justify-center tw-font-bold">HC</div>
            <div class="tw-text-2xl tw-font-semibold">HCBD Dashboard</div>
          </div>
          <p class="tw-text-white/90 tw-text-sm tw-text-center">
            Kelola data SDM Anda dengan antarmuka yang bersih dan responsif.
          </p>
        </div>
      </div>

      <!-- Panel form -->
      <div class="col-12 col-lg-6">
        <div class="tw-p-6 tw-px-7 tw-py-8 tw-h-full tw-flex tw-flex-col tw-justify-center">
          <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-800 tw-mb-1">Masuk</h1>
          <p class="tw-text-gray-500 tw-mb-4">Silakan login untuk melanjutkan</p>

          @if ($errors->any())
            <div class="alert alert-danger tw-text-sm tw-py-2 tw-px-3">
              {{ $errors->first() }}
            </div>
          @endif

          @if (session('status'))
            <div class="alert alert-success tw-text-sm tw-py-2 tw-px-3">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('login.perform') }}" class="tw-space-y-4">
            @csrf

            <div>
              <label class="tw-text-sm tw-text-gray-700 tw-font-medium">Email</label>
              <div class="tw-mt-1 tw-relative">
                <span class="tw-absolute tw-inset-y-0 tw-left-0 tw-pl-3 tw-flex tw-items-center tw-text-gray-400">
                  <i class="ti ti-mail"></i>
                </span>
                <input
                  type="email"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  autocomplete="username"
                  class="tw-w-full tw-rounded-lg tw-border tw-border-gray-200 tw-bg-white tw-pl-10 tw-pr-3 tw-py-2 tw-text-sm focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-border-indigo-500"
                  placeholder="you@example.com">
              </div>
            </div>

            <div>
              <div class="tw-flex tw-items-center tw-justify-between">
                <label class="tw-text-sm tw-text-gray-700 tw-font-medium">Password</label>
                <a href="{{ route('password.request', false) ?: 'javascript:void(0)' }}" class="tw-text-xs tw-text-indigo-600 hover:tw-text-indigo-700">Lupa password?</a>
              </div>
              <div class="tw-mt-1 tw-relative">
                <span class="tw-absolute tw-inset-y-0 tw-left-0 tw-pl-3 tw-flex tw-items-center tw-text-gray-400">
                  <i class="ti ti-lock"></i>
                </span>
                <input
                  type="password"
                  name="password"
                  required
                  autocomplete="current-password"
                  class="tw-w-full tw-rounded-lg tw-border tw-border-gray-200 tw-bg-white tw-pl-10 tw-pr-10 tw-py-2 tw-text-sm focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-border-indigo-500"
                  placeholder="••••••••">
                <button type="button" class="tw-absolute tw-inset-y-0 tw-right-0 tw-pr-3 tw-text-gray-400 hover:tw-text-gray-600" onclick="this.previousElementSibling.type = this.previousElementSibling.type==='password' ? 'text' : 'password'">
                  <i class="ti ti-eye"></i>
                </button>
              </div>
            </div>

            <div class="tw-flex tw-items-center tw-justify-between">
              <label class="tw-inline-flex tw-items-center tw-gap-2 tw-text-sm tw-text-gray-700">
                <input type="checkbox" name="remember" class="form-check-input">
                Ingat saya
              </label>
            </div>

            <button type="submit" class="btn btn-primary tw-w-full tw-py-2">
              Masuk
            </button>
          </form>

          <p class="tw-text-xs tw-text-gray-400 tw-mt-6 tw-text-center">© {{ date('Y') }} HCBD</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection