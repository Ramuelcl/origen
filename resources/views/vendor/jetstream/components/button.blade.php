{{-- resources\views\vendor\jetstream\components\boton.blade.php --}}
{{-- variables pasadas: :$bgColor, :$textColor --}}
@props(['tipo' => 'success'])

@php
  switch ($tipo) {
      case 'delete':
          $clase = 'inline-flex justify-center px-4 py-1 w-20 h-8 capitalize
            bg-red-700 font-semibold text-ls
              text-gray-100 border border-red-500 border-r-4 border-b-4 rounded-md tracking-widest shadow-sm
              hover:text-gray-200 hover:underline
              hover:border-r-2 hover:border-b-2
              focus:ring focus:border-gray-200 focus:outline-none
              active:text-gray-600
              active:bg-red-300 disabled:opacity-25 transition';
          break;
      case 'cancel':
          $clase = 'inline-flex px-2 py-1 w-20 h-8 capitalize
            bg-gray-700 font-semibold text-ls
              text-gray-100 border border-gray-500 border-r-4 border-b-4 rounded-md tracking-widest shadow-sm
              hover:text-gray-200 hover:underline
              hover:border-r-2 hover:border-b-2 hover:border-gray-500
              focus:ring focus:border-gray-200 focus:outline-none
              active:text-gray-600
              active:bg-gray-300 disabled:opacity-25 transition';
          break;
      case 'ok':
          $clase = 'inline-flex px-2 py-1 w-20 h-8 capitalize
            bg-blue-700 font-semibold text-ls
              text-gray-100 border border-blue-500 border-r-4 border-b-4 rounded-md tracking-widest shadow-sm
              hover:text-gray-200 hover:underline
              hover:border-r-2 hover:border-b-2
              focus:ring focus:border-gray-200 focus:outline-none
              active:text-gray-600
              active:bg-blue-300 disabled:opacity-25 transition';
          break;
      default:
          // save
          $clase = 'inline-flex px-2 py-1 w-20 h-8 capitalize
            bg-green-700 font-semibold text-ls
              text-gray-100 border border-green-500 border-r-4 border-b-4 rounded-md tracking-widest shadow-sm
              hover:text-gray-200 hover:underline
              hover:border-r-2 hover:border-b-2 hover:border-gray-500
              focus:ring focus:border-gray-200 focus:outline-none
              active:text-gray-600
              active:bg-green-300 disabled:opacity-25 transition';
          break;
  }
@endphp

{{-- atributos pasados: class, type --}}
<button {{ $attributes->merge([
    'type' => 'button',
    'class' => $clase,
]) }}>{{ $slot }}
</button>
