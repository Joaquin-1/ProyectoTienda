<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('ORDERS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-plantilla>
                        <table class="table-auto">
                            <thead>
                                <th class="px-6 py-2 text-gray-500">

                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Name
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Amount
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Price
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    State
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Order placed
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                @foreach ($factura->lineas as $linea)
                                @if ($linea->estado == 'Completed')


                                @else
@php
    $fecha = explode(' ', $linea->created_at)
@endphp
                                <tr>
                                    <td class="px-6 py-2"><img class="h-44 w-auto" src="{{ URL($linea->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></td>
                                    <td class="px-6 py-2">{{ $linea->producto->nombre }}</td>
                                    <td class="px-6 py-2">{{ $linea->cantidad }}</td>
                                    <td class="px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                    <td class="px-6 py-2">{{ $linea->estado }}</td>
                                    <td class="px-6 py-2">{{$fecha[0]}}</td>
                                        <td>
                                            <div class="text-sm text-gray-900 ">
                                                {{-- <form action="{{ route('anadiralcarrito', $zapato) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="px-4 py-1 text-sm text-white bg-red-400 rounded">Añadir al carrito</button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
