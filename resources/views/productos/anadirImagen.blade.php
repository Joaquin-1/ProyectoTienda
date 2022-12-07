<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Añadir Imagen') }}
        </h2>
    </x-slot>

    <form action="{{ route('imagen.store', $producto->id, [], false) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6 ml-80">
    <label for="imagen"
            class="text-sm font-medium text-gray-900 block mb-2 @error('imagen') text-red-500 @enderror">
            Añadir una nueva imagen
        </label>
        <input type="file" name="imagen" id="imagen"
            class="w-80 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Añadir</button>
        </div>
        </form>
</x-app-layout>
