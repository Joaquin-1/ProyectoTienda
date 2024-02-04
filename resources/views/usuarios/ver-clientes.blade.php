<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Usuarios Registrados') }}
        </h2>
    </x-slot>



    <div class="overflow-x-auto">

        <div x-data="{ searchTerm: '' }">
            <input type="text" x-model="searchTerm" placeholder="Buscar clientes..." class="sm:ml-40 my-4 px-2 py-1 border border-gray-300 rounded">

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b bg-gray-100">ID</th>
                    <th class="py-2 px-4 border-b bg-gray-100">Nombre</th>
                    <th class="py-2 px-4 border-b bg-gray-100">Email</th>
                    <th class="py-2 px-4 border-b bg-gray-100">Teléfono</th>
                    <th class="py-2 px-4 border-b bg-gray-100">Ciudad</th>
                    <th class="py-2 px-4 border-b bg-gray-100">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="border-2 border-grey-700" x-show="clienteMatches('{{ $cliente->name }}', $data.searchTerm)">
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->email }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->telefono }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->ciudad }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <form action="/usuarios/{{ $cliente->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Zona de peligro, borrar este usuario podría influenciar en el resto de la pagina')"
                                        type="submit" class="px-4 py-1 text-sm text-white bg-red-600 rounded">Borrar
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                {{ $clientes->links() }}
            </tbody>
        </table>

        <script>
            function clienteMatches(nombre, searchTerm) {

                return searchTerm === '' || nombre.toLowerCase().includes(searchTerm.toLowerCase());
            }
        </script>


        </div>

    </div>



</x-app-layout>
