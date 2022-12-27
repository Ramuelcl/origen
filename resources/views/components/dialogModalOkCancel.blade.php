<!-- Delete User Confirmation Modal -->
<x-jet-dialog-modal wire:model="confirmingUserDeletion">
    <x-slot name="title">
        {{ __('Delete') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete your data? .') }}

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-jet-danger-button>
    </x-slot>
    </x-dialog-modal>
