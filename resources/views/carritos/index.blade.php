<x-app-layout>
    {{-- El <x-app-layout> permite que sea vea el footer que contiene el app.blade y el header que está en el navigation.
        Dentro del app.blade hay un enlace al navigation para solo tener que usar un etiqueta al llamarlo en la vista --}}
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-plantilla>
                        <table class="table-auto">
                            <thead>
                            @if ($carritos->isEmpty())
                                <p>No has añadido nada al carrito todavia</p>
                            @else
                                <th class="px-6 py-2 text-gray-500">

                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Producto
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Cantidad
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Precio
                                </th>
                                <th class="px-6 py-2 text-gray-500">

                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    <form action="{{route('vaciar')}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="hover:bg-orange-500 bg-orange-200 text-black border px-7 py-2 rounded-xl" type="submit"> Vaciar carrito</button>
                                    </form>
                                </th>
                            @endif
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp

                                @foreach ($carritos as $carrito)
                                <tr>
                                    <td class="px-6 py-2"><a href="{{route('producto', $carrito->producto)}}"><img class="hidden lg:block h-60 w-auto" src="{{ URL($carrito->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                                    <td class="px-6 py-2">{{ $carrito->producto->nombre }}</td>

                                    <td class="px-6 py-2 md:px-4 md:py-1 px-3 py-1">
                                        <div class="text-sm text-gray-900 inline-block">
                                            <form action="{{ route('restar', $carrito) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="flex justify-center px-2 px-4 py-1 border text-sm mx-2 text-black hover:bg-orange-500 rounded mx-1">-</button>
                                            </form>
                                        </div>
                                        {{ $carrito->cantidad }}
                                        <div class="text-sm text-gray-900 inline-block">
                                            <form action="{{ route('sumar', $carrito) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="flex justify-center px-2 px-4 py-1 border text-sm mx-2 text-black hover:bg-orange-500 rounded mx-1">+</button>
                                            </form>
                                        </div>
                                    </td>


                                    <td>{{ $carrito->producto->precio * $carrito->cantidad}}&euro;</td>
                                    @php
                                        $total += $carrito->producto->precio * $carrito->cantidad;
                                    @endphp

                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <div class="border-t-2 w-3/4 mt-3">
                            @if ($carritos->isEmpty() == false)
                                <div class="mt-4 text-right  mr-48">

                                    <span class="text-2xl mr-32 font-bold">Precio Total: </span><span class="font-bold text-xl">{{$total}}&euro;</span>

                                </div>
                            @endif
                        </div>
                        @if ($carritos->isEmpty())

                        @else

                            <div class="mt-10">
                                @if (Auth::user()->direccion == null)
                                <form action="{{route('indexDireccion')}}" method="get">
                                    @csrf
                                    @method('GET')

                                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 text-xl rounded-xl" type="submit"> Añade una direccion</button>
                                </form>
                                @else
                                <form action="{{route('pagar', $total)}}" method="get">
                                    @csrf
                                    @method('get')

                                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 text-xl rounded-xl" type="submit"> Proceder con la compra</button>



                                </form>
                            </div>

                            <div class="w-full mx-auto md:ml-8 lg:ml-52 text-xl mt-20">
                                <p class="font-bold">Tu dirección es:</p>
                                <div class="flex flex-col mt-4">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="overflow-hidden">
                                                <table class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-3/4">
                                                    <thead class="border-b">
                                                        <tr>
                                                            <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                                                                Calle
                                                            </th>
                                                            <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                                                                Ciudad
                                                            </th>
                                                            <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                                                                Código Postal
                                                            </th>
                                                            <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                                                                País
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-b">
                                                            <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ Auth::user()->direccion->calle }}
                                                            </td>
                                                            <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ Auth::user()->direccion->ciudad }}
                                                            </td>
                                                            <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ Auth::user()->direccion->codigo_postal }}
                                                            </td>
                                                            <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ Auth::user()->direccion->pais }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('editDireccion', Auth::user()->direccion) }}" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="bg-orange-600 text-white px-6 py-2 mt-5 text-xl rounded-xl">Cambiar dirección</button>
                                </form>
                            </div>
                            @endif

                        @endif
                    </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
