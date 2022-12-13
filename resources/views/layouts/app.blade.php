<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="shortcut icon" type="image/png" href="{{ asset('/img/logo.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/favicon_192x192.png') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <livewire:counter />

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading/Catalogo -->
            <header class="bg-[#B99A66] shadow text-center text-4xl text-black">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content/Productos -->
            <main>
                {{ $slot }}
            </main>
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
                        <p class="text-xl mr-3 mt-2"> <a class="text-black hover:text-[#4C3F2B]" href="/contactos/create">Contacta</a> con nosotros </p>
                    </div>
                </div>
            </div>
            <div class="w-full absolute mt-28">
                <p class="text-center text-3xl"><a class="hover:text-[#4C3F2B] text-white" href="{{ route('productos') }}"> Nuestras Películas</a>
                </p>
            </div>
            <div class="w-50 h-auto absolute mt-40">
                <a href="{{ route('productos') }}"><img class="h-20 w-32 mt-3 mr-1"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
            </div>
        </footer>
        @livewireScripts
    </body>
</html>
