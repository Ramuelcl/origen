<div>
  {{-- método mágico: wire:click="$set('open', true)" --}}
  <a class="btn btn-green" wire:click="fncOpen()">
    <i class="fas fa-plus"></i>
    <p>{{ __('New') }}</p>
  </a>

  <x-jet-dialog-modal wire:model="open">
    <x-slot name="title">{{ __('create new') }}</x-slot>

    <div>
      <x-slot name="content">

        <div class="flex m-4">
          <div class="w-8/12 md:w-1/2
    p-4 bg-blue-500 mb-1">
            <hr>
            <div class="mb-4">
              <x-jet-label value="Nombre" />
              <x-jet-input type="text" wire:model.defer="nombre" class="w-full"></x-jet-input>
              <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
              <x-jet-label value="Hexa" />
              <x-jet-input type="color" wire:model.defer="hexa" class="w-full h-14" onchange="colorRGB(event)">
              </x-jet-input>
              <x-jet-input-error for="hexa" />
            </div>

            {{-- <div class="mb-4">
            <x-jet-label value="rgb" />
            <x-jet-input type="input" wire:model.defer="rgb" class="w-full"></x-jet-input>

            <x-jet-input-error for="rgb" />
          </div> --}}

            <div class="mb-4">
              <x-jet-label value="imagen" />
              <x-jet-input type="file" wire:model="imagen" id="{{ $idImagen }}"></x-jet-input>
              <x-jet-input-error for="imagen" />
            </div>
            <div wire:loading wire:target="imagen">
              <strong>{{ __('Imagen cargando') }}</strong>
              <span class="block sm:inline">{{ __('espere un momento') }}</span>
            </div>

          </div>
          <div class="w-4/12 md:w-1/2
    p-4 bg-green-700 mb-1">
            <x-imagen1>
              @if ($imagen)
                <img src="{{ $imagen->temporaryUrl() }}" class="object-scale-down">
              @endif
            </x-imagen1>

          </div>
          <hr>
        </div>

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
