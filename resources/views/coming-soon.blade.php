<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">

        {{-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/8491f60163.js" crossorigin="anonymous" defer></script>
        @stack('scripts')
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center relative px-4">
            <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center opacity-30"
                style="background-image: url('https://images.unsplash.com/photo-1604093882750-3ed498f3178b');">
            </div>

            <h1 class="text-3xl md:text-5xl text-white font-bold w-2/3 m-8 z-10">Le nouveau site de Raphaël Voyance revient bientôt !</h1>

            <p class="text-white text-xl md:text-2xl w-2/3 mb-8">
                Nous sommes entrain de travailler sur la nouvelle version du site. D'ici peu celui-ci arrivera en ligne !
                Pour contacter Raphaël, vous pouvez lui envoyer un message via le formulaire suivant :
            </p>

            <div class="z-10 w-full p-4 md:w-1/2">

                @if(session('success'))
                <div class="p-4 bg-green-600 text-white mb-6">
                    <p><i class="fa-duotone fa-octagon-check mr-1"></i> {{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('coming_soon.send.email') }}" method="POST">
                    @csrf
                    {{-- <x-honeypot /> --}}

                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <div class="w-full md:w-1/2">
                            <x-ui.form.input-label required for="sender_first_name" value="Votre prénom :" class="block mb-2 text-white" />
                            <x-ui.form.input name="sender_first_name" id="sender_first_name" type='text' placeholder="Prénom" value="{{ old('sender_first_name') }}" class="w-full"/>
                            @error('sender_first_name')
                            <div class="text-white mt-1 text-xs">
                                <p><i class="fa-duotone fa-circle-exclamation text-red-400"></i> Pour envoyer votre message, votre prénom est requis</p>
                            </div>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2">
                            <x-ui.form.input-label for="sender_last_name" value="Votre nom :" class="block mb-2 text-white" />
                            <x-ui.form.input name="sender_last_name" id="sender_last_name" type='text' placeholder="Nom" value="{{ old('sender_last_name') }}" class="w-full" />
                            @error('sender_last_name')
                            <div class="text-white mt-1 text-xs">
                                <p><i class="fa-duotone fa-circle-exclamation text-red-400"></i> Merci de saisir un nom valide. Caractères acceptés : [a-z]</p>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <div class="w-full md:w-1/2">
                            <x-ui.form.input-label for="sender_phone" value="Votre neméro de téléphone :" class="block mb-2 text-white" />
                            <x-ui.form.input name="sender_phone" id="sender_phone" type='text' placeholder="Numéro de téléphone" value="{{ old('sender_phone') }}" class="w-full" />
                            @error('sender_phone')
                            <div class="text-white mt-1 text-xs">
                                <p><i class="fa-duotone fa-circle-exclamation text-red-400"></i> Merci de saisir un numéro de téléphone valide. Caractères acceptés : [0-9-+]</p>
                            </div>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2">
                            <x-ui.form.input-label required for="sender_email" value="Votre adresse email :" class="block mb-2 text-white" />
                            <x-ui.form.input name="sender_email" id="sender_email" type='email' placeholder="Email" value="{{ old('sender_email') }}" class="w-full" />
                            @error('sender_email')
                            <div class="text-white mt-1 text-xs">
                                <p><i class="fa-duotone fa-circle-exclamation text-red-400"></i> Pour envoyer votre message, votre adresse email est requise</p>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full mb-6">
                        <x-ui.form.input-label required for="content" value="Votre message :" class="block mb-2 text-white" />
                        <x-ui.form.textarea rows="5" name="content" id="content" placeholder="Message" class="w-full resize-none">{{ old('content') }}</x-ui.form.textarea>
                        @error('content')
                            <div class="text-white mt-1 text-xs">
                                <p><i class="fa-duotone fa-circle-exclamation text-red-400"></i> Merci de saisir un message</p>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <x-ui.primary-button>Envoyer</x-ui.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
