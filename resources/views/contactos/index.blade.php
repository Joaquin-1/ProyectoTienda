<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold leading-tight ">
            {{ __('Pregutas Frecuentes') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#ecfdf5] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <x-plantilla>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border-8 border-[#B99A66]">
                                <tbody>
                                    @foreach ($contactos as $contacto)
                                        <tr class="border-2 border-grey-700">
                                            <td class="px-4 py-2 sm:w-1/4">Nombre</td>
                                            <td class="px-4 py-2 sm:w-1/4">Email</td>
                                            <td class="px-4 py-2 sm:w-1/4">Pregunta</td>
                                            <td class="px-4 py-2 sm:w-1/4">Respuesta</td>
                                        </tr>
                                        <tr class="border-2 border-grey-700">
                                            <td class="px-4 py-2 sm:w-1/4">{{ $contacto->nombre }}</td>
                                            <td class="px-4 py-2 sm:w-1/4">{{ $contacto->email }}</td>
                                            <td class="px-4 py-2 sm:w-1/4">{{ $contacto->pregunta }}</td>
                                            <td class="px-4 py-2 sm:w-1/4">{{ $contacto->respuesta }}</td>
                                        </tr>
                                        <tr id="tr" class="border-2 border-grey-700">
                                            <form action="{{ route('contactos.update', $contacto->id, false) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                @if (Auth::user()->rol == "admin")
                                                    <td class="px-4 py-2 sm:w-1/2">
                                                        <input type="text" id="respuesta" name="respuesta" required value="{{ old('respuesta', $contacto->respuesta) }}" placeholder="Respuesta" class="w-full">
                                                    </td>
                                                    <td class="px-4 py-2 sm:w-1/2">
                                                        <button type="submit" id="botonRespuesta" class="px-4 py-1 text-sm text-white bg-green-600 rounded">Enviar</button>
                                                    </td>
                                                @endif
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-plantilla>
                </div>
            </div>
        </div>
    </div>


    <div style="mx-auto px-4 sm:px-6 lg:px-8 lg:w-1/2">
        <p class="text-xl text-center">Ubicación</p>
        <div class="relative overflow-hidden pb-8">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3199.4045114454934!2d-6.100251585829398!3d36.68881633906864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dc71797e8eba1%3A0x1acdabef5bb2e494!2sVideoclub%20Rotonda%207!5e0!3m2!1ses!2ses!4v1670836906268!5m2!1ses!2ses" width="600" height="450" style="border: 24px solid #4C3F2B; border-radius:20px; margin: 0 auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>


{{-- <script>

    function mostrarInput() {

        let tr = document.getElementById('tr');
        let respuesta = document.getElementById('respuesta');
        let botonRespuesta = document.getElementById('botonRespuesta');


        if(tr.style.display === "none") {
            tr.style.display = "";
        } else {
            tr.style.display = "none";
        }




    }

</script> --}}

</x-app-layout>


