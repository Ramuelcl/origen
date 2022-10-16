@php
$layouts['encabezado'] = 'Tablero';
$users = \App\Models\User::all()->count();
$colores = \App\Models\Backend\Color::all()->count();
$total = $users + $colores;
@endphp

<x-layouts.app>
  {{-- nav-bar --}}
  <x-slot name="header">
    {{ $layouts['encabezado'] }}
  </x-slot>

  <div class="flex h-screen py-3">
    @livewire('backend.colores.show-posts')
  </div>
</x-layouts.app>
