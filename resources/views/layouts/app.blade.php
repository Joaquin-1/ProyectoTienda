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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-[#B99A66] shadow text-center text-4xl text-black">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer class="flex justify-center bg-black   w-full h-96 mt-1">
            <div class="bg-black text-white mt-4 w-full h-5/6">
                <div class="bg-black grid grid-rows-3 grid-flow-col gap-4  h-4/5">
                    <div class="absolute mt-10 flex ml-28">
                        <img class="h-8" src="{{ URL('img/correo.png') }}" alt="">
                        <p class="ml-2 text-2xl">gerardo@rentel.es</p>
                    </div>
                    <div class="flex mt-20 ml-28 col-span-full">
                        <img class="mt-3 mr-1 w-8 h-8"
                                src="{{ URL('img/youtube.png') }}" alt="facebook">
                        <a class="mt-5" href="https://www.youtube.com/channel/UC-t6s_YDUsRrJRGg3CrNxlA">
                             Gerardo Calado</a>
                    </div>
                    <div class="col-span-2 row-span-4 text-right mr-36 mt-10">
                        <p class="text-2xl">Any problem?</p>
                        <p class="text-xl mr-3 mt-2"> <a class="text-orange-500" href="#">Contact</a> with us
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full absolute mt-20">
                <p class="text-center text-3xl"><a class="hover:text-orange-500 text-white" href="{{ route('productos') }}"> Our products</a>
                </p>
            </div>
            <div class="w-50 h-auto absolute mt-36">
                <a href="{{ route('productos') }}"><img style="height: 20%; width: 20%; margin-left:40%" class="mt-3 mr-1"
                    src="{{ URL('img/logo.png') }}" alt="logo"></a>
            </div>
        </footer>
    </body>
</html>
