
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('PERFIL') }}
        </h2>
    </x-slot>

<div class="flex">
    <div class="w-1/4">
    <img class="border-4 border-[#B99A66] h-96 w-96 rounded-full shadow-md m-8 " src="{{ URL($users->imagen) }}" alt="imagen del producto">
    </div>


    <div class="container mx-auto w-3/4">

        <!-- Parte izquierda con imagen de perfil -->
            <div class="ml-24 mt-8  border-2 border-[#4C3F2B]">
                <p class="text-4xl">{{ $users->name }}</p>
                <p class="text-2xl overflow-clip">{{ $users->descripcion }}</p>
            </div>

            <div class="ml-24 mt-24 mr-96 border-2 border-[#4C3F2B]">
                <p class="text-2xl">Email: {{ $users->email }}</p>
                <p class="text-2xl">Telefono: {{ $users->telefono }}</p>
                <p class="text-2xl">Ciudad: {{ $users->ciudad }}</p>
                <p class="text-2xl">Pais: {{ $users->pais }}</p>
            </div>
            <div class="pt-4">
                <a href="/perfiles/{{ $users->id }}/edit" class="px-4 py-2 text-sm text-white bg-green-600 rounded">Editar Perfil</a>
            </div>


        <!-- Parte derecha con datos y descripción -->




    </div>
</div>




</x-app-layout>


