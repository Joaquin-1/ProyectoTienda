<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold leading-tight ">
            {{ __('Pregutas Frecuentes') }}
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

    <div style="padding-left:25%; padding-right:25%;">
        <p class="text-xl text-center">Ubicación</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3199.4045114454934!2d-6.100251585829398!3d36.68881633906864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dc71797e8eba1%3A0x1acdabef5bb2e494!2sVideoclub%20Rotonda%207!5e0!3m2!1ses!2ses!4v1670836906268!5m2!1ses!2ses" width="600" height="450" style="border: 24px solid #4C3F2B; border-radius:20px; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</x-app-layout>


