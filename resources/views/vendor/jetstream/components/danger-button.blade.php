@props(['color' => 'red'])
<button
  {{ $attributes->merge([
      'type' => 'button',
      'class' => 'items-center capitalize px-auto py-1 h-8 w-20 font-semibold text-ls text-gray-50
                              bg-{$color}-600 border-b-4 border-r-4 border-red-700
                              hover:border-b-2 hover:border-r-2
                             rounded-md tracking-widest hover:bg-red-400 hover:text-white-500 hover:underline focus:outline-none focus:border-red-700 focus:border-b-2 focus:border-r-2 focus:ring focus:ring-red-200 active:text-white-900 active:bg-red-600 disabled:opacity-25 transition',
  ]) }}>
  {{ $slot }}
</button>
