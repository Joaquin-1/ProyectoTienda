<head>
    <!-- JIT SUPPORT, for using peer-* below -->
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
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
                            <div class="flex">
                                <img id="" onclick="cambiarImagenAnterior()"
                                    class="h-10 mt-44 mr-3 cursor-pointer" src="{{ URL('img/anterior.png') }}"
                                    alt="">
                                <img id="imgGrande" class="w-96 h-auto border" src="{{ URL($imagenes->get()[0]->imagen) }}"
                                    alt="">
                                <img id="" onclick="cambiarImagen()" class="h-10 mt-44 ml-3 cursor-pointer"
                                    src="{{ URL('img/proximo.png') }}" alt="">
                                <div class="mt-28 ml-20 ">
                                    <p class="text-2xl">{{ $producto->descripcion }}</p>
                                    <p class="text-m mt-10">{{ $producto->precio }} &euro;</p>

                                    <form action="{{ route('anadiralcarrito', $producto) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            class=" mt-10 px-6 py-3 text-xl text-white bg-orange-500 hover:bg-orange-600 rounded">Add
                                            to cart</button>
                                    </form>



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
                        <div class="flex bg-black w-full h-auto my-10 py-20 items-center justify-center">

                                <iframe class="" width="560" height="315" src="{{ $producto->video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>


                                </div>
                            @endif
                        <h3 class="mb-4 mt-10 text-lg font-semibold text-gray-900">Comments</h3>
                        <div class="flex items-center justify-center shadow-lg mt-10 mb-4 w-11/12">
                        <form class="w-3/4" action="{{ route('anadircomentario') }}" method="POST">
                            @csrf
                            @method('POST')
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-full px-3 mb-2 mt-2">
                                       <input id="comentario" name="comentario" maxlength="300" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" placeholder='Type Your Comment' required></input>
                                    </div>
                                    <input type="text" id="producto" name="producto" hidden value="{{$producto->id}}">
                                    <div class="w-full md:w-full flex items-start md:w-full px-3">
                                       <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">

                                          <p class="text-xs md:text-sm pt-px">Be nice</p>
                                       </div>
                                       <div class="-mr-1">
                                          <input type='submit' class="bg-orange-500 text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-orange-700" value='Post Comment'>
                                       </div>
                                    </div>
                        </form>
                        </div>
                    </div>
                        <!-- component -->
                        @foreach ($producto->comentarios as $comentario)
                        @php
                            $fecha = explode(' ', $comentario->created_at)
                        @endphp
@if ($comentario->comentario_id != null)
    @else

    <div class="space-y-4 w-full">

        <div class="flex">
                        <div class="flex-shrink-0 mr-3">

                        </div>
                        <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed ">

                            <strong>{{$comentario->user->name}}</strong> <span class="text-xs ml-2 text-gray-400">
                                {{$fecha[0]}}
                            </span>
                            @if ($comentario->user->name == "admin")

                            <span class="text-xs ml-2 text-blue-700">
                                Admin
                            </span>
                            @endif
                            <div class="flex">
                          <p class="text-sm w-3/4 inline-block">
                            {{$comentario->texto}}
                          </p>
                        </div>
                          <div class="mt-4 flex items-center">
                            <div class="block w-full -space-x-2 mr-2">

                                <details class="text-sm text-gray-500 hover:text-black cursor-pointer font-semibold block">
                                    <summary style="list-style: none;"> Reply
                                    </summary>
                                    <form class="mt-4" action="{{ route('anadirrespuesta') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input class="rounded w-3/4" type="text" id="comentario" name="comentario" maxlength="300">
                                        <label for="producto" hidden></label>
                                        <input type="text" id="producto" name="producto" hidden value="{{$producto->id}}">
                                        <label for="comentariopadre" hidden></label>
                                        <input type="text" id="comentariopadre" name="comentariopadre" hidden value="{{$comentario->id}}">
                                        <input type='submit' class="bg-orange-500 text-white font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-orange-700" value='Reply'>
                                    </form>
                                </details>
                                @if ( $comentario->respuestas )
                                <div class="space-y-4">
       @foreach($comentario->respuestas as $respuesta)
           <div class="flex mt-6">
            <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
              <strong>{{$respuesta->user->name}}</strong> <span class="text-xs ml-2 text-gray-400">{{$fecha[0]}}</span>
              @if ($respuesta->user->rol == "admin")

              <span class="text-xs ml-2 text-blue-700">
                  Admin
              </span>
              @endif
              <p class="text-xs sm:text-sm">
                {{$respuesta->texto}}
              </p>
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
            </div>
        </div>
    </div>
    </div>
    </x-plantilla>

    </div>
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
