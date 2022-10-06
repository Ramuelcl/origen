@php
// menu 2 es a partir del dashboard==tablero
$menu2 = [
    [
        'text' => ' Usuarios ',
        //     'href' => route('usuarios.index'), //banca.index
        'active' => setActive('usuarios.*'),
        'enable' => true,
        'image' => 1,
    ],
    [
        'text' => 'Colores',
        'href' => route('color.index'),
        'active' => setActive('color.*'),
        'enable' => true,
        'image' => 1,
    ],
];
$menu3 = [
    [
        'text' => ' Ajustes ',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('config.*'),
        'enable' => true,
        'image' => 1,
    ],
    [
        'text' => ' Iconos ',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('icon.*'),
        'enable' => false,
        'image' => 1,
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
            <li class="mb-2"><img src="public/heroicons/archive.svg">{{ $menu['text'] }}</li>
          @endforeach
        </ul>

        <h6 class="font-bold">Configuración</h6>
        <ul>
          @foreach ($menu3 as $menu)
            <li class="mb-2">{{ $menu['text'] }}</li>
          @endforeach
        </ul>

      </div>
      <div>dos</div>
    </div>
  </div>
</x-layouts.app>
