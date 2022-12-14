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
                                    <td>Respuesta</td>
                                </tr>

                                <tr class="border-2 border-grey-700">
                                    <td class="px-6 py-2 w-96">{{ $contacto->nombre }}</td>
                                    <td class="px-6 py-2">{{ $contacto->email }}</td>
                                    <td class="px-6 py-2">{{ $contacto->pregunta }}</td>
                                    <td class="px-6 py-2">{{ $contacto->respuesta }}</td>

                                    <td class="px-6 py-4">
                                        @if (Auth::user()->rol == "admin")

                                            <div class="respuesta">
                                                <a onclick="mostrarInput()" class="px-4 py-1 text-sm text-white bg-green-600 rounded">Responder</a>
                                            </div>

                                        @endif
                                    </td>

                                </tr>

                                <tr id="tr" class="border-2 border-grey-700 " style="display: none">

                                <form action="{{ route('contactos.update', $contacto->id, false) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                        <td class="px-6 py-2 ">
                                            <input type="text" id="respuesta" name="respuesta" required value="{{ old('respuesta', $contacto->respuesta) }}" placeholder="Respuesta">
                                        </td>
                                        <td>

                                            <button type="submit" id="botonRespuesta"
                                            class="px-4 py-1 text-sm text-white bg-green-600 rounded ">Enviar</button>

                                        </td>

                                </form>
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3199.4045114454934!2d-6.100251585829398!3d36.68881633906864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0dc71797e8eba1%3A0x1acdabef5bb2e494!2sVideoclub%20Rotonda%207!5e0!3m2!1ses!2ses!4v1670836906268!5m2!1ses!2ses" width="600" height="450" style="border: 24px solid #4C3F2B; border-radius:20px; margin: 0 auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

<script>

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

</script>

</x-app-layout>


