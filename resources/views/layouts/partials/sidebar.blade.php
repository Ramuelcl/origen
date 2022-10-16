@php
// menu 2 es a partir del dashboard==tablero
$menu2 = [
    [
        'text' => 'Usuarios',
        //     'href' => route('usuarios.index'), //banca.index
        'active' => setActive('usuarios.*'),
        'enable' => true,
        'tab' => 'usuarios',
        'image' => 'users.svg',
    ],
    [
        'text' => 'Colores',
        // 'href' => route('colores'),
        'active' => setActive('color.*'),
        'enable' => true,
        'tab' => 'colores',
        'image' => 'star.svg',
    ],
    [
        'text' => 'Etiquetas',
        // 'href' => route('etiqueta.index'),
        'active' => setActive('etiqueta.*'),
        'enable' => true,
        'tab' => 'etiquetas',
        'image' => 'archive.svg',
    ],
];
$menu3 = [
    [
        'text' => 'Ajustes',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('config.*'),
        'enable' => true,
        'tab' => 'ajustes',
        'image' => 'server.svg',
    ],
    [
        'text' => 'Iconos',
        // 'href' => route('config.index'), //banca.index
        'active' => setActive('icon.*'),
        'enable' => false,
        'tab' => 'iconos',
        'image' => 'shopping-bag.svg',
    ],
];

@endphp
{{-- <div class="flex items-start">
  <ul class="nav nav-tabs flex flex-col flex-wrap list-none border-b-0 pl-0 mr-4" id="tabs-tabVertical" role="tablist">
    <li class="nav-item flex-grow text-center" role="presentation">
      <a href="#tabs-homeVertical"
        class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
          active
        "
        id="tabs-home-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-homeVertical" role="tab"
        aria-controls="tabs-homeVertical" aria-selected="true">Home</a>
    </li>
    <li class="nav-item flex-grow text-center" role="presentation">
      <a href="#tabs-profileVertical"
        class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
        "
        id="tabs-profile-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-profileVertical" role="tab"
        aria-controls="tabs-profileVertical" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item flex-grow text-center" role="presentation">
      <a href="#tabs-messagesVertical"
        class="
          nav-link
          block
          font-medium
          text-xs
          leading-tight
          uppercase
          border-x-0 border-t-0 border-b-2 border-transparent
          px-6
          py-3
          my-2
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
        "
        id="tabs-messages-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-messagesVertical" role="tab"
        aria-controls="tabs-messagesVertical" aria-selected="false">Messages</a>
    </li>
  </ul>
  <div class="tab-content" id="tabs-tabContentVertical">
    <div class="tab-pane fade show active" id="tabs-homeVertical" role="tabpanel"
      aria-labelledby="tabs-home-tabVertical">
      Tab 1 content vertical
    </div>
    <div class="tab-pane fade" id="tabs-profileVertical" role="tabpanel" aria-labelledby="tabs-profile-tabVertical">
      Tab 2 content vertical
    </div>
    <div class="tab-pane fade" id="tabs-messagesVertical" role="tabpanel" aria-labelledby="tabs-profile-tabVertical">
      Tab 3 content vertical
    </div>
  </div>
</div>
 --}}
<div class="px-3 w-1/4 border-r border-2 border-gray-200 hidden md:block">

  <h6 class="font-bold">Tablas</h6>
  <ul role="tablist">
    @foreach ($menu2 as $menu)
      <li class="flex mb-2">
        <div class="shadow-sm p-2 rounded-lg"><img src="{{ asset('heroicons/solid/' . $menu['image']) }}"></div>
        <x-jet-nav-link class="self-center" href="#{{ $menu['tab'] }}">{{ $menu['text'] }}</x-jet-nav-link>
      </li>
    @endforeach
  </ul>

  <h6 class="font-bold">Configuración</h6>
  <ul>
    @foreach ($menu3 as $menu)
      <li class="flex mb-2">
        <div class="shadow-sm p-2 rounded-lg"><img src="{{ asset('heroicons/solid/' . $menu['image']) }}"></div>
        <span class="self-center" href="#{{ $menu['tab'] }}">{{ $menu['text'] }}</span>
      </li>
    @endforeach
  </ul>

</div>
