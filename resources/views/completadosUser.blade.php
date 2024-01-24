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
                                            <td>
                                                <div class="text-sm text-gray-900">
                                                    <button onclick="miFunc()" class="botonsito bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        Devolucion
                                                    </button>
                                                </div>
                                            </td>
                                                </tr>

                                            @for ($i = 1; $i < count($factura->lineas); $i++)
                                                <tr class="border-b-4 border-[#047857]">
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->producto->nombre }}</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->cantidad }}</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->producto->precio * $factura->lineas[$i]->cantidad }}$</td>
                                                    <td class="px-6 py-2">{{ $factura->lineas[$i]->estado }}</td>


                                                </tr>
                                            @endfor
                                        @endif
                                    @endif


                                @endif

                            @endforeach
                        @endforeach

                        <script>

                            function miFunc() {
                                alert("Hola")
                            }

                            //Obtener todos los botones de devolución por su clase
                            var botonesDevolucion = document.querySelectorAll('.botonsito');

                            //Fecha de creación de la factura
                            var fechaCreacionFactura = Date.parse('{{ $factura->lineas[0]->created_at }}'); // Reemplaza con la fecha real de creación
                            //Calcular la diferencia de días
                            var diferenciaDias = Math.floor((Date.now() - fechaCreacionFactura) / (1000 * 60 * 60 * 24));

                            //alert(diferenciaDias);

                            //Recorre sobre cada botón y mostrar u ocultar según la diferencia de días
                            botonesDevolucion.forEach(function(boton) {
                                if (diferenciaDias <= 15) {
                                    boton.classList.remove('hidden');
                                } else {
                                    boton.classList.add('hidden');
                                }
                            });
                        </script>



                    </tbody>
                            </table>




                        </x-plantilla>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
