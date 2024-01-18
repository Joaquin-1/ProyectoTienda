<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Editar perfil') }}
        </h2>
    </x-slot>


    <form id="form" action="{{ route('perfiles.update', $user->id, false) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-6 ml-80">



            <label for="name"
                class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
                Nombre
            </label>
            <input type="text" name="name" id="name"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
                value="{{ old('name', $user->name) }}">
            <p id="errorMsg1" class="hidden text-red-600">Por favor, ingresa un nombre válido.</p>


            <label for="descripcion"
                class="text-sm font-medium text-gray-900 block mb-2 @error('descripcion') text-red-500 @enderror">
                Descripcion
            </label>
            <input onkeyup="countChar(this)" type="textarea" name="descripcion" id="descripcion"
                class="h-20 w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('descripcion') border-red-500 @enderror"
                value="{{ old('descripcion', $user->descripcion) }}">
            <p id="errorMsg2" class="hidden text-red-600">Por favor, ingresa una descripcion válida.</p>
            <div id="charNum"></div>


            <label for="telefono"
                class="text-sm font-medium text-gray-900 block mb-2 @error('telefono') text-red-500 @enderror">
                Telefono
            </label>
            <input type="text" name="telefono" id="telefono"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('telefono') border-red-500 @enderror"
                value="{{ old('telefono', $user->telefono) }}">
            <p id="errorMsg3" class="hidden text-red-600">Por favor, ingresa un numero válido.</p>

            <label for="ciudad"
                class="text-sm font-medium text-gray-900 block mb-2 @error('ciudad') text-red-500 @enderror">
                ciudad
            </label>
            <input type="text" name="ciudad" id="ciudad"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('ciudad') border-red-500 @enderror"
                value="{{ old('ciudad', $user->ciudad) }}">
            <p id="errorMsg4" class="hidden text-red-600">Por favor, ingresa una ciudad válida.</p>

            <label for="pais"
                class="text-sm font-medium text-gray-900 block mb-2 @error('pais') text-red-500 @enderror">
                pais
            </label>
            <input type="text" name="pais" id="pais"
                class=" w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('pais') border-red-500 @enderror"
                value="{{ old('pais', $user->pais) }}">
            <p id="errorMsg5" class="hidden text-red-600">Por favor, ingresa un pais válido.</p>



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

    //Espera que el documento este cargado
    document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("form");
    form.addEventListener("submit", function(event) {
        // Validar el campo de nombre
        var nombreInput = document.getElementById("name");
        var nombreValue = nombreInput.value.trim();
        var nombreRegex = /^[a-zA-Z\s]+$/; // Expresión regular para letras y espacios

        if (!nombreRegex.test(nombreValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg1").classList.remove("hidden");
        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg1").classList.add("hidden");
        }


        var descripcionInput = document.getElementById("descripcion");
        var descripcionValue = descripcionInput.value.trim();
        var descripcionRegex = /^[a-zA-Z0-9\s]+$/; // Expresión regular para letras y espacios

        if (!descripcionRegex.test(descripcionValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg2").classList.remove("hidden");
        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg2").classList.add("hidden");
        }


        var telefonoInput = document.getElementById("telefono");
        var telefonoValue = telefonoInput.value.trim();
        var telefonoRegex = /^[6789]\d{8}$/; // Expresión regular para letras y espacios

        if (!telefonoRegex.test(telefonoValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg3").classList.remove("hidden");
        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg3").classList.add("hidden");
        }


        var ciudadInput = document.getElementById("ciudad");
        var ciudadValue = ciudadInput.value.trim();
        var ciudadRegex = /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s\-]+$/; // Expresión regular para letras y espacios

        if (!ciudadRegex.test(ciudadValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg4").classList.remove("hidden");
        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg4").classList.add("hidden");
        }


        var paisInput = document.getElementById("pais");
        var paisValue = paisInput.value.trim();
        var paisRegex = /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s\-]+$/; // Expresión regular para letras y espacios

        if (!paisRegex.test(paisValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg5").classList.remove("hidden");
        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg5").classList.add("hidden");
        }
    });


});


    </script>

</x-app-layout>
