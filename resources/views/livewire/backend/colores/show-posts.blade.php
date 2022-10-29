<div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  {{-- <x-alerta tipo="info">
    <x-slot name="titulo">titulo de prueba</x-slot>
    <h6>texto de prueba</h6>
  </x-alerta> --}}
  <x-slot name="header">
    {{ __('Colores') }}
  </x-slot>

  <x-table>
    <div class="px-2 py-2 flex items-center">
      {{-- boton Search --}}
      <x-jet-input class="flex-1 mx-2 h-8" type="search" wire:model="query.lazy" placeholder="{{ __('Search...') }}">
        {{-- .lazy devuelve un array, no un string --}}
      </x-jet-input>
      @livewire('backend.colores.create-posts')

    </div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500"><input name="checaTodo"
              type="checkbox" wire:Click="fncChecaTodo()">
          </th>

          <th scope="col"
            class="px-2 py-2 text-left text-xs font-medium
            text-gray-500 capitalize whitespace-nowrap cursor-pointer"
            wire:click="fncOrden('id')">
            id
            @if ($orden == 'id')
              @if ($direccion == 'asc')
                <i class="fa-solid fa-sort-up"></i>
              @else
                <i class="fa-solid fa-sort-down"></i>
              @endif
            @else
              <i class="fa-solid fa-sort"></i>
            @endif
          </th>
          <th scope="col"
            class="px-2 py-2 text-left text-xs font-medium
            text-gray-500 capitalize whitespace-nowrap cursor-pointer"
            wire:click="fncOrden('nombre')">
            nombre
            @if ($orden == 'nombre')
              @if ($direccion == 'asc')
                <i class="fa-solid fa-sort-up"></i>
              @else
                <i class="fa-solid fa-sort-down"></i>
              @endif
            @else
              <i class="fa-solid fa-sort"></i>
            @endif

          </th>
          <th scope="col"
            class="px-2 py-2 text-left text-xs font-medium
            text-gray-500 capitalize whitespace-nowrap cursor-pointer"
            wire:click="fncOrden('hexa')">
            hexa
            @if ($orden == 'hexa')
              @if ($direccion == 'asc')
                <i class="fa-solid fa-sort-up"></i>
              @else
                <i class="fa-solid fa-sort-down"></i>
              @endif
            @else
              <i class="fa-solid fa-sort"></i>
            @endif
          </th>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 capitalize whitespace-nowrap">
            rgb
          </th>
          <th colspan="2">{{ __('actions') }}</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($data as $item)
          <tr class="border-b border-gray-300 even:bg-gray-100 odd:bg-gray-200">
            <td class="px-2 py-1"><input name="checaUno[{{ $item->id }}]" type="checkbox"></td>
            <td class="px-2 py-2">
              <div class="text-sm text-gray-900">
                {{ $item->id }}
              </div>
            </td>
            <td class="px-2 py-2">
              <div class="text-sm text-gray-900">
                {{ $item->nombre }}
              </div>
            </td>
            <td class="px-2 py-2">
              <div class="text-sm text-gray-900">
                {{ $item->hexa }}
              </div>
            </td>
            <td class="px-2 py-2">
              <div class="text-sm text-gray-900">
                {{ $item->rgb }}
              </div>
            </td>
            <td>
              {{-- la ruta debe ser un arreglo de rutas --}}
              {{-- <a href="{{ route('backend.colores.edit', $item) }}"
              class="rounded-md text-white focus:ring-green-800 px-2 py-1 text-sm bg-green-500 shadow-md w-full hover:bg-green-300">{{ __('edit') }}</a> --}}
              {{-- @livewire('colores-editar', ['data' => $item], key($item->id)) --}}
              @livewire('backend.colores.edit-posts', ['post' => $item], key($item->id))
            </td>
            <td>
              <form action="" method="post">
                {{-- {{ route('backend.showPost.destroy', $item) }} --}}
                @csrf
                @method('delete')
                <x-jet-button tipo='delete' type="submit">
                  {{ __('delete') }}</x-jet-button>
              </form>
            </td>
          </tr>
        @empty
          <div class="px-3 py-4">{{ __('No Existen registros coincidentes') }}</div>
        @endforelse
      </tbody>
    </table>


  </x-table>

</div>
