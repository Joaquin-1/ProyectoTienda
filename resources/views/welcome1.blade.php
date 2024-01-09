<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=YourCustomFont&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <title>Bienvenid@ a BetweenFilms</title>

    <div class=" w-full mx-auto bg-[#B99A66] px-4 pt-4 pb-6">
        <div class="flex justify-between h-16">
            <div class="flex ml-40">
                <link rel="icon" href="{{ url('img/logo.png') }}">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('productos') }}">
                        <x-application-logo class="block h-10 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex space-x-8 text-xl  ml-36">
                <x-nav-link class="ml-[300px] text-[#000] " :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-nav-link>

                <x-nav-link class="text-[#000]" :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
                </div>
            </div>
        </div>
    </div>

</head>


    <div class="flex items-center">
        <div class="h-96 w-full relative">
            <img src="img/banner.jpg" alt="Imagen" class="w-full h-full object-cover object-top ">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-center">
                <h1 class="text-8xl font-bold">BETWEEN FILMS</h1>

            </div>
        </div>
    </div>



    {{-- <div class="relative bg-gradient-to-b from-blue-500 to-green-500 bg-overlay">
        <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="w-full h-auto">

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-center">
            <h1 class="text-4xl font-bold">¡Bienvenido a mi sitio!</h1>
            <p class="text-lg">Explora y descubre todo lo que tenemos para ofrecer.</p>
        </div>
    </div> --}}




    <div class="bg-white h-1/3 w-full flex text-center justify-center my-8 px-8">
        <p> ¿Eres un amante del cine clásico o un seguidor apasionado de las películas contemporáneas? Sea cual sea tu preferencia,
            estamos aquí para satisfacer tu sed de entretenimiento cinematográfico. Explora nuestras ofertas especiales, y colecciones
            temáticas que harán que cada visita a Between Films sea una experiencia única.
        </p>
    </div>
    <div class="w-full flex items-center justify-center mb-4">
        <button class="bg-[#B99A66]"> <a href="{{ route('productos') }}"> ¡Registrate y echa un vistazo al catálogo! </button>

    </div>
        {{-- <div class="grid grid-cols-5 gap-24">
            <!-- Primer div -->
            <div class="group bg-teal-500 w-64 h-64 rounded-md shadow-md flex flex-col items-center justify-center text-white transition-transform duration-500 transform hover:scale-110 hover:bg-gray-900 hover:text-white">
                <img src="ruta/a/tu/logo1.png" alt="Logo 1" class="mb-2">
                <h2 class="text-2xl font-bold mb-2">+2K CLIENTES</h2>
                <p class="text-center">Cada vez son más los que confían en nosotros.</p>
            </div>
            <!-- Segundo div -->
            <div class="group bg-white w-64 h-64 rounded-md shadow-md flex flex-col items-center justify-center text-black transition-transform duration-500 transform hover:scale-110 hover:bg-gray-900 hover:text-white">
                <img src="ruta/a/tu/logo2.png" alt="Logo 2" class="mb-2">
                <h2 class="text-2xl font-bold mb-2">EXPERIENCIA</h2>
                <p class="text-center">Más de una década en funcionamiento.</p>
            </div>
            <!-- Tercer div -->
            <div class="group bg-teal-500 w-64 h-64 rounded-md shadow-md flex flex-col items-center justify-center text-white transition-transform duration-500 transform hover:scale-110 hover:bg-gray-900 hover:text-white">
                <img src="ruta/a/tu/logo3.png" alt="Logo 3" class="mb-2">
                <h2 class="text-2xl font-bold mb-2">SERVICIOS</h2>
                <p class="text-center">Disfruta de todos nuestros servicios a un precio económico.</p>
            </div>
            <!-- Cuarto div -->
            <div class="group bg-white w-64 h-64 rounded-md shadow-md flex flex-col items-center justify-center text-black transition-transform duration-500 transform hover:scale-110 hover:bg-gray-900 hover:text-white">
                <img src="ruta/a/tu/logo4.png" alt="Logo 4" class="mb-2">
                <h2 class="text-2xl font-bold mb-2">PRODUCTOS</h2>
                <p class="text-center">Elige entre una amplia gama de productos de alta calidad.</p>
            </div>
            <!-- Quinto div -->
            <div class="group bg-teal-500 w-64 h-64 rounded-md shadow-md flex flex-col items-center justify-center text-white transition-transform duration-500 transform hover:scale-110 hover:bg-gray-900 hover:text-white">
                <img src="ruta/a/tu/logo5.png" alt="Logo 5" class="mb-2">
                <h2 class="text-2xl font-bold mb-2">CRECIMIENTO</h2>
                <p class="text-center">Evolucionamos para crecer juntos, adaptándonos a las nuevas necesidades.</p>
            </div>
        </div> --}}


    <div class="bg-[#B99A66] h-1/3 p-4 min-h-full flex flex-col items-center justify-center">
        <h1 class="text-white text-4xl font-bold mb-8">¡Echa un vistazo a las peliculas!</h1>

        <div class="grid grid-rows-1 grid-cols-2 gap-96">
            <div class="bg-white p-3 rounded-md w-[400px] h-[600px] overflow-x-auto" style="">
                <table class=" w-full table-auto bg-white ">
                    <tbody>
                        <tr class="w-full">
                            <td class="px-8 bg-green-500 col-span-full">
                              <p class="text-3xl">Mejores Peliculas</p>
                            </td>
                          </tr>
                        @foreach ($productos as $producto)

                            <tr>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">{{ $producto->nombre }}</p></td>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">{{ $producto->precio }}€</p></td>
                            </tr>

                            <tr >
                                <td class="px-6 py-2 w-96 "><a href="{{route('producto', $producto)}}"> <img class="h-60 w-auto border-2 border-green-700" src="{{ URL($producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="bg-white p-8 rounded-md">
                <!-- Contenido -->
                <!-- ... -->
            </div>

        </div>
    </div>


    <footer class="flex justify-center bg-white   w-full h-96 mt-1">
        <div class="bg-[#4C3F2B] text-white mt-4 w-full h-5/6">
            <div class="bg-[#B99A66] grid grid-rows-3 grid-flow-col gap-4  h-4/5">
                <div class="absolute mt-10 flex ml-28">
                    <img class="h-6" src="{{ URL('img/correo.png') }}" alt="">
                    <p class="ml-2">betweenfilms@gmail.com</p>
                </div>
                <div class="flex mt-24 ml-28 ">
                    <img class=" mr-1 w-8 h-8"
                            src="{{ URL('img/youtube.png') }}" alt="youtube">
                    <a class="mt-1" href="https://www.youtube.com/@sonypictures/featured">
                         BetweenFilms</a>
                </div>
                <div class="col-span-2 row-span-4 text-right mr-36 mt-10">
                    <p class="text-2xl">¿Tienes alguna duda? </p>
                    <p class="text-xl mr-3 mt-2"> <a class="text-black" href="/contactos/create">Contacta</a> con nosotros </p>
                </div>
            </div>
        </div>

        <div class="w-50 h-auto absolute mt-40">
            <a href="{{ route('productos') }}"><img class="h-20 w-32 mt-3 mr-1"
                src="{{ URL('img/logo.png') }}" alt="logo"></a>
        </div>
    </footer>

</html>
