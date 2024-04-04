<x-guest-layout>


    <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-ui.form.input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="email" label="Votre adresse email de connexion"
                    placeholder="Votre adresse email" icon="o-user" />
                <x-ui.form.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">


                <x-ui.form.input id="password" class="block w-full focus:ring-primary-focus" type="password"
                    name="password" required autofocus autocomplete="current-password"
                    label="Votre mot de passe de connexion" placeholder="******" icon="o-key" />
                <x-ui.form.input-error :messages="$errors->get('password')" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <x-checkbox id="remember" name="remember" label="Se souvenir de moi"
                        class="focus:ring-primary-focus  checkbox-sm" />
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                        href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <x-ui.primary-button class="ml-3 btn-sm">
                    Se connecter
                </x-ui.primary-button>
            </div>
        </form>
        <a class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-50 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
            href="{{ route('register') }}">
            Pas encore inscrit ?
        </a>
    </div>


</x-guest-layout>
