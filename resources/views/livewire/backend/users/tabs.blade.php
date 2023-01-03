<div x-data="{ tab: window.location.hash ? window.location.hash : '#tab1' }">
    <div class="flex flex-row justify-between">

        <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#" x-on:click.prevent="tab='#tab1'">{{__("User")}}</a>

        <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#" x-on:click.prevent="tab='#tab2'">{{__("Roles")}}</a>

        <a class="px-4 border-b-2 border-gray-900 hover:border-teal-300" href="#" x-on:click.prevent="tab='#tab3'">{{__("Permissions")}}</a>

    </div>
    <div id="usuarios" x-show="tab == '#tab1'" x-cloak>
        <div class="col-span-6 sm:col-span-4 mb-4">
            {{ __('Name')}}
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
            <x-jet-input-error for="name" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-4">
            {{ __('eMail')}}
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email" />
            <x-jet-input-error for="email" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-4">
            {{ __('Active')}}
            <x-jet-input id="is_active" type="checkbox" class="mr-4 w-6" wire:model.defer="is_active" />
            <x-jet-input-error for="is_active" />
        </div>

        <div class="col-span-6 sm:col-span-4 mb-4">
            {{ __('Avatar')}}
            <div class="flex">
                <x-jet-input id="profile_photo_path" type="file" class="block w-full mr-4" wire:model="profile_photo_path" />
                @if ($mode))
                <img src="{{ $profile_photo_path->temporaryUrl() }}" class="w10 h-10" />
                @elseif (!$mode)
                <img src="{{ Storage::url( $profile_photo_path) }}" class="w10 h-10" />
                @endif
            </div>
            <x-jet-input-error for="profile_photo_path" />
        </div>

        @if ($mode === true)
        <div class="flex flex-row">
            <div class="col-span-6 sm:col-span-4 mb-4">
                {{ __('Password')}}
                <x-jet-input id=" password" type="password" class="mt-1" wire:model.defer="password" />
                <x-jet-input-error for="password" />
            </div>

            <div class="col-span-6 sm:col-span-4 mb-4">
                {{ __('Password confirmation')}}
                <x-jet-input id="password_confirm" type="password" class="mt-1" wire:model.defer="password_confirm" />
                <x-jet-input-error for="password_confirm" />
            </div>
        </div>
        @endif

    </div>
    <div id="roles" x-show="tab == '#tab2'" x-cloak>
        <x-jet-checkbox wire:model="allRoles" class="mr-2">{{ __('All')}}</x-jet-checkbox>
        <x-jet-button wire:model="addRoles" class="mr-2">{{ __('Add')}}</x-jet-button>

        @foreach($roles as $role)
        <div class="flex-row">
            <x-jet-checkbox wire:model="roles[]">{{ $role['name'] }}</x-jet-checkbox>
        </div>
        @endforeach
    </div>
    <div id="permisos" x-show="tab == '#tab3'" x-cloak>
        <x-jet-checkbox wire:model="allPermissions" class="mr-2">{{ __('All')}}</x-jet-checkbox>
        <x-jet-button wire:model="addermissions" class="mr-2">{{ __('Add')}}</x-jet-button>
        @foreach($permissions as $permission)
        <h3>{{ $permission->id }}</h3>
        <p>{!! $permission->name !!}</p>
        @endforeach
    </div>
</div>
