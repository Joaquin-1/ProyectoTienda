<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Pedidos') }}
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
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                @foreach ($factura->lineas as $linea)
                                @if ($linea->estado != 'Completed')


                                @else
                                <tr>
                                    <td class="px-6 py-2"><img class="h-44 w-auto" src="{{ URL($linea->producto->imagenes[0]->imagen) }}" alt="imagen del producto"></td>
                                    <td class="px-6 py-2">{{ $linea->producto->nombre }}</td>
                                    <td class="px-6 py-2">{{ $linea->cantidad }}</td>
                                    <td class="px-6 py-2">{{ $linea->producto->precio * $linea->cantidad }}$</td>
                                    <td class="px-6 py-2">{{ $linea->estado }}</td>
                                    <td>
                                        <div class="text-sm text-gray-900 ">
                                            <form action="{{ route('edit', $linea) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <select name="estado" id="estado">
                                                    <option  value="Pending to send">Pending to send</option>
                                                    <option value="Product sent">Product sent</option>
                                                    <option value="Completed">Completed</option>

                                                    <input type="submit" class="px-4 py-1 text-sm text-white bg-red-400 rounded" value="Cambiar estado">
                                                </select>
                                            </form>
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
