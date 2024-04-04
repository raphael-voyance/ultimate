<!DOCTYPE html>
<html data-theme="base_theme" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Raphaël Voyance') }}</title>
        <meta name="description" content="">

        {{-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;700&family=Marcellus&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/8491f60163.js" crossorigin="anonymous" defer></script>

        {{-- Flatpickr  --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
        <script>
            flatpickr.localize(flatpickr.l10ns.fr);
        </script>

        @yield('css')
    </head>

    <body class="min-h-screen font-serif antialiased">
            <!--[if lt IE 8]>
            <p class="browserupgrade">Vous utilisez un <strong>ancien</strong> navigateur, votre expérience utilisateur risque d'en être altéré. S'il vous plait, <a href="http://browsehappy.com/">mettez à jour votre navigateur</a> afin d'améliorer votre expèrience.</p>
        <![endif]-->
    <!-- Début Toasts -->
    <livewire:toasts />
    <!-- Fin Toasts -->

    <!-- Début Header Site -->

    <x-structure.sub-header />

    @include('layouts.structure.header')
    <!-- Fin Header Site -->

    <!-- Début Main content -->
    <x-structure.main-content class="bg-base-100" full-width>

        @if (Session::has('success'))
            <x-ui.status type="success" message="{{ Session::get('success') }}" />
        @endif
        @if (Session::has('status'))
            <x-ui.status type="info" message="{{ Session::get('status') }}" />
        @endif

        <!-- Page content -->
        <x-slot:content>
            <!-- Début Page Heading -->
            @if (isset($header))
            <header class="w-full max-w-6xl mx-auto mb-6 bg-neutral text-neutral-100 shadow-md rounded-md sm:px-6 lg:px-8">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif
            <!-- Fin Page Heading -->

            <!-- Début Page Content -->
            <div class="w-full max-w-6xl py-8 px-4 m-auto text-neutral-100 rounded-md sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
            <!-- Fin Page Content -->

        </x-slot:content>
    </x-structure.main-content>
    <!-- Fin Main content -->

    <!-- Début Footer -->
<x-structure.footer />
<!-- Fin Footer -->

<!-- Début Overlay LoadingPage -->
<div
    id="overlay_loadingpage"
    class="fixed top-0 bottom-0 left-0 right-0 min-h-screen z-50 bg-neutral-800 opacity-100 transition-all duration-500 ease-in-out">
</div>
<!-- Fin Overlay LoadingPage -->


        @livewireScriptConfig

        {{-- <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script> --}}
        @yield('js')
    </body>
</html>
