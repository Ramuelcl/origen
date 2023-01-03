<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-2 lg:-mx-2">
        <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-2">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="bg-white px-4 py-3 items-center justify-between border-b border-gray-200 sm:px-2">
                    <div class="flex text-gray-500 ">
                        <x-jet-input wire:model="Search" type="search" class="form-input w-full mx-6" placeholder="{{ __('Search') }}" />
                        <div class="flex-col my-1">
                            <x-jet-checkbox wire:model="onlyActive" class="mr-2">Activos?</x-jet-checkbox>
                            <x-jet-button wire:click="clear" class="btn btn-green h-6 text-xs justify-between"><i class="fa-solid fa-eraser ">{{__(' Clear')}}</i></x-jet-button>
                        </div>
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th wire:click="fncOrden('id')" scope="col" class="px-6 py-3 cursor-pointer bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">Id
                                <x-sort-icon campo="id" :sortDir="$sortDir" :sortField="$sortField" />
                            </th>
                            <th wire:click="fncOrden('name')" scope="col" class="px-6 py-3 cursor-pointer bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">Name
                                <x-sort-icon campo="name" :sortDir="$sortDir" :sortField="$sortField" />
                            </th>
                            <th wire:click="fncOrden('email')" scope="col" class="px-6 py-3 cursor-pointer bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">eMail
                                <x-sort-icon campo="email" :sortDir="$sortDir" :sortField="$sortField" />
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500">Roles</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500">Avatar</th>
                            @if (!$onlyActive)
                            <th wire:click=" fncOrden('is_active')" scope="col" class="px-6 py-3 cursor-pointer bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">Active
                                <x-sort-icon campo="is_active" :sortDir="$sortDir" :sortField="$sortField" />
                            </th>
                            @endif
                            <th scope="col" class="px-6 py-3 bg-gray-50">Options
                                @hasanyrole('super-admin|admin')
                                <x-jet-button wire:click="fncAdd()" class="btn btn-blue h-6 text-xs justify-between">
                                    <i class="fa-solid fa-plus ">{{__(' Add')}}</i>
                                </x-jet-button>
                                @endhasanyrole
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $key=>$user)
                        @php
                        $cl = $key%2 == 0 ?'100':'50';
                        @endphp
                        <tr class="bg-gray-{{$cl}}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <!-- <div class="flex-shrink-0 h-10 w-10">
                                        <img src="#" alt="" class="h-10 w-10 rounded-full">
                                    </div> -->
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$user->id}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class=" px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{$user->name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{$user->email}}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="text-xs">
                                    @foreach ($user->roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->profile_photo_path)
                                <img class="w-8 h-8 rounded-full" src="{{ Storage::url($user->profile_photo_path)}}">
                                </img>
                                @endif
                            </td>
                            @if (!$onlyActive)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold">{{$user->is_active ?'Active':'Inactive'}}</span>
                            </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-jet-button wire:click="fncEdit({{ $user->id }})" class="btn btn-green px-2 inline-flex text-sm leading-5 font-semibold">{{ __('Edit')}}</x-jet-button>
                                <x-jet-button wire:click="fncDelete({{ $user->id }})" class="btn btn-red px-2 inline-flex text-sm leading-5 font-semibold">{{ __('Delete')}}</x-jet-button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="bg-white px-4 py-1 flex items-center justify-between border-t border-gray-200 sm:px-2">
                    <select wire:model="strRegs" class="text-xs">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- Add record Modal -->
    <x-jet-dialog-modal wire:model="ModalAddEdit">
        <x-slot name="title">
            {{ __($title) }}
            <hr>
        </x-slot>

        <x-slot name="content">
            @include('livewire.backend.users.tabs')
        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('ModalAddEdit', false)" wire:loading.attr="disabled" class="btn btn-gray">
                {{ __('Cancel') }}
            </button>

            <button wire:click="save()" wire:loading.attr="disabled" class="ml-3 btn btn-green">
                {{ __('Save') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Confirmation Modal -->
    <x-jet-dialog-modal wire:model="ModalDelete">
        <x-slot name="title">
            {{ __($title) }} x
            <hr>
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your data?.') }}

        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('ModalDelete', false)" wire:loading.attr="disabled" class="btn btn-gray">
                {{ __('Cancel') }}
            </button>

            <button wire:click="fncDeleting()" wire:loading.attr="disabled" class="ml-3 btn btn-red">
                {{ __('Delete') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
