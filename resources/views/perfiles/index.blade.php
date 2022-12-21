<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('PERFIL') }}
        </h2>
    </x-slot>


        <div style="display: flex">

                    <div class="mt-12 ml-12" style="width:25%">

                        <p class="text-4xl">{{ $users->name }}</p>
                        <img class="h-60 w-auto mt-8" src="{{ URL($users->imagen) }}" alt="imagen del producto">
                        <p class="text-2xl pt-8">{{ $users->email }}</p>
                        <div class="pt-8">
                        <a href="/perfiles/{{ $users->id }}/edit"
                            class="px-4 py-1 text-sm text-white bg-green-600 rounded">Editar Perfil</a>
                        </div>
                    </div>


                    <div class="pt-36" style="width:70%">
                        <p class="text-2xl">{{ $users->descripcion }}</p>
                    </div>
        </div>













</x-app-layout>
