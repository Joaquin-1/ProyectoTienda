<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('PERFIL') }}
        </h2>
    </x-slot>




    <p class="text-3xl">{{ $users->name }}</p>
    <p class="text-3xl">{{ $users->email }}</p>
    <p class="text-3xl">{{ $users->descripcion }}</p>

    <a href="/perfiles/{{ $users->id }}/edit"
        class="px-4 py-1 text-sm text-white bg-blue-600 rounded">Editar</a>


</x-app-layout>
