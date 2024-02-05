<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Crear producto') }}
        </h2>
    </x-slot>


    <form id="form" action="{{ route('productos.store', [], false) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6 ml-80">
            <label for="nombre"
                class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
                Nombre
            </label>
            <input type="text" name="nombre" id="nombre"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
                >
            <p id="errorMsg1" class="hidden text-red-600">Por favor, ingresa un nombre válido.</p>


            <label for="categoria"
                class="text-sm font-medium text-gray-900 block mb-2 @error('categoria') text-red-500 @enderror">
                Categoria
            </label>

                <select class="categorias" name="categoria_id">
                    @foreach($categorias as $categoria)
                      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>


            <label for="imagen"
                class="text-sm font-medium text-gray-900 block mb-2 @error('imagen') text-red-500 @enderror">
                Imagen
            </label>
            <input type="file" name="imagen" id="imagen"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('imagen') border-red-500 @enderror"
                >




            <label for="descripcion"
            class="text-sm font-medium text-gray-900 block mb-2 @error('descripcion') text-red-500 @enderror">
            Descripcion
            </label>
            <input onkeyup="countChar(this)" type="textarea" name="descripcion" id="descripcion"
                class="h-20 w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('descripcion') border-red-500 @enderror"
                >
            <p id="errorMsg2" class="hidden text-red-600">Por favor, ingresa una descripcion válida.</p>
            <div id="charNum"> </div>


            <label for="precio"
                class="text-sm font-medium text-gray-900 block mb-2 @error('precio') text-red-500 @enderror">
                Precio
            </label>
            <input type="text" name="precio" id="precio"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('precio') border-red-500 @enderror"
                >
                <p id="errorMsg3" class="hidden text-red-600">Por favor, ingresa un precio válido.</p>


            <label for="video"
                class="text-sm font-medium text-gray-900 block mb-2 @error('video') text-red-500 @enderror">
                Video
            </label>
            <input type="text" name="video" id="video"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('video') border-red-500 @enderror"
                >
                <p id="errorMsg4" class="hidden text-red-600">Por favor, ingresa una url válida.</p>


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Enviar</button>
            <a href="/productos"
                class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

        </div>
        <div class="text-xl my-6 ml-80">
            <p>Para insertar un vídeo <span class="text-red-600"> NO </span> debes poner el link por defecto de Youtube. Compartir, insertar y se utiliza la url que aparece.</p>
        </div>
    </form>


    {{-- La validacion de si están vacios y el tamaño de los campos esta hecha en el lado del servidor ProductoControler (create/store) --}}
    {{-- Nota: Ahora esta en el lado del cliente tambien --}}


    <script>

        function countChar(val) {
            var len = val.value.length;
            if (len >= 500) {
                val.value = val.value.substring(0, 500);
            } else {
                $('#charNum').text(len);
            }
        };

        //Uso el local storage para guardar la informacion de los inputs en caso de que no este correcto el formulario

        document.addEventListener("DOMContentLoaded", function() {

            var form = document.getElementById("form");

            //Recoge el valor del localStorage para mostralo en los inputs.
            var nombreGuardado = localStorage.getItem('nombre');
            document.getElementById('nombre').value = nombreGuardado;

            var descripcionGuardado = localStorage.getItem('descripcion');
            document.getElementById('descripcion').value = descripcionGuardado;

            var precioGuardado = localStorage.getItem('precio');
            document.getElementById('precio').value = precioGuardado;

            var videoGuardado = localStorage.getItem('video');
            document.getElementById('video').value = videoGuardado;

            form.addEventListener("submit", function(event) {
                // Validar el campo de nombre

                var nombreInput = document.getElementById("nombre");
                var nombreValue = nombreInput.value.trim();
                var nombreRegex = /^$|^[a-zA-Z0-9](?:[a-zA-Z0-9\s\-_\.,'\(\)\[\]!&]*[a-zA-Z0-9])?$/; // Expresión regular para letras, numeros, caracteres especiales y espacios (He puesto que la ñ no este permitida)

                localStorage.setItem('nombre', nombreValue);

                if (!nombreRegex.test(nombreValue) || (nombreValue === '')) {
                    event.preventDefault(); // Detener el envío del formulario

                    // Mostrar mensaje de error
                    document.getElementById("errorMsg1").classList.remove("hidden");



                } else {
                    // Ocultar mensaje de error si el nombre es válido
                    document.getElementById("errorMsg1").classList.add("hidden");
                }


                var descripcionInput = document.getElementById("descripcion");
                var descripcionValue = descripcionInput.value.trim();
                var descripcionRegex = /^[\s\S]{1,500}$/; // Expresión regular para letras, numeros y espacios

                localStorage.setItem('descripcion', descripcionValue);

                if (!descripcionRegex.test(descripcionValue) || (descripcionValue === '')) {
                    event.preventDefault(); // Detener el envío del formulario

                    // Mostrar mensaje de error
                    document.getElementById("errorMsg2").classList.remove("hidden");
                } else {
                    // Ocultar mensaje de error si el nombre es válido
                    document.getElementById("errorMsg2").classList.add("hidden");
                }


                var precioInput = document.getElementById("precio");
                var precioValue = precioInput.value.trim();
                var precioRegex = /^\d*(?:\.\d{1,2})?$/; // Expresión regular para letras, numeros y espacios

                localStorage.setItem('precio', precioValue);

                if (!precioRegex.test(precioValue) || (precioValue === '')) {
                    event.preventDefault(); // Detener el envío del formulario

                    // Mostrar mensaje de error
                    document.getElementById("errorMsg3").classList.remove("hidden");
                } else {
                    // Ocultar mensaje de error si el nombre es válido
                    document.getElementById("errorMsg3").classList.add("hidden");
                }



                var videoInput = document.getElementById("video");
                var videoValue = videoInput.value.trim();
                var videoRegex = /^https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]{11}\?[\s\S]*$/; // Expresión regular para letras, numeros y espacios

                localStorage.setItem('video', videoValue);

                if (!videoRegex.test(videoValue)) {
                    event.preventDefault(); // Detener el envío del formulario

                    // Mostrar mensaje de error
                    document.getElementById("errorMsg4").classList.remove("hidden");
                } else {
                    // Ocultar mensaje de error si el nombre es válido
                    document.getElementById("errorMsg4").classList.add("hidden");
                }





            });


        });

    </script>

</x-app-layout>
