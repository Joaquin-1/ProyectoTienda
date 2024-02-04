
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('PERFIL') }}
        </h2>
    </x-slot>

    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/4">
            <img class="border-4 border-[#B99A66] lg:ml-5 h-96 w-96 rounded-full shadow-md m-8 mx-auto md:mx-0" src="{{ URL($users->imagen) }}" alt="imagen del producto">
        </div>

        <div class="container mx-auto md:w-3/4">

            <div class="text-center md:text-left ml-8 mt-8">
                <p class="text-4xl font-semibold">{{ $users->name }}</p>
                <p class="text-2xl text-gray-600">{{ $users->descripcion }}</p>
            </div>

            <div class="ml-8 mt-8 border-t-2 border-[#4C3F2B] pt-4">
                <!-- Detalles del usuario -->
                <p class="text-2xl"><span class="font-semibold">Email:</span> {{ $users->email }}</p>
                <p class="mt-4 text-2xl"><span class="font-semibold">Teléfono:</span> {{ $users->telefono }}</p>
                <p class="mt-4 text-2xl"><span class="font-semibold">Ciudad:</span> {{ $users->ciudad }}</p>
                <p class="mt-4 text-2xl"><span class="font-semibold">País:</span> {{ $users->pais }}</p>
            </div>

            <div class="mb-8 mt-8 ml-8 text-center md:text-left">
                <a href="/perfiles/{{ $users->id }}/edit" class="px-4 py-2 text-sm text-white bg-green-600 rounded">Editar Perfil</a>
            </div>


            @if (Auth::user()->rol == "admin")
            <div class="mt-8 ml-8">
                <h2 class="text-2xl font-bold mb-4">Futuras Películas</h2>

                @foreach($futuraspeliculas as $pelicula)
                    <!-- Detalles de la película -->
                    <div class="flex items-center mt-4">
                        <img class="h-16 w-12 mr-4" src="{{ URL($pelicula->imagen_url) }}" alt="{{ $pelicula->nombre }}">
                        <p class="text-lg">{{ $pelicula->nombre }}</p>

                        <!-- Enlace para editar película -->
                        <div class="ml-2 text-center">
                            <a href="/futuraspeliculas/{{ $pelicula->id }}/edit" class="px-3 py-1 text-sm text-white bg-blue-600 rounded">Editar</a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

    </div>




</x-app-layout>


