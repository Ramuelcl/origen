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
$users = \App\Models\User::all()->count();
$colores = \App\Models\Backend\Color::all()->count();
$total = $users + $colores;
@endphp

<x-layouts.app>
  {{-- nav-bar --}}
  <x-slot name="header">{{ $layouts['encabezado'] }}</x-slot>
  <div class="flex h-screen">
    {{-- tablero: views\layouts\partials\sidebar.blade.php --}}
    @include('layouts.partials.sidebar')

    <div class="p-6 w-full">

      <div class="mx-auto grid grid-cols-1 sm:px-6 lg:px-8 sm:grid-cols-4 gap-6 mb-2">
        <x-tarjeta>
          <x-slot name="heading">
            <p class="text-base flex-1">Usuarios</p>
            <p class="text-green-500 bg-green-100 rounded-full font-mono px-2">
              {{ number_format(($users / $total) * 100, 2, ',', '.') . '%' }}</p>
          </x-slot>

          <div class="text-3xl font-bold my-2 text-center">{{ $users }}
          </div>

          <x-slot name="footer">
            <hr>
            <x-jet-nav-link>Ver Más</x-jet-nav-link>
          </x-slot>
        </x-tarjeta>

        <x-tarjeta>
          <x-slot name="heading">
            <p class="text-base mr-2 flex-1">Colores</p>
            <p class="text-green-500 bg-green-100 rounded-full font-mono py-0.5 px-2">
              {{ number_format(($colores / $total) * 100, 2, ',', '.') . '%' }}</p>
            </p>
          </x-slot>

          <div class="text-3xl font-bold my-2 text-center">{{ $colores }}
          </div>

          <x-slot name="footer">
            <hr>
            <button
              class="outline-none mr-1 mb-1 px-3 py-1 bg-transprent text-xs font-bold text-blue-500 uppercase focus:outline-none">
            </button>
            <x-jet-nav-link>Ver Más</x-jet-nav-link>
          </x-slot>
        </x-tarjeta>
      </div>
      <div class="grid grid-cols-12 sm:grid-cols-3 gap-3 mb-2 w-full">
        @livewire('color.muestra-colores', ['titulo' => 'titulo de prueba'])
      </div>
      {{-- <div class="grid grid-cols-12 sm:grid-cols-3 gap-6 mb-2">
          <div class="bg-white p-6 rounded-lg shadow-sm">
            @php
              $colores = [
                  ['color' => 'pink', ['FFF5F7', 'FED7E2', 'FBB6CE', 'F687B3', 'ED64A6', 'D53F8C', 'B83280', '97266D', '702459']],
                  ['color' => 'purple', ['FAF5FF', 'E9D8FD', 'D6BCFA', 'B794F4', '9F7AEA', '805AD5', '6B46C1', '553C9A', '44337A']],
                  ['color' => 'indigo', ['EBF4FF', 'C3DAFE', 'A3BFFA', '7F9CF5', '667EEA', '5A67D8', '4C51BF', '434190', '3C366B']],
                  ['color' => 'blue', ['EBF8FF', 'BEE3F8', '90CDF4', '63B3ED', '4299E1', '3182CE', '2B6CB0', '2C5282', '2A4365']],
                  ['color' => 'teal', ['E6FFFA', 'B2F5EA', '81E6D9', '4FD1C5', '38B2AC', '319795', '2C7A7B', '285E61', '234E52']],
                  ['color' => 'green', ['F0FFF4', 'C6F6D5', '9AE6B4', '68D391', '48BB78', '38A169', '2F855A', '276749', '22543D']],
                  ['color' => 'yellow', ['FFFFF0', 'FEFCBF', 'FAF089', 'F6E05E', 'ECC94B', 'D69E2E', 'B7791F', '975A16', '744210']],
                  ['color' => 'orange', ['FFFAF0', 'FEEBC8', 'FBD38D', 'F6AD55', 'ED8936', 'DD6B20', 'C05621', '9C4221', '7B341E']],
                  ['color' => 'red', ['FFF5F5', 'FED7D7', 'FEB2B2', 'FC8181', 'F56565', 'E53E3E', 'C53030', '9B2C2C', '742A2A']],
                  ['color' => 'gray', ['F7FAFC', 'EDF2F7', 'E2E8F0', 'CBD5E0', 'A0AEC0', '718096', '4A5568', '2D3748', '1A202C']],
              ];
              //   print_r($colores);
            @endphp
            @foreach ($colores as $color)
              <x-tarjeta>
                @for ($i = 1; $i <= 9; $i++)
                  @php
                    $j = $i + 1;
                  @endphp

        <div class="flex flex-col items-center justify-center text-center p-1">
          <x-slot name="heading">
            <div class="py-1">{{ $color['color'] }}-{{ $i * 100 }}</div>
          </x-slot>
          <div class="w-16 h-16 rounded bg-{{ $color['color'] }}-{{ $i * 100 }}">
          </div>
          <x-slot name="footer">
            <div class="py-1">#{{ $color[0][$i - 1] }}</div>
          </x-slot>
          @endfor
          </x-tarjeta>
          @endforeach
        </div>
      </div> --}}
    </div>
  </div>


  {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<div class="container mx-auto my-2 flex flex-row justify-center text-gray-600 border-b">
  <div class="flex flex-col items-center justify-center text-center p-1">
    <div class="py-1">gray-100</div>
    <div class="w-24 h-24 rounded shadow-inner bg-gray-100"></div>
    <div class="py-1">#F7FAFC</div>
  </div> --}}

</x-layouts.app>
