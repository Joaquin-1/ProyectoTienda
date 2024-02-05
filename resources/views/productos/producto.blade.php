<head>

    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold leading-tight">
            {{ $producto->nombre }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-plantilla>
                        <div class="mr-20">
                            <div class="flex flex-col lg:flex-row">
                                <div class="flex flex-col lg:flex-row items-center">
                                    <img id="" onclick="cambiarImagenAnterior()" class="h-10 mt-4 lg:mt-0 lg:mr-3 cursor-pointer" src="{{ URL('img/anterior.png') }}" alt="">
                                    <img id="imgGrande" class="w-full lg:w-1/2 h-auto border mb-4 lg:mb-0" src="{{ URL($imagenes->get()[0]->imagen) }}" alt="">

                                    <img id="" onclick="cambiarImagen()" class="h-10 mt-4 lg:mt-0 lg:ml-3 cursor-pointer" src="{{ URL('img/proximo.png') }}" alt="">
                                </div>

                                <div class="lg:w-1/2 mt-4 lg:mt-28 lg:ml-20">
                                    <p class="text-2xl">{{ $producto->descripcion }}</p>
                                    <p class="text-m mt-2 lg:mt-10">{{ $producto->precio }} &euro;</p>

                                    @if (Auth::user()->rol == "cliente")
                                    <form action="{{ route('anadiralcarrito', $producto) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="mt-2 lg:mt-10 px-6 py-3 text-xl text-white bg-orange-500 hover:bg-orange-600 rounded">Añadir al carrito</button>
                                    </form>
                                    @endif
                                </div>
                            </div>


                            <div class="grid grid-cols-3 gap-3 w-80 ml-[3.25rem]">
                                @foreach ($imagenes->get() as $imagen)
                                    <div>
                                        <img class="imgPeque" id="{{ $imagen->imagen }}"
                                            style="height: 5rem; margin-top: 0.5rem; border:1px solid rgb(196, 193, 193);"
                                            src="{{ URL($imagen->imagen) }}" alt="">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        @if ($producto->video != null)
                            <div class="flex bg-black w-full h-auto mt-12 py-4 items-center justify-center">

                                <iframe id="video1" class="sm:w-1/2 sm:h-60" src="{{ $producto->video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>


                            </div>
                        @endif
                        <h3 class="mb-4 mt-10 text-lg font-semibold text-gray-900">Comentarios</h3>

                        <style>
                            @media (min-width: 1000px) {
                              #video1 {
                                width: 1000px;
                                height: 600px;
                              }
                            }
                        </style>

                        <script>
                            $(document).ready(function() {
                                $('#formulario-comentario').submit(function(e) {
                                    e.preventDefault();

                                    $.ajax({
                                        type: 'POST',
                                        url: '{{ route("anadircomentario") }}',
                                        data: $('#formulario-comentario').serialize(),
                                        dataType: 'json',
                                        success: function(response) {
                                            console.log('Respuesta del servidor:', response);


                                            var comentario = response.comentario;
                                            var comentarioId = comentario.id;
                                            var comentarioTexto = comentario.texto;
                                            var comentarioNombreusuario = comentario.nombre_usuario;

                                            var comentarioFecha = formatDate(comentario.created_at);
                                            var comentarioHTML = `
                                                <div class="flex">
                                                    <div class="flex-shrink-0 mr-3"></div>
                                                    <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed ">
                                                        <strong>${comentarioNombreusuario}</strong> <span class="text-xs ml-2 text-gray-400">${comentarioFecha}</span>
                                                        <div class="flex">
                                                            <p class="text-sm w-3/4 inline-block">${comentarioTexto}</p>
                                                        </div>
                                                        <div class="mt-4 flex items-center">
                                                            <div class="block w-full -space-x-2 mr-2">
                                                                <details class="text-sm text-gray-500 hover:text-black cursor-pointer font-semibold block">
                                                                    <summary style="list-style: none;"> Responder </summary>
                                                                    <form class="mt-4" action="{{ route('anadirrespuesta') }}" method="POST">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <input class="rounded w-3/4" type="text" id="comentario" name="comentario" maxlength="300">
                                                                        <label for="producto" hidden></label>
                                                                        <input type="text" id="producto" name="producto" hidden value="{{ $producto->id }}">
                                                                        <label for="comentariopadre" hidden></label>
                                                                        <input type="text" id="comentariopadre" name="comentariopadre" hidden value="${comentarioId}">
                                                                        <input type='submit' class="bg-orange-500 text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-orange-700" value='Responder'>
                                                                    </form>
                                                                </details>
                                                                <!-- Puedes agregar aquí la lógica para mostrar respuestas si es necesario -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;

                                            $('#comentariosDiv').append(comentarioHTML);
                                            $('#comentario').val('');
                                        },
                                        error: function(error) {
                                            console.error('Error en la solicitud AJAX');
                                        }
                                    });
                                });
                            });

                            function formatDate(dateString) {
                                const date = new Date(dateString);
                                const year = date.getFullYear();
                                const month = date.getMonth() + 1; // Los meses son indexados desde 0
                                const day = date.getDate();

                                // Formatear para que tenga el formato 'YYYY-MM-DD'
                                const formattedDate = `${year}-${month}-${day}`;

                                return formattedDate;
                            }
                        </script>




                        <div class="flex items-center justify-center shadow-lg mt-10 mb-4 w-11/12">
                            <form id="formulario-comentario" class="w-3/4" action="{{ route('anadircomentario') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-full px-3 mb-2 mt-2">
                                        <input id="comentario" name="comentario" maxlength="300"
                                            class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                            placeholder='Escribe tu comentario' required>
                                    </div>
                                    <input type="text" id="producto" name="producto" hidden
                                        value="{{ $producto->id }}">
                                    <div class="w-full md:w-full flex items-start md:w-full px-3">
                                        <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">

                                            <p class="text-xs md:text-sm pt-px">Se respetuoso</p>
                                        </div>
                                        <div class="-mr-1">
                                            <input type='submit'
                                                class="bg-orange-500 text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-orange-700"
                                                value='Comentar'>
                                        </div>
                                    </div>
                            </form>
                        </div>
                </div>




                <div id="comentariosDiv" class="space-y-4 w-full">
                    @foreach ($producto->comentarios as $comentario)
                        @php
                            $fecha = explode(' ', $comentario->created_at);
                        @endphp
                        @if ($comentario->comentario_id != null)

                        @else
                            <div  class="flex">
                                <div class="flex-shrink-0 mr-3">

                                </div>
                                <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed ">

                                    {{-- <p>{{$comentario->id}}</p> --}}

                                    <strong>{{ $comentario->user->name }}</strong> <span
                                        class="text-xs ml-2 text-gray-400">
                                        {{ $fecha[0] }}
                                    </span>
                                    @if ($comentario->user->name == 'admin')
                                        <span class="text-xs ml-2 text-blue-700">
                                            Admin
                                        </span>
                                    @endif

                                    <div class="flex">
                                        <p class="text-sm w-3/4 inline-block">
                                            {{ $comentario->texto }}
                                        </p>
                                    </div>

                                    @if (Auth::user()->rol == "admin")
                                        <div class="mt-4">

                                            <form action="/comentarios/{{ $comentario->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('¿Seguro? Borrarás el comentario y sus respuestas')"
                                                        type="submit" class="px-4 py-1 text-sm text-white bg-red-600 rounded">Borrar
                                                </button>
                                            </form>

                                        </div>
                                    @endif


                                    <div class="mt-4 flex items-center">
                                        <div class="block w-full -space-x-2 mr-2">

                                            <details
                                                class="text-sm text-gray-500 hover:text-black cursor-pointer font-semibold block">
                                                <summary style="list-style: none;"> Responder
                                                </summary>
                                                <form class="mt-4" action="{{ route('anadirrespuesta') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input class="rounded w-3/4" type="text" id="comentario"
                                                        name="comentario" maxlength="300">
                                                    <label for="producto" hidden></label>
                                                    <input type="text" id="producto" name="producto" hidden
                                                        value="{{ $producto->id }}">
                                                    <label for="comentariopadre" hidden></label>
                                                    <input type="text" id="comentariopadre" name="comentariopadre"
                                                        hidden value="{{ $comentario->id }}">
                                                    <input type='submit'
                                                        class="bg-orange-500 text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-orange-700"
                                                        value='Responder'>
                                                </form>
                                            </details>
                                            @if ($comentario->respuestas)
                                                <div class="space-y-4">
                                                    @foreach ($comentario->respuestas as $respuesta)
                                                        <div class="flex mt-6">
                                                            <div
                                                                class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                                                                {{-- <p>{{$respuesta->id}}</p> --}}
                                                                <strong>{{ $respuesta->user->name }}</strong> <span
                                                                    class="text-xs ml-2 text-gray-400">{{ $fecha[0] }}</span>
                                                                @if ($respuesta->user->rol == 'admin')
                                                                    <span class="text-xs ml-2 text-blue-700">
                                                                        Admin
                                                                    </span>
                                                                @endif
                                                                <p class="text-xs sm:text-sm">
                                                                    {{ $respuesta->texto }}
                                                                </p>

                                                                @if (Auth::user()->rol == "admin")
                                                                    <div class="mt-4">

                                                                        <form action="/comentarios/{{ $respuesta->id }}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button onclick="return confirm('¿Seguro? Borrarás el comentario de esta película')"
                                                                                    type="submit" class="px-4 py-1 text-sm text-white bg-red-600 rounded">Borrar
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                @endif

                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>



                </x-plantilla>

            </div>
        </div>
    </div>

    <script>
        imgGrande = document.getElementById("imgGrande");
        imgPeque = document.getElementsByClassName("imgPeque");
        cont = 1;

        function cambiarImagen() {
            if (cont < 0) {
                cont = 0;
            } else {
                if (cont > imgPeque.length - 1) {
                    cont = 0;
                    imgGrande.src = imgPeque[cont].src
                } else {
                    if (cont == 0) {
                        imgGrande.src = imgPeque[cont + 1].src
                            ++cont
                    } else {
                        imgGrande.src = imgPeque[cont].src
                    }
                    ++cont
                }
            }

        }

        function cambiarImagenAnterior() {

            if (cont <= 0) {
                cont = imgPeque.length - 1;
                imgGrande.src = imgPeque[imgPeque.length - 1].src
            } else {

                --cont
                imgGrande.src = imgPeque[cont].src
            }
        }
    </script>
</x-app-layout>
