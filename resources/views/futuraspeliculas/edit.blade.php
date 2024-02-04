<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Editar perfil') }}
        </h2>
    </x-slot>


    <form id="form" action="{{ route('futuraspeliculas.update', $futuraspeliculas->id, false) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-6 ml-80">



            <label for="name"
                class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
                Nombre
            </label>
            <input type="text" name="nombre" id="nombre"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
                value="{{ old('nombre', $futuraspeliculas->nombre) }}">
            <p id="errorMsg1" class="hidden text-red-600">Por favor, ingresa un nombre válido.</p>


                <label for="imagen_url"
                class="text-sm font-medium text-gray-900 block mb-2 @error('imagen_url') text-red-500 @enderror">
                Imagen_url
            </label>
            <input type="file" name="imagen_url" id="imagen_url"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('imagen_url') border-red-500 @enderror"
                >


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Cambiar</button>
            <a href="/perfiles"
                class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

        </div>

    </form>
</x-app-layout>
