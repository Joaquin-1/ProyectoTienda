<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold leading-tight ">
            {{ __('CATÁLOGO') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <p style="float: left; padding-bottom: 5%; padding-left: 15%;">Insertar Categorias</p>
        <p style="padding-bottom: 5%; padding-left: 80%;">Insertar Ordenar Por Fecha</p>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-[#B99A66] border-b border-gray-200">
                    <x-plantilla>
                        <table class="table-auto bg-white">
                            <tbody>
                                @foreach ($productos as $producto)

                                @if (count($producto->imagenes) == 0)
                                @if (Auth::user()->rol == 'admin')
                                {{$producto->nombre}} No tiene imagen

                                <a href="/productos/{{ $producto->id }}/anadirImagen"
                                    class="px-4 py-1 text-sm text-white bg-blue-600 rounded">Añadir imagen</a>
                                    <form action="/productos/{{ $producto->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('¿Seguro?')" class="px-4 py-1 mt-5 text-sm text-white bg-red-600 rounded" type="submit">Borrar</button>
                                    </form>
                                    @else
                                    @endif

                                @else
                                <tr class="border-2 border-grey-700">
                                    @php
                                        $vermas = false;
                                            $desCorta = substr($producto->descripcion, 0, 70);
                                            if (strlen($producto->descripcion) > 70) {
                                                $desCorta = $desCorta . '...';
                                                $vermas = true;
                                            }
                                            else {
                                                $vermas = false;
                                            }
                                        @endphp
                                        <td class="px-6 py-2"><a href="{{route('producto', $producto)}}"> <img class="h-60 w-auto" src="{{ URL($producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                                        <td class="px-6 py-2 w-96"><p class="text-3xl mb-4 ">{{ $producto->nombre }}</p>{{ $desCorta }}
                                        @if ($vermas)
                                            <a class="font-bold hover:text-orange-700" href="{{route('producto', $producto)}}"> More </a>
                                        @endif
                                    </td>

                                        <td class="px-6 py-2">{{ $producto->precio }} &euro;</td>
                                        <td>
                                            <div class="text-sm text-gray-900 ">
                                                <form action="{{ route('anadiralcarrito', $producto) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="px-4 py-1 text-sm text-white bg-orange-500 rounded">Add to cart</button>
                                                </form>
                                            </div>

                                        </td>
                                        <td class="px-6 py-4">
                                            @if (Auth::user()->rol == "admin")

                                            <a href="/productos/{{ $producto->id }}/edit"
                                                class="px-4 py-1 text-sm text-white bg-blue-600 rounded">Editar</a>

                                            <p class="mt-5">
                                                <a href="/productos/{{ $producto->id }}/anadirImagen"
                                                    class="px-4 py-1 text-sm text-white bg-blue-600 rounded">Añadir imagen</a>
                                            </p>


                                                    <form action="/productos/{{ $producto->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('¿Seguro? Borrarás todos los datos de esta película')" class="px-4 py-1 mt-5 text-sm text-white bg-red-600 rounded" type="submit">Borrar</button>
                                                    </form>
                                                    @endif
                                                </td>
                                    </tr>

                                    @endif
                                @endforeach
                                @if (Auth::user()->rol == "admin")

                                <a href="/productos/create" class="my-4 text-black hover:underline text-xl">Insertar un nuevo producto</a>
                                @endif

                            </tbody>
                        </table>
                    </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
