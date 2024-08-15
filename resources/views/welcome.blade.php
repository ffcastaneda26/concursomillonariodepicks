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
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen selection:text-white bg-no-repeat bg-cover bg-center sm:bg-auto"
    style="background-image: url('{{ asset('images/portada.png') }}');">
        @include('welcome_encabezado')
    </div>

    <section class="h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="max-w-4xl text-center px-4 text-white">
            <h1 class="font-bold mb-4 text-4xl md:text-5xl" style="font-weight: 600; letter-spacing: 5.5px; line-height: 1.2; text-transform: uppercase;">
                Más de 100 mil pesos en premios
            </h1>
            <p class="text-xl md:text-3xl leading-relaxed mb-6">
                ¿Te gusta la NFL? ¿Eres bueno pronosticando resultados? Entonces este concurso es para ti.
            </p>
            <p class="text-xl md:text-3xl leading-relaxed">
                Escoge <strong>5 picks contra el spread</strong> cada semana. Gana <strong> un punto por cada acierto. </strong> Quien acumule más aciertos en toda la temporada es el ganador.
            </p>
        </div>
    </section>

    <section class="h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="max-w-2xl text-center px-4 text-white">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Bases del Concurso:</h2>
            <p class="text-2xl md:text-3xl leading-relaxed text-left  mt-2 mb-4">Premios Acumulados</p>
            <ul class="list-none space-y-4 text-left text-lg md:text-2xl ml-24">
                <li><strong>1er lugar 🏆: 20,000 MXN</strong></li>
                <li><strong>2do lugar🥈: 10,000 MXN</strong></li>
                <li><strong>3er lugar🥉: 5,000 MXN</strong></li>
                <li><strong>4to lugar 💵: 3,000 MXN</strong></li>
                <li><strong>5to lugar: 1,500 MXN</strong></li>
                <li><strong>6to lugar: 1,000 MXN</strong></li>
                <li><strong>7to lugar: 1,000 MXN</strong></li>
            </ul>
            <p class="text-lg md:text-xl mt-6"><strong>Último lugar del concurso 🤡: 3,000 MXN.</strong> Para ser elegible para este premio tienes que mandar picks al menos 16 de las 18 semanas, si dejas de mandar estás fuera.</p>
            <p class="text-lg md:text-xl mt-6">Además se repartirán <strong>3 premios extras de 1,000 MXN</strong> al azar a aquellas personas que terminen fuera de la zona de premios, pero que hayan participado en al menos 16 de las 18 semanas.<sup class="text-sm">1</sup></p>
        </div>
    </section>

    <section class="h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center" style="background-image: url('{{ asset('images/fondo.png') }}');">
        <div class="max-w-4xl text-center px-4 text-white">
            <p class="text-2xl md:text-3xl leading-relaxed mb-4">SEMANAS DE DESCANSO</p>
            <p class="text-lg md:text-xl leading-relaxed">Para limitar el daño de una mala semana, este año eliminaremos tus dos peores puntajes semanales de la tabla final. Esto significa que solo sumaremos 16 semanas al ranking.</p>
            <p class="text-lg md:text-xl leading-relaxed mt-6">Si una semana se te olvidó mandar tus picks, tuviste una situación personal que te mantuvo ocupado o simplemente te fuiste 0 de 5, no te preocupes, tienes otra oportunidad para recuperarte.</p>
            <p class="text-2xl md:text-3xl leading-relaxed mt-8">¿Cómo participar?</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Si eres de México regístrate en <a class="underline" href="https://bit.ly/3M74UY4">https://bit.ly/3M74UY4</a> y haz una apuesta de 300 pesos MXN en el deporte que quieras. Envíanos la captura de pantalla a <a class="underline" href="mailto:nacionapuestas@gmail.com">nacionapuestas@gmail.com</a> y listo, ¡estás dentro!</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Si eres de El Salvador, Honduras, Guatemala, Nicaragua, Panamá, Belice, Costa Rica, Rep. Dominicana, Ecuador, Bolivia, Perú, Chile o Uruguay regístrate en <a class="underline" href="https://bit.ly/3Ycs7xt">https://bit.ly/3Ycs7xt</a> y haz una apuesta de 17 USD / equivalente en moneda local, envíanos la captura de pantalla a nacionapuestas@gmail.com y listo, ¡estás dentro!</p>
            <p class="text-lg md:text-xl leading-relaxed mt-4">Consulta la convocatoria completa en: <a class="underline" href="https://bit.ly/concursodepicksnacion">https://bit.ly/concursodepicksnacion</a></p>
        </div>
    </section>

</body>
</html>
