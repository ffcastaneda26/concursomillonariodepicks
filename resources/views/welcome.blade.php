<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

    <style>
        body {
            background-image: url('{{ asset('images/Fondo.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            /* Ocupa el 100% de la altura de la viewport */
            width: 100vw;
            /* Ocupa el 100% del ancho de la viewport */
        }


    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen  selection:text-white">
        @include('welcome_encabezado')

        <div class="grid h-screen place-items-center w-full">
            @auth
                <a href="{{ url('/dashboard') }}">
                    <img class="rounded-xs" src="{{ asset('images/imagen_portada.png') }}">
                </a>
            @else
                <div class="flex items-center">
                    <a href="{{ route('login') }}"
                        class="focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <img class="w-full" src="{{ asset('images/imagen_portada.png') }}">
                    </a>
                </div>


            @endauth
        </div>
    </div>

    <div class="h-screen flex items-center justify-center">
        <h1 class="text-white text-5xl font-bold">¡Hola, mundo!</h1>
    </div>
</body>

</html>
