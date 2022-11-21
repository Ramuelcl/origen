@php
$layouts['encabezado'] = 'Tablero';
$users = \App\Models\User::all()->count();
$categorias = \App\Models\Backend\Categoria::all()->count();
$marcadores = \App\Models\Backend\Marcador::all()->count();
$total = $users + $categorias + $marcadores;
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
