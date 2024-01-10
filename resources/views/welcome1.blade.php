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

    <div class="w-full mx-auto bg-[#B99A66] px-4 pt-4 pb-6">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <link rel="icon" href="{{ url('img/logo.png') }}">
                <!-- Logo -->
                <div class="shrink-0 hidden sm:block">
                    <a href="{{ route('productos') }}">
                        <x-application-logo class="block h-10 w-auto fill-current" />
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex space-x-8 text-xl">
                <x-nav-link class="text-[#000]" :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-nav-link>

                <x-nav-link class="text-[#000]" :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
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





    <div class="bg-white h-1/3 w-full flex text-center justify-center my-8 px-8">
        <p> ¿Eres un amante del cine clásico o un seguidor apasionado de las películas contemporáneas? Sea cual sea tu preferencia,
            estamos aquí para satisfacer tu sed de entretenimiento cinematográfico. Explora nuestras ofertas especiales, y colecciones
            temáticas que harán que cada visita a Between Films sea una experiencia única.
        </p>
    </div>
    <div class="w-full flex items-center justify-center mb-4">
        <button class="bg-[#B99A66]"> <a href="{{ route('productos') }}"> ¡Registrate y echa un vistazo al catálogo! </button>

    </div>


        <div class="bg-[#047857] h-auto md:h-1/3 p-4 min-h-full flex flex-col items-center justify-center">
            <h1 class="text-white text-4xl font-bold mb-8">¡Echa un vistazo a las películas!</h1>

            <div class="grid grid-rows-1 grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-3 rounded-md w-full md:w-[400px] h-auto md:h-[600px] overflow-x-auto">
                    <table class="w-full table-auto bg-white">
                        <tbody>
                            <tr class="w-full">
                                <td class="bg-green-500 ">
                                    <p class="text-3xl">Mejores Películas</p>
                                </td>
                            </tr>

                            @php
                            $count = 0;
                            @endphp

                            @foreach ($productos as $producto)

                            @break($count == 3)
                            <tr>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">{{ $producto->nombre }}</p></td>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">{{ $producto->precio }}€</p></td>
                            </tr>

                            <tr>
                                <td class="px-6 py-2 w-full md:w-96 "><a href="{{route('producto', $producto)}}"> <img class="h-60 w-full md:w-auto border-2 border-green-700" src="{{ URL($producto->imagenes[0]->imagen) }}" alt="imagen del producto"></a></td>
                            </tr>

                            @php
                            $count++;
                            @endphp

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="bg-white p-3 rounded-md w-full md:w-[400px] h-auto md:h-[600px] overflow-x-auto mt-4 md:mt-0">
                    <table class="w-full table-auto bg-white">
                        <tbody>
                            <tr class="w-full">
                                <td class="bg-green-500 ">
                                    <p class="text-3xl">Próximas Películas</p>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">Avatar 2</p></td>
                            </tr>

                            <tr>
                                <td class="px-6 py-2 w-full md:w-96 "> <img class="h-60 w-full md:w-auto border-2 border-green-700" src="img/avatar2.jpg" alt="imagen del producto"></td>
                            </tr>

                            <tr>
                                <td class="px-6 py-2 "><p class="text-2xl mb-4 ">La sociedad de la nieve</p></td>
                            </tr>

                            <tr>
                                <td class="px-6 py-2 w-full md:w-96 "> <img class="h-60 w-full md:w-auto border-2 border-green-700" src="img/nieve.jpg" alt="imagen del producto"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    <footer class="bg-[#B99A66] text-white py-8 md:py-16">
        <div class="container mx-auto flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 md:pr-8">
                <div class="flex items-center mb-6">
                    <img class="h-6" src="{{ URL('img/correo.png') }}" alt="">
                    <p class="ml-2">betweenfilms@gmail.com</p>
                </div>
                <div class="flex items-center">
                    <img class="mr-2 w-8 h-8" src="{{ URL('img/youtube.png') }}" alt="youtube">
                    <a href="https://www.youtube.com/@sonypictures/featured" target="_blank" rel="noopener noreferrer">
                        BetweenFilms</a>
                </div>
            </div>
            <div class="md:w-1/2 md:text-right mt-12">
                <p class="text-2xl mb-4">¿Tienes alguna duda?</p>
                <p class="text-xl">
                    <a class="" href="/contactos/create">Contacta con nosotros</a>
                </p>
            </div>
        </div>
        <div class="text-center mt-8 md:mt-12">
            <p class="text-3xl">
                <a class="hover:text-[#B99A66]" href="{{ route('productos') }}">Nuestras Películas</a>
            </p>
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('productos') }}">
                <img class="h-20 w-32 mx-auto" src="{{ URL('img/logo.png') }}" alt="logo">
            </a>
        </div>
    </footer>

</html>
