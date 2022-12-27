<div class="px-2 sm:px-20 bg-white border-b border-gray-200">
    @include('livewire.backend.marcadores.mensaje')
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div class="ml-2 mt-2">{{__($display['title'])}}
        </div>
        <div class="mr-2 mt-2">
            <button wire:click="confirmMarcadorAdd" class="btn btn-blue text-lg">
                {{__($display['new'])}}
            </button>
        </div>
    </div>
    <!-- {{$q}} -->
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
                    @if($field['name']!=='activo' || ($field['name']=='activo' and $chkActivo==false) )
                    <th wire:click="fncOrden('{{ $field['name'] }}')" class="cursor-pointer" scope="col">
                        <div class="flex items-center">
                            {{ __($field['table']['titre']) }}
                            <x-sort-icon campo="{{ $field['name'] }}" :sortDir="$sortDir" :sortField="$sortField" />

                        </div>
                    </th>
                    @endif
                    @endif
                    @endforeach
                    <th class="w-1/4" colspan="2" scope="colgroup">{{ __('actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @if($datos)
                @foreach($datos as $item)
                <tr>
                    <!-- // relleno de ceros -->
                    <td>{{ sprintf("%03d",  $item->id) }}</td>
                    <!-- // formato con decimales -->
                    <!-- <td>{{ number_format( $item->id,0, ',','.') }}</td> -->
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->hexa }}</td>
                    @if(!$chkActivo )
                    <td>{{ $item->activo?'activo':'inactivo' }}</td>
                    @endif
                    <td>
                        {{-- la ruta debe ser un arreglo de rutas --}}
                        <a href=" #" class="btn btn-green">{{ __('edit') }}</a>
                    </td>
                    <td>
                        <button wire:click="confirmMarcadorDelete({{$item->id}})" wire:loading.attr="disabled" class="btn btn-red">{{ __('delete') }}</button>
                    </td>
                </tr>
                @endforeach
                @else{
                {{ __('no regs') }}
                @endif
            </tbody>
        </table>
    </div>
    <div class=" mt-4">
        {{ $datos->links()}}
    </div>

    <!-- Delete Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmMarcadorDelete">
        <x-slot name="title">
            {{ __('Delete Marcador') }}
            <hr>
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your data?.') }}

        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('confirmMarcadorDelete', false)" wire:loading.attr="disabled" class="btn btn-gray">
                {{ __('Cancel') }}
            </button>

            <button wire:click="delete({{ $confirmMarcadorDelete }})" wire:loading.attr="disabled" class="ml-3 btn btn-red">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Add record Modal -->
    <x-jet-dialog-modal wire:model="confirmMarcadorAdd">
        <x-slot name="title">
            {{ __('Add Marcador') }}
            <hr>
        </x-slot>

        <x-slot name="content">
            @foreach ($fields as $campo)
            @if($campo['input']['display'])
            <div class="col-span-6 sm:col-span-4 mb-4">
                @if($campo['name']=='activo')
                <label class="flex items-center w-3">
                    @endif
                    <x-jet-label for="marcador.{{$campo['name']}}" value="{{__($campo['input']['label'])}}" class="mr-2" />
                    <x-jet-input id="marcador.{{$campo['name']}}" type="{{$campo['input']['type']}}" class="mt-1 block w-full" wire:model.defer="marcador.{{$campo['name']}}" />
                    <x-jet-input-error for="marcador.{{$campo['name']}}" class="mt-2" />
                    @if($campo['name']=='activo')
                    <!-- <span class="ml-2 text-sm">Activo</span> -->
                </label>
                @endif
            </div>
            @endif
            @endforeach

        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('confirmMarcadorAdd', false)" wire:loading.attr="disabled" class="btn btn-gray">
                {{ __('Cancel') }}
            </button>

            <button wire:click="save()" wire:loading.attr="disabled" class="ml-3 btn btn-green">
                {{ __('Save') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
