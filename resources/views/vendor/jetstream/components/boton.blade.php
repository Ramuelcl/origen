{{-- resources\views\vendor\jetstream\components\boton.blade.php --}}
{{-- variables pasadas --}}
@props(['type' => 'button', 'bgColor' => 'blue', 'textColor' => 'gray'])
<button type="{{ $type }}"
  {{ $attributes->merge([
      'class' => "bg-{{{bgColor}}-900 font-semibold text-ls
                text-{{{textColor}}-100 border border-gray-300 rounded-md tracking-widest shadow-sm
                hover:bg-{{{bgColor}}-500
                hover:text-{{{textColor}}-500 hover:underline focus:outline-none
                focus:border-{{{bgColor}}-300 focus:ring
                focus:ring-{{{bgColor}}-200
                active:text-{{{textColor}}-600
                active:bg-{{{bgColor}}-50 disabled:opacity-25 transition",
  ]) }}>{{ $slot }}
</button>
{{--
block:
items-center px-auto my-1 h-8 w-20
bg:
text:
borde:
hover:
focus:
active:
disabled:
            bg-blue-900 font-semibold text-ls
            text-white border border-gray-300 rounded-md tracking-widest shadow-sm
            hover:bg-blue-500
            hover:text-white-500 hover:underline focus:outline-none
            focus:border-blue-300 focus:ring
            focus:ring-blue-200
            active:text-white-600
            active:bg-blue-50 disabled:opacity-25 transition'
 --}}
