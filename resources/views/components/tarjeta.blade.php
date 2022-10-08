@props(['heading', 'footer'])
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
