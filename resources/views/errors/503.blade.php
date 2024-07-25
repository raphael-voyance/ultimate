<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Raphaël Voyance') }}</title>
        <meta name="description" content="">

        {{-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
        <script src="https://kit.fontawesome.com/8491f60163.js" crossorigin="anonymous" defer></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center relative px-4">
            <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1604093882750-3ed498f3178b');">
            </div>

            <h1 class="text-3xl md:text-5xl text-white font-bold w-2/3 m-8 z-10">Le nouveau site de Raphaël revient bientôt !</h1>

            <p class="text-white text-xl md:text-2xl w-2/3 mb-8">
                Nous sommes entrain de travailler sur la nouvelle version du site. D'ici peu celui-ci reviendra en ligne !
                Pour contacter Raphaël, vous pouvez lui envoyer un message via WhatsApp :
            </p>
            <div class="relative">
                <a class="btn text-white hover:text-white bg-[#25D366] hover:bg-primary" href="https://wa.me/33766267547">
                    <i class="fa-brands fa-whatsapp fa-2xl"></i> Ouvrir WhatsApp
                </a>
            </div>
        </div>
    </body>
</html>