{{-- resources\views\vendor\jetstream\components\boton.blade.php --}}
{{-- variables pasadas: :$bgColor, :$textColor --}}
@props(['tipo' => 'success'])

@php
switch ($tipo) {
case 'delete':
$clase = 'btn btn-red';
break;
case 'cancel':
$clase = 'btn btn-gray';
break;
case 'ok':
$clase = 'btn btn-blue';
break;
default:
// save
$clase = 'btn btn-green';
break;
}
@endphp

{{-- atributos pasados: class, type --}}
<button {{ $attributes->merge([
    'type' => 'button',
    'class' => $clase,
]) }}>{{ $slot }}
</button>
