<button
  {{ $attributes->merge([
      'type' => 'button',
      'class' => 'items-center capitalize px-auto my-1 h-8 w-20 bg-gray-50 font-semibold text-ls text-white border
          border-gray-300 rounded-md tracking-widest shadow-sm hover:bg-white-500  hover:text-gray-500 hover:underline
          border-b-4 border-r-4 border-red-700
          hover:border-b-2 hover:border-r-2
          focus:outline-none focus:border-red-300 focus:ring focus:ring-blue-200 active:text-gray-600 active:bg-red-50 disabled:opacity-25 transition',
  ]) }}>
  {{ $slot }}
</button>
