<div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

  <x-slot name="header">
    {{ __('Colores') }}
  </x-slot>

  <x-table>
    <div class="px-2 py-2">
      {{-- boton Search --}}
      <x-jet-input class="flex-1 mx-2 h-8" type="search" wire:model="query.lazy" placeholder="{{ __('Search...') }}">
        {{-- .lazy devuelve un array, no un string --}}
      </x-jet-input>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500"><input type="checkbox"></th>

          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 whitespace-nowrap">
            Id
          </th>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 whitespace-nowrap">
            Nombre
          </th>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 whitespace-nowrap">
            Hexa
          </th>
          <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 whitespace-nowrap">
            RGB
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($data as $item)
          <tr>
            <td class="px-2 py-1"><input type="checkbox"></td>
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
                #{{ $item->hexa }}
              </div>
            </td>
            <td class="px-2 py-2">
              <div class="text-sm text-gray-900">
                {{ $item->rgb }}
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </x-table>

</div>
