<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Mis pedidos') }}
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
                                    Nombre
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Cantidad
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Precio
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Estado
                                </th>
                                <th class="px-6 py-2 text-gray-500">
                                    Fecha del Pedido
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
                                            <tr class="border-b-4 border-[#047857]">
                                                <td class="px-6 py-2"><img class="hidden lg:block h-44 w-auto" src="{{ URL($linea->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></td>
                                                <td class="px-6 py-2">{{ $linea->producto->nombre }}</td>
                                                <td class="px-6 py-2">{{ $linea->cantidad }}</td>
                                                <td class="px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                                <td class="px-6 py-2">{{ $linea->estado }}</td>
                                                <td class="px-6 py-2">{{$fecha[0]}}</td>

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
