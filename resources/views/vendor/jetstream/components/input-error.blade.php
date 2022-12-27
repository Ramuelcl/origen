@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'text-xs h-2 text-red-600']) }}>{{ $message }}</p>
@enderror
