{{-- contacto.blade.php --}}
<x-app-layout>

  <div class="mx-auto py-12">
    <h1>Déjanos un mensaje</h1>
    <form action="{{ route('contactanos.enviar') }}" method="post">
      @csrf
      <fieldset>
        <label class="form-label" for="name">* Nombre:
          <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            placeholder="ingrese nombre" tabindex="1" autofocus>
        </label>
        @error('name')
          <small>{{ $message }}</small>
        @enderror

        <br><br>
        <label class="form-label" for="email">* eMail:
          <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            tabindex="2" autofocus placeholder="ingrese su eMail">
        </label>
        @error('email')
          <small>{{ $message }}</small>
        @enderror

        <br><br>
        <label class="form-label" for="messagge">* Mensaje:
          <textarea name="messagge" id="messagge" row="5" tabindex="3" autofocus placeholder="ingrese su mensaje"></textarea>
        </label>
        @error('messagge')
          <small>{{ $message }}</small>
        @enderror

        <br><br>
        <p>* : champ required</p>
        <div class="mb-3">
          <button class="btn btn-success btn-submit">Submit</button>
        </div>
      </fieldset>
    </form>
    @if (session('info'))
      <script>
        alert("{{ session('info') }}");
      </script>
    @endif
  </div>

</x-app-layout>
