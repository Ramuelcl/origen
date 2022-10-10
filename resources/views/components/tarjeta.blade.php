@props(['heading', 'footer'])
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
  <div class="bg-white p-3 rounded-lg shadow-sm">
    <heading class="italic flex items-stretch">
      {{ $heading ?? 'Tarjeta' }}
    </heading>
    <hr>

    {{ $slot ?? 'nada' }}

    <footer class="text-sm">
      {{ $footer ?? null }}
    </footer>
  </div>
</div>
