
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
                <p class="text-4xl">{{ $users->name }}</p>
                <p class="text-2xl mt-4 break-words">{{ $users->descripcion }}</p>
            </div>

            <div class="ml-8 mt-8 border-2 border-[#4C3F2B] p-4">
                <p class="text-2xl">Email: {{ $users->email }}</p>
                <p class="mt-4 text-2xl">Telefono: {{ $users->telefono }}</p>
                <p class="mt-4 text-2xl">Ciudad: {{ $users->ciudad }}</p>
                <p class="mt-4 text-2xl">Pais: {{ $users->pais }}</p>
            </div>

            <div class="mb-8 mt-8 ml-8 text-center md:text-left">
                <a href="/perfiles/{{ $users->id }}/edit" class="px-4 py-2 text-sm text-white bg-green-600 rounded">Editar Perfil</a>
            </div>






</x-app-layout>


