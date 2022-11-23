<div class="px-2 sm:px-20 bg-white border-b border-gray-200">
    @include('livewire.backend.marcadores.mensaje')
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div class="ml-2 mt-2">{{__($display['title'])}}
        </div>
        <div class="mr-2 mt-2">
            <button wire:click="fncNuevo" class="btn btn-blue text-lg">
                Nuevo
            </button>
        </div>
    </div>
    <div class="mt-2">
        <div class="flex justify-between">
            <div>
                <input wire:model.debounce.500ms="query" type="search" placeholder="Buscar" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" name="" wire:model="chkActivo">¿Activos?
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    @foreach ($fields as $key => $field)
                    @if ($field['table']['display'])

                    <th scope="col" wire:click="fncOrden({{ $field['name'] }})">
                        <div class="flex items-center">
                            {{ __($field['table']['titre']) }}
                            <x-sort-icon campo="{{ $field['name'] }}" :sortDir="$direccion" :sortCampo="$campo" />

                        </div>
                    </th>
                    @endif
                    @endforeach
                    <th class="w-1/4" colspan="2" scope="colgroup">{{ __('actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @if($datas)
                @foreach($datas as $item)
                <tr>
                    <!-- // relleno de ceros -->
                    <td>{{ sprintf("%03d",  $item->id) }}</td>
                    <!-- // formato con decimales -->
                    <!-- <td>{{ number_format( $item->id,0, ',','.') }}</td> -->
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->hexa }}</td>
                    <td>{{ $item->activo?'activo':'inactivo' }}</td>

                    <td>
                        {{-- la ruta debe ser un arreglo de rutas --}}
                        <a href=" #" class="btn btn-green">{{ __('edit') }}</a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-red">{{ __('delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else{
                {{ __('no regs') }}
                @endif
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $datas->links()}}
    </div>
</div>
