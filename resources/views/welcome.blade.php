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
            background-image: url('{{ asset('images/fondo.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            width: 100vw;
        }
        @media (max-width: 768px) and (orientation: landscape) {
            h1, h2, p {
                font-size: 90%; /* Reduce el tamaño de la fuente */
                line-height: 1.2; /* Ajusta el espaciado */
            }
            ul {
                margin-left: 1rem; /* Ajusta los márgenes del listado */
            }
            .section-class {
                padding-left: 10px;
                padding-right: 10px;
            }
            p {
                word-break: break-word;
                overflow-wrap: break-word;
            }
        }
        .no-button .fixed {
            display: none;
        }

        /* Oculta la sección por defecto */
.only-mobile-landscape {
    display: none;
}

/* Muestra la sección en móviles (pantallas pequeñas) */
@media (max-width: 768px) {
    .only-mobile-landscape {
        display: block;
    }
}

/* Muestra la sección cuando el dispositivo esté en modo horizontal (cualquier pantalla) */
@media (max-width: 1024px) and (orientation: landscape) {
    .only-mobile-landscape {
        display: block;
    }
}
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen selection:text-white bg-no-repeat bg-cover bg-center sm:bg-auto"
    style="background-image: url('{{ asset('images/portada.png') }}');">
        @include('welcome_navigation')
    </div>

    {{-- ¿Que es el concurso? --}}
    @include(' concurso_que_es')

    {{-- Solo Espacios --}}
    <section class="only-mobile-landscape" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="text-center px-4 text-white">
            <h2 class="text-4xl font-bold mb-4">&nbsp;&nbsp;</h2>
            <p class="text-xl">&nbsp;</p>
        </div>
    </section>

    {{-- Bases --}}
    @include('concurso_bases')

    {{-- Solo Espacios --}}
    <section class="only-mobile-landscape" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="text-center px-8 text-white">
            <h2 class="text-4xl font-bold mb-8">&nbsp;</h2>
            <p class="text-xl">&nbsp;</p>
        </div>
    </section>

    {{-- Semanas de Descanso --}}
    @include('concurso_semanas_descanso')


    {{-- Cómo participar --}}
    <section id="como-participar"  class="h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="max-w-4xl text-center px-4 text-white">
            <p class="text-2xl md:text-3xl leading-relaxed mt-8">¿Cómo participar?</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Si eres de México regístrate en <a class="underline" href="https://bit.ly/3M74UY4">https://bit.ly/3M74UY4</a> y haz una apuesta de 300 pesos MXN en el deporte que quieras. Envíanos la captura de pantalla a <a class="underline" href="mailto:nacionapuestas@gmail.com">nacionapuestas@gmail.com</a> y listo, ¡estás dentro!</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Si eres de El Salvador, Honduras, Guatemala, Nicaragua, Panamá, Belice, Costa Rica, Rep. Dominicana, Ecuador, Bolivia, Perú, Chile o Uruguay regístrate en <a class="underline" href="https://bit.ly/3Ycs7xt">https://bit.ly/3Ycs7xt</a> y haz una apuesta de 17 USD / equivalente en moneda local, envíanos la captura de pantalla a nacionapuestas@gmail.com y listo, ¡estás dentro!</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Consulta la convocatoria completa en: <a class="underline" href="https://bit.ly/concursodepicksnacion">https://bit.ly/concursodepicksnacion</a></p>
        </div>
    </section>

    <a href="#" class="fixed bottom-5 right-10 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Volver al inicio</a>

</body>
</html>
