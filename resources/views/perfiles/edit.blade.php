<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Editar perfil') }}
        </h2>
    </x-slot>


    <form action="{{ route('perfiles.update', $user->id, false) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-6 ml-80">

            {{-- <?php dd($user); ?> --}}

            <label for="name"
                class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
                Nombre
            </label>
            <input type="text" name="name" id="name"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
                value="{{ old('nombre', $user->name) }}">


            <label for="descripcion"
                class="text-sm font-medium text-gray-900 block mb-2 @error('descripcion') text-red-500 @enderror">
                Descripcion
            </label>
            <input onkeyup="countChar(this)" type="textarea" name="descripcion" id="descripcion"
                class="h-20 w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('descripcion') border-red-500 @enderror"
                value="{{ old('descripcion', $user->descripcion) }}">
            <div id="charNum"></div>


            <label for="telefono"
                class="text-sm font-medium text-gray-900 block mb-2 @error('telefono') text-red-500 @enderror">
                Telefono
            </label>
            <input type="text" name="telefono" id="telefono"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('telefono') border-red-500 @enderror"
                value="{{ old('telefono', $user->telefono) }}">

            <label for="ciudad"
                class="text-sm font-medium text-gray-900 block mb-2 @error('ciudad') text-red-500 @enderror">
                ciudad
            </label>
            <input type="text" name="ciudad" id="ciudad"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('ciudad') border-red-500 @enderror"
                value="{{ old('ciudad', $user->ciudad) }}">

            <label for="pais"
                class="text-sm font-medium text-gray-900 block mb-2 @error('pais') text-red-500 @enderror">
                pais
            </label>
            <input type="text" name="pais" id="pais"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('pais') border-red-500 @enderror"
                value="{{ old('pais', $user->pais) }}">



            <label for="imagen"
                class="text-sm font-medium text-gray-900 block mb-2 @error('imagen') text-red-500 @enderror">
                Imagen
            </label>
            <input type="file" name="imagen" id="imagen"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('imagen') border-red-500 @enderror"
                >


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Cambiar</button>
            <a href="/perfiles"
                class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

        </div>

    </form>

    <script>
        function countChar(val) {
      var len = val.value.length;
      if (len >= 500) {
        val.value = val.value.substring(0, 500);
      } else {
        $('#charNum').text(len);
      }
    };

    </script>

</x-app-layout>
