<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Historial de Compra') }}
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
                                    Fecha Pedida
                                </th>
                            </thead>
                            <tbody>

                                @php
                                    $facturasProcesadas = [];
                                @endphp

                        @foreach ($facturas as $factura)
                            @foreach ($factura->lineas as $linea)
                                @if ($linea->estado != 'Completed')


                                @else


                                    @if (!in_array($factura->id, $facturasProcesadas))
                                        @php
                                            $facturasProcesadas[] = $factura->id;
                                        @endphp

                                        @if (count($factura->lineas) > 0)
                                            @php
                                                $fecha = explode(' ', $factura->lineas[0]->created_at)
                                            @endphp

                                            @if (count($factura->lineas) == 1)
                                                <tr class="border-b-4 border-red-700 ]">
                                            @endif

                                            <td class="px-6 py-2">{{ $factura->lineas[0]->producto->nombre }}</td>
                                            <td class="px-6 py-2">{{ $factura->lineas[0]->cantidad }}</td>
                                            <td class="px-6 py-2">{{ $factura->lineas[0]->producto->precio * $factura->lineas[0]->cantidad }}$</td>
                                            <td class="px-6 py-2">{{ $factura->lineas[0]->estado }}</td>
                                            <td class="px-6 py-2">{{ $fecha[0] }}</td>

                                                </tr>

                                            @for ($i = 1; $i < count($factura->lineas); $i++)
                                                <tr class="border-b-4 border-red-700">
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->producto->nombre }}</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->cantidad }}</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->producto->precio * $factura->lineas[$i]->cantidad }}$</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->estado }}</td>
                                                    <td></td>


                                                </tr>
                                            @endfor
                                        @endif
                                    @endif


                                @endif

                            @endforeach
                        @endforeach

                        {{-- <script>



                            function miFunc() {
                                console.log("hola");
                            }


                        </script> --}}



                    </tbody>
                            </table>




                        </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
