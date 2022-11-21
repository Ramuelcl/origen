<x-card class="max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8">
  <x-slot name="cardheader" class="flex items-center">
    {{-- boton Search --}}
    <x-input class="flex-1 mx-2 h-8" type="text" wire:model="query.lazy" placeholder="{{ __('search') }}">
      {{-- .lazy devuelve un array, no un string --}}
    </x-input>
    {{-- boton formulario crear --}}
    @livewire('colores-crear')
  </x-slot>
  <x-table>
    <tr>
      <th><input type="checkbox"></th>
      @foreach ($fields as $key => $field)
      @if ($field['table']['display'])
      {{-- @php
            dd(['fields' => $fields, 'key' => $key, 'field' => $field]);
          @endphp --}}
      <th class="py-1 px-2 text-left cursor-pointer" wire:click="order('{{ $field['name'] }}')">
        {{ $field['table']['titre'] }}
        @if ($sort == $field['name'])
        @if ($direction == 'asc')
        <i class="fa-solid fa-sort-up"></i>
        @else
        <i class="fa-solid fa-sort-down"></i>
        @endif
        @else
        <i class="fa-solid fa-sort"></i>
        @endif
      </th>
      @endif
      @endforeach
      <th colspan="2">{{ __('actions') }}</th>
    </tr>
    <tbody class="text-gray-700">
      @forelse($datas as $item)
      <tr>
        <td class="px-2 py-1"><input type="checkbox"></td>
        <!-- // relleno de ceros -->
        <td class="rounded border px-4 py-2">{{ sprintf("%03d",  $item->id) }}</td>
        <!-- // formato con decimales -->
        <!-- <td class="rounded border px-4 py-2">{{ number_format( $item->id,0, ',','.') }}</td> -->
        <td class="rounded border px-4 py-2">{{ $item->nombre }}</td>
        <td class="rounded border px-4 py-2">{{ $item->hexa }}</td>

        <td width="10px">
          {{-- la ruta debe ser un arreglo de rutas --}}
          {{-- <a href="{{ route('backend.colores.edit', $item) }}"
          class="rounded-md text-white focus:ring-green-800 px-2 py-1 text-sm bg-green-500 shadow-md w-full hover:bg-green-300">{{ __('edit') }}</a> --}}
          @livewire('colores-editar', ['data' => $item], key($item->id))
        </td>
        <td width="10px">
          <form action="{{ route('backend.colores.destroy', $item) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="rounded-md text-white focus:ring-red-600 px-2 py-1 text-sm bg-red-500 shadow-md w-full hover:bg-red-300">{{ __('delete') }}</button>
          </form>
        </td>

      </tr>
      @empty
      {{ __('no regs') }}
      @endforelse
    </tbody>
