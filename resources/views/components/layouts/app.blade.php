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

  <!-- Styles -->
  @livewireStyles
</head>
@php
$theme = [
    'bg_color' => 'bg-blue-200',
];
@endphp

<body class="font-sans antialiased bg-blue-300">

  <div class="flex flex-col h-screen">
    <div class="{{ $theme['bg_color'] }} sticky top-0">
      {{-- <x-jet-banner /> --}}
      @livewire('navigation-menu')
    </div>
    <div class="{{ $theme['bg_color'] }} flex-grow">
      <!-- Page Heading -->
      @if (isset($header))
        <header>
          <h6 class="bg-blue-200 px-1">
            {{ $header ?? null }}
          </h6>
        </header>
      @endif

      <!-- Page Content -->
      <main>
        {{ $slot ?? null }}
      </main>
    </div>
    <div class="{{ $theme['bg_color'] }} sticky bottom-0">footer</div>
  </div>
  @stack('modals')

  @livewireScripts

</body>

</html>
