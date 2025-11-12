<!DOCTYPE html>
<html lang="id" class="light-style" data-theme="theme-default">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Masuk - Dashboard')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="tw-min-h-screen tw-bg-gradient-to-br tw-from-indigo-50 tw-to-white dark:tw-from-slate-900 dark:tw-to-slate-800">
  <main class="tw-min-h-screen tw-flex tw-items-center tw-justify-center tw-px-4">
    @yield('content')
  </main>
  @stack('scripts')
</body>
</html>