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
    <t6 class="bg-blue-200 px-1">{{ $layouts['encabezado'] }}</t6>
    <div class="flex  h-screen bg-gray-100">
      <div class="px-3 w-1/4 border-r border-2 border-gray-200">

        <h6 class="font-bold">Tablas</h6>
        <ul>
          @foreach ($menu2 as $menu)
            <li class="flex mb-2">
              <div class="shadow-sm p-2 rounded-lg"><img src="{{ asset('heroicons/solid/' . $menu['image']) }}"></div>
              <span class="self-center">{{ $menu['text'] }}</span>
            </li>
          @endforeach
        </ul>

        <h6 class="font-bold">Configuración</h6>
        <ul>
          @foreach ($menu3 as $menu)
            <li class="flex mb-2">
              <div class="shadow-sm p-2 rounded-lg"><img src="{{ asset('heroicons/solid/' . $menu['image']) }}"></div>
              <span class="self-center">{{ $menu['text'] }}</span>
            </li>
          @endforeach
        </ul>

      </div>
      <div class="p-6 w-full">
        <h3 class="text-4xl font-bold mb-5">{{ $menu['text'] }}</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-6</p>
          </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            <p>col-6</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
