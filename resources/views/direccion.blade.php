<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Añade tu dirección') }}
        </h2>
    </x-slot>
    <div class="h-10"></div>
    <form id="form" action="{{route('direccion', Auth::user())}}" method="post">
        @csrf
        @method('POST')


        <div class="mb-6 ml-80 w-96 border">
            <label for="calle"
                class="text-xl font-medium text-gray-900 block mb-2 @error('calle') text-red-500 @enderror">
                Calle
            </label>
            <input type="text" name="calle" id="calle" required
                class="text-xl w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">
                <p id="errorMsg1" class="hidden text-red-600">Por favor, ingresa una calle válida.</p>


                <label for="ciudad"
                class=" text-xl  font-medium text-gray-900 block mb-2 @error('ciudad') text-red-500 @enderror">
                Ciudad
            </label>
            <input type="text" name="ciudad" id="ciudad"
                class="w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">
                <p id="errorMsg2" class="hidden text-red-600">Por favor, ingresa una ciudad válida.</p>


                <label for="codigo_postal"
                class="text-xl font-medium text-gray-900 block mb-2 @error('codigo_postal') text-red-500 @enderror">
                Código Postal
            </label>
            <input type="text" name="codigo_postal" id="codigo_postal"
                class="w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">
                <p id="errorMsg3" class="hidden text-red-600">Por favor, ingresa un codigo postal válido.</p>

                <label for="pais"
                class="text-xl font-medium text-gray-900 block mb-2 @error('pais') text-red-500 @enderror">
                Pais
            </label>
            <input type="text" name="pais" id="pais"
                class="w-80  bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">
                <p id="errorMsg4" class="hidden text-red-600">Por favor, ingresa un pais válido.</p>


            <button type="submit"
                class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Cambiar dirección</button>


            </div>
    </form>

    <script>

document.addEventListener("DOMContentLoaded", function() {

var form = document.getElementById("form");



    form.addEventListener("submit", function(event) {
        // Validar el campo de nombre

        var calleInput = document.getElementById("calle");
        var calleValue = calleInput.value.trim();
        var calleRegex = /^[0-9A-Za-zÁÉÍÓÚáéíóúÜü\s\.\-,'&]+$/;


        if (!calleRegex.test(calleValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg1").classList.remove("hidden");



        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg1").classList.add("hidden");
        }


        var ciudadInput = document.getElementById("ciudad");
        var ciudadValue = ciudadInput.value.trim();
        var ciudadRegex = /^[A-Za-zÁÉÍÓÚáéíóúÜü\s\-']+$/;


        if (!ciudadRegex.test(ciudadValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg2").classList.remove("hidden");



        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg2").classList.add("hidden");
        }

        var codigo_postalInput = document.getElementById("codigo_postal");
        var codigo_postalValue = codigo_postalInput.value.trim();
        var codigo_postalRegex = /^\d{5}$/;


        if (!codigo_postalRegex.test(codigo_postalValue)) {
            event.preventDefault(); // Detener el envío del formulario

            // Mostrar mensaje de error
            document.getElementById("errorMsg3").classList.remove("hidden");



        } else {
            // Ocultar mensaje de error si el nombre es válido
            document.getElementById("errorMsg3").classList.add("hidden");
        }

        var paisInput = document.getElementById("pais");
        var paisValue = paisInput.value.trim();
        var paisRegex = /^España$/i;


        if (!paisRegex.test(paisValue)) {
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
