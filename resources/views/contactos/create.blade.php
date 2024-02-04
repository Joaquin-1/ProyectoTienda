<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('CONTACTO') }}
        </h2>
    </x-slot>
    <section class="mb-56 text-center text-gray-800">
        <div class="max-w-[700px] mx-auto px-3 lg:px-6 mt-24 ">
          <h2 class="text-3xl font-bold mt-6 mb-12">¿Tienes alguna duda?</h2>
            <form id="form" action="{{ route('contactos.store', [], false) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-6">
                    <input type="text" name="nombre" id="nombre" required class="form-control block w-full px-3 py-1.5 text-base font-normal
                        text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                        transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                        focus:outline-none" value="{{ auth()->user()->name }}" placeholder="Name" readonly>
                </div>

                <div class="form-group mb-6">
                    <input type="text" name="email" id="email" required class="form-control block w-full px-3 py-1.5 text-base font-normal
                        text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                        transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                        focus:outline-none" value="{{ auth()->user()->email }}" placeholder="Email address" readonly>
                </div>

                <div class="form-group mb-6">
                  <textarea required name="pregunta" id="pregunta" class=" form-control block w-full px-3 py-1.5 text-base font-normal
                    text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                    transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                    focus:outline-none" value="{{ old('pregunta', $contacto->pregunta) }}" rows="3" placeholder="Pregunta"></textarea>
                    <p id="errorMsg1" class="hidden text-red-600">Por favor, ingresa una pregunta válida.</p>
                </div>

                <button type="submit" class=" w-full px-6 py-2.5 bg-orange-600 text-white font-medium text-xs
                leading-tight uppercase rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-700
                focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-700 active:shadow-lg
                transition duration-150 ease-in-out">Enviar</button>

            </form>

            <a href="/productos" class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium
            rounded-lg text-sm px-5 py-2.5 text-center" style=" display:flex; width:13%; margin-left:44%; margin-top:2%;">Volver</a>

        </div>



      </section>


      <!-- Section: Design Block -->

    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function() {

            var form = document.getElementById("form");

            form.addEventListener("submit", function(event) {
                // Validar el campo de nombre

                var preguntaInput = document.getElementById("pregunta");
                var preguntaValue = preguntaInput.value.trim();
                var preguntaRegex = /^\¿[^?]+\?$/; // Expresión regular para letras, numeros, caracteres especiales y espacios (He puesto que la ñ no este permitida)



                if (!preguntaRegex.test(preguntaValue) || (preguntaValue === '')) {
                    event.preventDefault(); // Detener el envío del formulario

                    // Mostrar mensaje de error
                    document.getElementById("errorMsg1").classList.remove("hidden");



                } else {
                    // Ocultar mensaje de error si el nombre es válido
                    document.getElementById("errorMsg1").classList.add("hidden");
                }


            });


        });

    </script>


</x-app-layout>
