<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('CONTACTO') }}
        </h2>
    </x-slot>
    <section class="mb-56 text-center text-gray-800">
        <div class="max-w-[700px] mx-auto px-3 lg:px-6 mt-24 ">
          <h2 class="text-3xl font-bold mt-6 mb-12">Contacta con nosotros</h2>
            <form>
                <div class="form-group mb-6">
                    <input type="text" name="nombre" id="nombre" required class="form-control block w-full px-3 py-1.5 text-base font-normal
                    text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                    transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                    focus:outline-none" value="{{ old('nombre', $contacto->nombre) }}" placeholder="Name">
                </div>


                <div class="form-group mb-6">
                    <input type="email" name="email" id="email" required class="form-control block w-full px-3 py-1.5 text-base font-normal
                    text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                    transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                    focus:outline-none" value="{{ old('email', $contacto->email) }}" placeholder="Email address">
                </div>
                <div class="form-group mb-6">
                  <textarea required name="mensaje" id="mensaje" class=" form-control block w-full px-3 py-1.5 text-base font-normal
                    text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                    transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                    focus:outline-none" value="{{ old('mensaje', $contacto->mensaje) }}" rows="3" placeholder="Message"></textarea>
                </div>

                <button type="submit" class=" w-full px-6 py-2.5 bg-orange-600 text-white font-medium text-xs
                leading-tight uppercase rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-700
                focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-700 active:shadow-lg
                transition duration-150 ease-in-out">Send</button>

            </form>

        </div>

        <a href="/productos"
                    class=" ml-80 text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium
                    rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

      </section>


      <!-- Section: Design Block -->

    </div>


</x-app-layout>
