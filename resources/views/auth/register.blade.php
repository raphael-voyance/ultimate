<x-guest-layout>

        <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- FirstName -->
        <div>
            <x-ui.form.input id="first_name" class="block w-full focus:ring-primary-focus" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" label="Votre prénom" placeholder="Votre prénom" icon="o-user" />
            <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- LastName -->
        <div class="mt-4">
            <x-ui.form.input id="last_name" class="block w-full focus:ring-primary-focus" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="family-name" label="Votre nom" placeholder="Votre nom" icon="o-user" />
            <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        
        <!-- Gender -->
        <div class="mt-4">
            <label class="label font-semibold block mb-2">Votre genre :</label>
            <div class="flex items-center gap-4">
                <!-- Option Homme -->
                <label for="gender-m" class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" id="gender-m" name="sexe" value="M" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" checked="checked" />
                    <span class="label-text">Homme</span>
                </label>
                <!-- Option Femme -->
                <label for="gender-f" class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" id="gender-f" name="sexe" value="F" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" />
                    <span class="label-text">Femme</span>
                </label>
                <!-- Option Non-Binaire -->
                <label for="gender-nb" class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" id="gender-nb" name="sexe" value="NB" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" />
                    <span class="label-text">Non-binaire</span>
                </label>
            </div>
            <x-ui.form.input-error :messages="$errors->get('sexe')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-ui.form.input id="email" class="block w-full focus:ring-primary-focus" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" label="Votre adresse email de connexion" placeholder="Votre adresse email" icon="o-user" />
            <x-ui.form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.form.input id="password" class="block w-full focus:ring-primary-focus" type="password" name="password" required autofocus autocomplete="new-password" label="Votre mot de passe de connexion" placeholder="******" icon="o-key" />
            <x-ui.form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.form.input id="password_confirmation" class="block w-full focus:ring-primary-focus" type="password" name="password_confirmation" required autofocus autocomplete="new-password" label="Confirmez votre mot de passe" placeholder="******" icon="o-key" />
            <x-ui.form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-ui.primary-button class="ml-3 btn-sm">
                {{ __('Register') }}
            </x-ui.primary-button>
        </div>
    </form>
        </div>

</x-guest-layout>
