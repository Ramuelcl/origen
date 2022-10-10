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
        'href' => route('colores'),
        'active' => setActive('color.*'),
        'enable' => true,
        'image' => 'star.svg',
    ],
    [
        'text' => 'Etiquetas',
        // 'href' => route('etiqueta.index'),
        'active' => setActive('etiqueta.*'),
        'enable' => true,
        'image' => 'archive.svg',
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

@endphp

<div class="px-3 w-1/4 border-r border-2 border-gray-200 hidden md:block">

  <h6 class="font-bold">Tablas</h6>
  <ul>
    @foreach ($menu2 as $menu)
      <li class="flex mb-2">
        <div class="shadow-sm p-2 rounded-lg"><img src="{{ asset('heroicons/solid/' . $menu['image']) }}"></div>
        <x-jet-nav-link class="self-center" href="">{{ $menu['text'] }}</x-jet-nav-link>
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
