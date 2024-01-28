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
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
        {{-- <script src="{{ asset('js/alpine.js') }}" defer></script> --}}

        @livewireStyles
    </head>
    <body class="font-sans antialiased">



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

        @livewireScripts
    </body>
</html>
