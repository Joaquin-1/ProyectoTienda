<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Editar producto') }}
        </h2>
    </x-slot>


    <form action="{{ route('productos.update', $producto->id, false) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-6 ml-80">
        <label for="nombre"
            class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
            Nombre
        </label>
        <input type="text" name="nombre" id="nombre"
            class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
            value="{{ old('nombre', $producto->nombre) }}">



        <label for="descripcion"
            class="text-sm font-medium text-gray-900 block mb-2 @error('descripcion') text-red-500 @enderror">
            Sinopsis
        </label>
        <input type="text" name="descripcion" id="descripcion"
            class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('descripcion') border-red-500 @enderror"
            value="{{ old('descripcion', $producto->descripcion) }}">



        <label for="precio"
            class="text-sm font-medium text-gray-900 block mb-2 @error('precio') text-red-500 @enderror">
            Precio
        </label>
        <input type="text" name="precio" id="precio"
            class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            value="{{ old('precio', $producto->precio) }}">


            <label for="url"
            class="text-sm font-medium text-gray-900 block mb-2 @error('url') text-red-500 @enderror">
            Video Youtube
        </label>
        <input type="text" name="video" id="video"
            class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            value="{{ old('video', $producto->video) }}">


        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Cambiar</button>
        <a href="/productos"
            class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

        </div>

        <div class="text-xl my-6 ml-80">
            <p>Para insertar un vídeo no debes poner el link por defecto de Youtube. <br> Hazlo así:</p>

            <img class="h-[500px]" src="{{ URL("img/captura1.jpg") }}" alt="primera captura">

            <p class="my-10"> Haz click en compartir, luego en "Insertar" y copia el link seleccionado en la imagen.</p>
            <img class="h-[500px] mb-12" src="{{ URL("img/captura2.png") }}" alt="segunda captura">

        </div>
    </form>


</x-app-layout>
