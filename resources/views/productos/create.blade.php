<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Crear producto') }}
        </h2>
    </x-slot>


    <form action="{{ route('productos.store', [], false) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6 ml-80">
            <label for="nombre"
                class="text-sm font-medium text-gray-900 block mb-2 @error('nombre') text-red-500 @enderror">
                Nombre
            </label>
            <input type="text" name="nombre" id="nombre"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror"
                value="{{ old('nombre', $producto->nombre) }}">




            <label for="imagen"
                class="text-sm font-medium text-gray-900 block mb-2 @error('imagen') text-red-500 @enderror">
                Imagen
            </label>
            <input type="file" name="imagen" id="imagen"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('imagen') border-red-500 @enderror"
                value="{{ old('imagen', $producto->imagen) }}">




            <label for="descripcion"
                class="text-sm font-medium text-gray-900 block mb-2 @error('descripcion') text-red-500 @enderror">
                Sinopsis
            </label>
            <input type="text" name="descripcion" id="descripcion"
                class="h-20 w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('descripcion') border-red-500 @enderror"
                value="{{ old('descripcion', $producto->descripcion) }}">



            <label for="precio"
                class="text-sm font-medium text-gray-900 block mb-2 @error('precio') text-red-500 @enderror">
                Precio
            </label>
            <input type="text" name="precio" id="precio"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('precio') border-red-500 @enderror"
                value="{{ old('precio', $producto->precio) }}">


            <label for="video"
                class="text-sm font-medium text-gray-900 block mb-2 @error('video') text-red-500 @enderror">
                Video
            </label>
            <input type="text" name="video" id="video"
                class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('video') border-red-500 @enderror"
                value="{{ old('video', $producto->video) }}">


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Enviar</button>
            <a href="/productos"
                class="text-white border-green-700 border-2 bg-green-700 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Volver</a>

        </div>
        <div class="text-xl my-6 ml-80">
            <p>Para insertar un vídeo no debes poner el link por defecto de Youtube.
        </div>
    </form>
</x-app-layout>
