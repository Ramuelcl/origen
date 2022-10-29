{{-- /resources/views/components/tarjetaPresentacion.blade.php --}}

<div class="md:flex bg-white rounded-lg p-6">
  <img src="{{ $avatar }}" alt="avatar" class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:px-auto">
  <div class="text-center md:text-left">
    <h2 class="text-lg capitalize">{{ $nombre }}</h2>
    <div class="text-purple-50 capitalize">{{ $profesion }}</div>
    <div class="text-gray-600 font-mono">{{ $eMail }}</div>
    <div class="text-gray-600">{{ $telefono }}</div>
  </div>
</div>
