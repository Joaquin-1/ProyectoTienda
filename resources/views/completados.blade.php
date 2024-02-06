<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Pedidos Completados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-plantilla>
                        <table class="w-full table-auto">
                            <thead>
                                <th class="hidden md:table-cell px-6 py-2 text-gray-500">

                                </th>
                                <th class="hidden md:table-cell px-6 py-2 text-gray-500">
                                    Nombre
                                </th>
                                <th class="hidden md:table-cell px-6 py-2 text-gray-500">
                                    Cantidad
                                </th>
                                <th class="hidden md:table-cell px-6 py-2 text-gray-500">
                                    Precio
                                </th>
                                <th class="hidden md:table-cell px-6 py-2 text-gray-500">
                                    Estado
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    @foreach ($factura->lineas as $index => $linea)
                                        @if ($linea->estado != 'Completed')

                                            @php
                                                $lineaArray = json_decode($factura->linea, true);
                                            @endphp


                                        @else

                                            @if (count($factura->lineas) == 1)
                                                <tr>
                                                    <td class="hidden md:block px-6 py-2"><img class="h-44 w-auto"
                                                            src="{{ URL($linea->producto->imagenes[0]->imagen) }}"
                                                            alt="imagen del producto"></td>
                                                    <td class=" px-6 py-2">{{ $linea->producto->nombre }}</td>
                                                    <td class=" px-6 py-2">{{ $linea->cantidad }}</td>
                                                    <td class=" px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                                    <td class=" px-6 py-2">{{ $linea->estado }}</td>
                                                </tr>


                                                    <tr class="border-b-4 border-red-500">

                                                    <td class="px-6 py-2 ">Datos del comprador: </td>
                                                    <td class="px-6 py-2 ">{{ $linea->factura->user->name }}</td>
                                                    <td class="px-6 py-2 ">{{ $linea->factura->user->email }}</td>
                                                    <td class="px-6 py-2 ">{{ $linea->factura->user->direccion->calle }}</td>
                                                    <td class="px-6 py-2 ">{{ $linea->factura->user->direccion->ciudad }}</td>
                                                </tr>
                                            @endif

                                            @if (count($factura->lineas) > 1)

                                                <tr>
                                                    <td class="hidden md:block px-6 py-2"><img class="h-44 w-auto"
                                                            src="{{ URL($linea->producto->imagenes[0]->imagen) }}"
                                                            alt="imagen del producto"></td>
                                                    <td class=" px-6 py-2">{{ $linea->producto->nombre }}</td>
                                                    <td class=" px-6 py-2">{{ $linea->cantidad }}</td>
                                                    <td class=" px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                                    <td class=" px-6 py-2">{{ $linea->estado }}</td>
                                                </tr>

                                                    @if ($index === count($factura->lineas) - 1)
                                                        <tr class="border-b-4 border-red-500">
                                                            <td class="px-6 py-2 ">Datos del comprador: </td>
                                                            <td class="px-6 py-2 ">{{ $linea->factura->user->name }}</td>
                                                            <td class="px-6 py-2 ">{{ $linea->factura->user->email }}</td>
                                                            <td class="px-6 py-2 ">{{ $linea->factura->user->direccion->calle }}</td>
                                                            <td class="px-6 py-2 ">{{ $linea->factura->user->direccion->ciudad }}</td>
                                                        </tr>
                                                    @endif
                                            @endif

                                        @endif
                                    @endforeach
                                @endforeach



                            </tbody>
                        </table>

                        {{ $facturas->links() }}

                    </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
