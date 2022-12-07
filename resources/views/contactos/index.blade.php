<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold leading-tight ">
            {{ __('CATÁLOGO') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-[#B99A66] border-b border-gray-200">
                    <x-plantilla>
                        <table class="table-auto bg-white">
                            <tbody>
                                @foreach ($contactos as $contacto)

                                <tr>
                                    <td>Nombre</td>
                                    <td>Email</td>
                                    <td>Pregunta</td>
                                </tr>

                                <tr class="border-2 border-grey-700">
                                    <td class="px-6 py-2 w-96">{{ $contacto->nombre }}</td>
                                    <td class="px-6 py-2">{{ $contacto->email }}</td>
                                    <td class="px-6 py-2">{{ $contacto->mensaje }}</td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                    </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


