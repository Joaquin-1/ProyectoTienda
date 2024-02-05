<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">

            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-plantilla>
                        <button class="botonUsuario" onclick="cambiarDisplay()"  style="background-color:orange; padding: 8px 6px; border-radius: 10px; margin: 5px 5px 5px 7px"> Datos del usuario </button>
                        <table class="table-auto w-full">
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
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    @foreach ($factura->lineas as $linea)
                                        @if ($linea->estado == 'Completed')


                                        @else
                                            <tr id="tr">
                                                <td class="w-1/6 px-6 py-2"><img class="h-44 w-full hidden lg:block" src="{{ URL($linea->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></td>
                                                <td class="w-1/6 px-6 py-2">{{ $linea->producto->nombre }}</td>
                                                <td class="w-1/6 px-6 py-2">{{ $linea->cantidad }}</td>
                                                <td class="w-1/6 px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                                <td class="w-1/6 px-6 py-2">{{ $linea->estado }}</td>
                                                <td class="w-1/6 ">
                                                    <div class="text-sm text-green-900 ">
                                                        <form action="{{ route('edit', $linea) }}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <select name="estado" id="estado">
                                                                <option  value="Pending to send">Pendiente de envio</option>
                                                                <option value="Product sent">Producto enviado</option>
                                                                <option value="Completed">Completado</option>

                                                                <input type="submit" class="mt-2 mb-6 px-4 py-1 text-sm bg-orange-400 rounded ml-3 cursor-pointer" value="Cambiar estado">
                                                            </select>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $fecha = explode(' ', $linea->created_at)
                                            @endphp
                                            <tr class="datosUsuario" style="display: none;">
                                                <td></td>
                                                <td class="px-3 ">
                                                    <b> Nombre: </b> {{$linea->factura->user->name}}
                                                </td>
                                                <td class="px-3">
                                                    <b> Email: </b> {{$linea->factura->user->email}}
                                                </td>
                                                <td colspan="2" class="px-3">
                                                    <b>Direccion: </b> <br>
                                                    <b> Calle: </b> {{$linea->factura->user->direccion->calle}} <br>
                                                    <b> Ciudad:</b> {{$linea->factura->user->direccion->ciudad}} <br>
                                                    <b> Codigo postal: </b> {{$linea->factura->user->direccion->codigo_postal}} <br>
                                                    <b> Pais: </b>{{$linea->factura->user->direccion->pais}}
                                                </td>
                                                <td  class="px-3">
                                                    <b>Fecha del pedido: </b> {{$fecha[0]}}
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
    <script>
        let boton = document.getElementsByClassName("botonUsuario");
        let datos = document.getElementsByClassName("datosUsuario");

        function cambiarDisplay(){
            for (let i = 0; i < datos.length; i++) {
                if (datos[i].style.display == "none") {
                    datos[i].style = "display:"
                    datos[i].style = "border-width: 2px"

                }
                else{
                    datos[i].style = "display:none"

                }

            }
        }
    </script>
</x-app-layout>
