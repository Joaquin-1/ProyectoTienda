<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('CART') }}
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
                                <p>You have not added anything to the cart yet</p>
                            @else
                                <th class="px-6 py-2 text-gray-500">

                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Product
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Amount
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Price
                                </th>
                                <th class="px-6 py-2 text-gray-500">

                                </th>
                                <th class="px-6 py-2 text-gray-500">

                                    <form action="{{route('vaciar')}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="hover:bg-orange-500 bg-orange-200 text-black border px-7 py-2 rounded-xl" type="submit"> Empty cart</button>
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
    <td class="px-6 py-2"><a href="{{route('producto', $carrito->producto)}}"><img class="h-60 w-auto" src="{{ URL($carrito->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
    <td class="px-6 py-2">{{ $carrito->producto->nombre }}</td>

    <td class="px-6 py-2">
        <div class="text-sm text-gray-900 inline-block">
            <form action="{{ route('restar', $carrito) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="px-4 py-1 text-sm border text-black mx-2 hover:bg-orange-500 rounded">-</button>
            </form>
        </div>{{ $carrito->cantidad }}

            <div class="text-sm text-gray-900 inline-block">
                <form action="{{ route('sumar', $carrito) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="px-4 py-1 border text-sm mx-2 text-black hover:bg-orange-500 rounded">+</button>
                </form>
            </div>
        </td>

        <td>

                                        {{ $carrito->producto->precio * $carrito->cantidad}}&euro;</td>
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

                                <span class="text-2xl mr-32 font-bold">Amount: </span><span class="font-bold text-xl">{{$total}}&euro;</span>
                            </div>
                            @endif
                        </div>
                        @if ($carritos->isEmpty())
                            @else
                            <div class="mt-5">

                            </div>
                            <div class="mt-5">
                                @if (Auth::user()->direccion == null)
                                <form action="{{route('indexDireccion')}}" method="get">
                                    @csrf
                                    @method('GET')

                                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 text-xl rounded-xl" type="submit"> Set your address</button>
                                </form>
                                @else
                                <form action="{{route('pagar', $total)}}" method="get">
                                    @csrf
                                    @method('get')

                                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 text-xl rounded-xl" type="submit"> Proceed to buy</button>
                                </form>
                            </div>
<div class="w-full ml-52 text-xl mt-20">
    <p><b> Your address is: </b></p>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="w-3/4">
                <thead class="border-b">
                  <tr>
                    <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                        STREET
                    </th>
                    <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                        CITY
                    </th>
                    <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                        POSTAL CODE
                    </th>
                    <th scope="col" class="text-m font-bold text-black px-6 py-4 text-left">
                        COUNTRY
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b">

                    <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{Auth::user()->direccion->calle}}
                    </td>
                    <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{Auth::user()->direccion->ciudad}}
                    </td>
                    <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{Auth::user()->direccion->codigo_postal}}
                    </td>
                    <td class="text-base text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        {{Auth::user()->direccion->pais}}
                    </td>
                  </tr>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

                                                            <form action="{{route('editDireccion', Auth::user()->direccion)}}" method="get">
                                                                @csrf
                                                                @method('GET')
                                                            <button type="submit" class="bg-orange-600 text-white px-6 py-2 mt-5 text-xl rounded-xl">Set address</button>
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
