@php
// menu 2 es a partir del dashboard==tablero
$menu2 = [
    [
        'text' => ' Usuarios ',
        //     'href' => route('usuarios.index'), //banca.index
        'active' => setActive('usuarios.*'),
        'enable' => true,
        'image' => 'users.svg',
    ],
    [
        'text' => 'Colores',
        'href' => route('color.index'),
        'active' => setActive('color.*'),
        'enable' => true,
        'image' => 'star.svg',
    ],
];
$menu3 = [
    [
        'text' => ' Ajustes ',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('config.*'),
        'enable' => true,
        'image' => 'server.svg',
    ],
    [
        'text' => ' Iconos ',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('icon.*'),
        'enable' => false,
        'image' => 'shopping-bag.svg',
    ],
];
$layouts['encabezado'] = 'Tablero';
@endphp

<x-layouts.app>
  {{-- nav-bar --}}
  <div class="bg-gray-100 shadow-xl">
    <x-slot name="header">{{ $layouts['encabezado'] }}</x-slot>
    <div class="flex  h-screen">
      {{-- tablero: views\layouts\partials\sidebar.blade.php --}}
      @include('layouts.partials.sidebar')

      <div class="p-6 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-6</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-6</p>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-4</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-4</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-4</p>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-3</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-3</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-3</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-3</p>
          </div>
        </div>
      </div>
    </div>
</x-layouts.app>
