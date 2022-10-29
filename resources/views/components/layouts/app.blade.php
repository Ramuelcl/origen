<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="meta-description">

  <title>{{ config('app.name', 'GuzaNet') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Styles -->
  @livewireStyles
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.0.0-web/css/all.min.css') }}">
  <style>
    .dotted:before {
      background: url("{{ asset('grilla50px.png') }}") repeat left top rgba(0, 0, 0, 0.5);
      content: "";
      display: block;
      width: 100%;
      height: 100%;
      opacity: 0.5;
      position: absolute;
      top: 0;
      bottom: 0;
    }
  </style>
</head>
@php
  $theme = [
      'bg_color' => 'bg-blue-100',
      // 'bg_color' => 'bg-blue-200',
  ];
@endphp

{{-- <body class="font-sans antialiased dotted"> muestra una malla superpuesta --}}

<body class="font-sans antialiased">
  <x-contenedor>
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
      @livewire('navigation-menu')

      {{-- @include('layouts.partials.DarkNav') --}}
      <!-- Page Heading -->
      @if (isset($header))
        <header class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
          </div>
        </header>
      @endif

      <!-- Page Content -->
      <main>
        {{ $slot }}
      </main>
    </div>
  </x-contenedor>

  @stack('modals')

  @livewireScripts
  <script>
    Livewire.on('alert', function($title = 'Title', $msg = 'Ok', $type = 'Success') {
      Swal.fire(
        $title, $msg, $type)
    })
  </script>
</body>

</html>
