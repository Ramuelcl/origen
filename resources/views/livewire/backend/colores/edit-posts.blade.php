<div>
  <a class="btn btn-green" wire:click="fncOpen()">
    <i class="fas fa-edit"></i>
    <p>{{ __('edit') }}</p>
  </a>
  <x-jet-dialog-modal wire:model="open">
    <x-slot name="title">{{ __('editing: ') }}{{ $color }}</x-slot>

    <div>
      <x-slot name="content">


      </x-slot>

      <x-slot name="footer">
        <x-jet-button tipo="cancel" wire:click="fncOpen()">{{ __('cancel') }}
        </x-jet-button>

        <x-jet-button tipo="save" wire:click="fncSave()" wire:loading.attr="disabled" wire:target="fncSave, imagen"
          class="disabled:opacity-25">
          {{ __('save') }}
        </x-jet-button>
      </x-slot>

  </x-jet-dialog-modal>
</div>
