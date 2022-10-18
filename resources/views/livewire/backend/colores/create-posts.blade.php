<div>
  {{-- método mágico: wire:click="$set('open', true)" --}}
  <x-jet-danger-button wire:click="fncOpen()">{{ __('New') }}</x-jet-danger-button>
  <div>
    <x-jet-dialog-modal wire:model="open">

      <x-slot name="title">{{ __('create new') }}</x-slot>
      <x-slot name="content">

        <div class="mb-4">
          <x-jet-label value="Nombre" />
          <x-jet-input type="text" wire:model="nombre" class="w-full"></x-jet-input>
          <x-jet-input-error for="nombre" />
          {{ $nombre }}
        </div>

        <div class="mb-4">
          <x-jet-label value="Hexa" />
          <x-jet-input type="color" wire:model="hexa" class="w-full"></x-jet-input>
          <x-jet-input-error for="hexa" />
          {{ $hexa }}
        </div>

        <div class="mb-4">
          <x-jet-label value="rgb" />
          <x-jet-input type="input" wire:model="rgb" class="w-full"></x-jet-input>
          {{-- <textarea rows="6" wire:model.defer="rgb" class="form-control w-full"></textarea> --}}
          <x-jet-input-error for="rgb" />
          {{ $rgb }}
        </div>

      </x-slot>

      <x-slot name="footer">
        <x-jet-secondary-button wire:click="fncOpen()">{{ __('cancel') }}</x-jet-secondary-button>
        <x-jet-danger-button wire:click="fncSave()" wire:loading.attr="disabled" wire:target="fncSave"
          class="disabled:opacity-25 mx-4">{{ __('save') }}
        </x-jet-danger-button>
      </x-slot>
    </x-jet-dialog-modal>
  </div>
</div>
