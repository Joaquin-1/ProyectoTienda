
<div class="py-12">
    {{-- Meter las categorias desde livewire --}}
    <div class="flex flex-wrap justify-center items-center max-w-screen-xl mx-auto mb-12">
        <select name="categoriaSelect" id="categoriaSelect" wire:model="categoriaSelect" class="w-full md:w-3/4 lg:w-auto mb-3 lg:mb-0 mx-2 lg:mr-64">
            <option value="All" selected>Todas</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
            @endforeach
        </select>

        <select name="ordenarSelect" id="ordenarSelect" wire:model="ordenarSelect" class="w-full md:w-3/4 lg:w-auto mx-2 lg:ml-64">
            <option value="Precio descendente" selected>Precio Descendente</option>
            <option value="Precio ascendente">Precio Ascendente</option>
        </select>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-[#B99A66] border-b border-gray-200">
                <x-plantilla>

                    @php
                        $user = Auth::user();
                        $username = $user->name;
                    @endphp

                    <script>

                        var nombreCookie = 'Nombre';
                        var valorCookie = @json($username);

                        // Mira si la cookie existe
                        if (document.cookie.indexOf(nombreCookie) === -1) {
                            // Ventana Modal
                            var modalHtml = `
                                <div id="cookieModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                        </div>

                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                                    Aviso de cookies
                                                </h3>
                                                <div class="mt-2">
                                                    <p>
                                                        Este sitio web utiliza cookies. ¿Aceptar cookies?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="button" id="aceptar" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Sí
                                                </button>
                                                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                                onclick="closeModal()">
                                                    No
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                            // Añades la ventana modal, el beforeend se situa justo dentro del elemento, después de su último hijo.
                            document.body.insertAdjacentHTML('beforeend', modalHtml);

                            // Pilla el id principal del modal que por defecto esta oculto.
                            document.getElementById('cookieModal').classList.remove('hidden');

                            // El boton (Si) tiene el id "aceptar" para llamarlo aqui y hacer la funcion si se hace click
                            document.getElementById('aceptar').addEventListener('click', function() {
                                //Se crea la variable para que dure 15 minutos.
                                var duracionMinutos = 15;
                                //Fecha actual
                                var fechaExpiracion = new Date();
                                //Modifica la fecha actual sumandole los 15 de antes y multiplicandolo por 60 segundos y 1000 miliseg.
                                fechaExpiracion.setTime(fechaExpiracion.getTime() + duracionMinutos * 60 * 1000);
                                //Creamos el expire de la cookie cambiando el formato de la fecha.
                                var formatoFecha = "expires=" + fechaExpiracion.toUTCString();
                                //Metemos todos los datos anteriores en la variablle cookie
                                var cookieString = nombreCookie + "=" + valorCookie + ";" + formatoFecha + ";path=/";
                                //Creamos la cookie
                                document.cookie = cookieString;
                                console.log("Cookie aceptada y establecida:", document.cookie);

                                // Cerramos el modal
                                closeModal();
                            });

                            // Función asociada al boton (No) para que oculte la ventana si se niegan las cookies.
                            function closeModal() {
                                document.getElementById('cookieModal').classList.add('hidden');
                            }
                        }

                    </script>


                <div x-data="{ searchTerm: '' }">
                    <input type="text" x-model="searchTerm" placeholder="Buscar productos..." class="lg:ml-0 sm:ml-12 my-4 px-2 py-1 border border-gray-300 rounded">

                    <table class="table-auto bg-white">
                        <tbody>
                            @foreach ($productos as $producto)

                                @if ($producto->estado && Auth::user()->rol == "cliente")

                                    <tr class="border-2 border-grey-700" x-show="productoMatches('{{ $producto->nombre }}', $data.searchTerm)">


                                            @php
                                            $vermas = false;
                                                $desCorta = substr($producto->descripcion, 0, 70);
                                                if (strlen($producto->descripcion) > 70) {
                                                    $desCorta = $desCorta . '...';
                                                    $vermas = true;
                                                }
                                                else {
                                                    $vermas = false;
                                                }
                                            @endphp

                                        <td class="px-4 py-2"><a href="{{route('producto', $producto)}}"> <img class="hidden lg:block h-60 w-auto" src="{{ URL($producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                                        <td class="px-4 py-2 w-96"><a href="{{route('producto', $producto)}}"><p class="text-3xl mb-4 ">{{ $producto->nombre }}</p>{{ $desCorta }}
                                        @if ($vermas)
                                            <a class="font-bold hover:text-orange-700" href="{{route('producto', $producto)}}"> More </a>
                                        @endif
                                        </td>

                                        <td class="px-4 py-2">{{ $producto->precio }} &euro;</td>
                                        <td class="px-4 py-2">{{ $producto->categoria->nombre }}</td>





                                        <td class="px-4 py-2 sm:px-6 md:px-8 lg:px-10 xl:px-12">
                                            @if (Auth::user()->rol == "cliente")
                                            <div class="text-sm text-gray-900 ">
                                                <form action="{{ route('anadiralcarrito', $producto) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="px-4 py-1 text-sm text-white bg-orange-500 rounded">Añadir al carrito</button>
                                                </form>
                                            </div>
                                            @endif

                                        </td>
                                    </tr>
                                @elseif (Auth::user()->rol == "admin")

                                    <tr class="border-2 border-grey-700" x-show="productoMatches('{{ $producto->nombre }}', $data.searchTerm)">

                                        @php
                                            $vermas = false;
                                                $desCorta = substr($producto->descripcion, 0, 70);
                                                if (strlen($producto->descripcion) > 70) {
                                                    $desCorta = $desCorta . '...';
                                                    $vermas = true;
                                                }
                                                else {
                                                    $vermas = false;
                                                }
                                        @endphp

                                        <td class="px-4 py-2"><a href="{{route('producto', $producto)}}"> <img class="hidden lg:block h-60 w-auto" src="{{ URL($producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                                        <td class="px-4 py-2 w-96"><a href="{{route('producto', $producto)}}"><p class="text-3xl mb-4 ">{{ $producto->nombre }}</p>{{ $desCorta }}
                                        @if ($vermas)
                                            <a class="font-bold hover:text-orange-700" href="{{route('producto', $producto)}}"> More </a>
                                        @endif
                                        </td>

                                        <td class="px-4 py-2">{{ $producto->precio }} &euro;</td>
                                        <td class="px-4 py-2">{{ $producto->categoria->nombre }}</td>


                                        <td class="px-4 py-2 sm:px-6 md:px-8 lg:px-10 xl:px-12">
                                            @if (Auth::user()->rol == "admin")
                                                <div class="flex flex-col items-center space-y-2">

                                                    <a href="/productos/{{ $producto->id }}/edit"
                                                        class="px-4 py-1 text-sm text-white bg-blue-600 rounded">Editar</a>


                                                    <a href="/productos/{{ $producto->id }}/anadirImagen"
                                                        class="px-4 py-1 text-sm text-white bg-green-600 rounded">AñadirImagen</a>

                                                    {{-- Abre la ventana modal llamando a la funcion confirmDelete --}}
                                                    <button class="px-4 py-1 text-sm text-white bg-red-600 rounded" onclick="confirmDelete({{ $producto->id }})">
                                                        Borrar
                                                    </button>

                                                    <form action="{{ route('productos.cambiar-estado', ['producto' => $producto->id]) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button id="botonEstado" onclick="return confirm('¿Seguro? Cambiaras el estado de esta película')"
                                                        class="mt-8 px-4 py-1 text-sm text-white @if($producto->estado) bg-green-500 @else bg-red-500 @endif rounded" type="submit">Cambiar Estado</button>
                                                    </form>

                                                    @if( $producto->estado)

                                                        <p class="text-green-500">El producto esta visible</p>
                                                    @else
                                                        <p class="text-red-500">El producto no esta visible</p>
                                                    @endif

                                                </div>
                                            @endif

                                        </td>

                                    </tr>
                                @endif

                               {{--  @endif --}}
                            @endforeach
                            @if (Auth::user()->rol == "admin")

                            <a href="/productos/create" class="ml-12 lg:ml-48 my-4 text-black hover:underline text-xl">Insertar un nuevo producto</a>
                            @endif

                        </tbody>
                    </table>

                    <script>
                        function productoMatches(nombre, searchTerm) {

                            return searchTerm === '' || nombre.toLowerCase().includes(searchTerm.toLowerCase());
                        }
                    </script>



                </div>

                    {{-- Ventana modal para borrar el produucto  --}}
                    <div id="confirmModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <div class="modal-container max-w-md mx-auto bg-white rounded shadow-lg overflow-hidden z-50">
                            <div class="modal-content text-left">
                                <div class="modal-header bg-gray-800 text-white p-4">
                                    <h3 class="text-lg font-semibold">Confirmación</h3>
                                </div>
                                <div class="modal-body p-4">
                                    <p>¿Seguro? Borrarás todos los datos de esta película</p>
                                </div>
                                <div class="modal-footer p-4 flex justify-end">
                                    <button class="px-4 py-2 mr-2 text-white bg-gray-500 rounded" onclick="closeModal()">Cancelar</button>
                                    @isset($producto)
                                    <form action="/productos/{{ $producto->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 text-white bg-red-600 rounded" type="submit">Borrar</button>

                                    </form>
                                    @endisset

                                </div>
                            </div>
                        </div>
                    </div>



                    <script>

                        // Funcion que abre la ventana modal

                        function confirmDelete(productoId) {
                            const modal = document.getElementById('confirmModal');
                            modal.classList.remove('hidden');

                            console.log(productoId);

                            var form = document.querySelector('#confirmModal form');
                            form.action = ("/productos/" + productoId );

                        }

                        // Funcion que cierra la ventana si cancelas

                        function closeModal() {
                            const modal = document.getElementById('confirmModal');
                            modal.classList.add('hidden');

                            var form = document.querySelector('#confirmModal form');
                            form.action = "";
                        }
                    </script>





                    {{ $productos->links() }}





                </x-plantilla>
            </div>
        </div>
    </div>
</div>
