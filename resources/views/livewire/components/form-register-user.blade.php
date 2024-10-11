<div x-data="{ show: 'login' }">
    {{-- Début Formulaire de Connexion --}}
    <template x-if="show == 'login'">
        <div>
            <!-- Session Status -->
            @if (session('error'))
                <div class="alert alert-error mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form>
                @csrf

                <!-- Email Address -->
                <div>
                    <x-ui.form.input wire:model="email" class="block w-full" type="email"
                        name="email" :value="old('email')" required autocomplete="email"
                        label="Votre adresse email de connexion " placeholder="Votre adresse email"
                        icon="o-user" />
                    @error('email')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-ui.form.input wire:model="password"
                        class="block w-full focus:ring-primary-focus" type="password"
                        name="password" required autocomplete="current-password"
                        label="Votre mot de passe de connexion " placeholder="******"
                        icon="o-key" />
                    @error('password')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <x-mary-checkbox wire:model="remember" name="remember"
                            label="Se souvenir de moi"
                            class="focus:ring-primary-focus  checkbox-sm" />
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                            href="{{ route('password.request') }}">
                            Mot de passe oublié
                        </a>
                    @endif

                    <x-ui.primary-button class="ml-3 btn-sm" wire:click.prevent='userLogin()'>
                        {{ __('Login') }}
                    </x-ui.primary-button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <a class="inline-block opacity-50 px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                    href="#" @click.prevent="show = 'register'">
                    Pas encore inscrit ?
                </a>
            </div>

        </div>
    </template>
    {{-- Fin Formulaire de Connexion --}}
    {{-- Début Formulaire d'inscription --}}
    <template x-if="show == 'register'">
        <div>
            <form>
                @csrf

                <!-- FirstName -->
                <div>
                    <x-ui.form.input wire:model="first_name"
                        class="block w-full focus:ring-primary-focus" type="text"
                        name="first_name" :value="old('first_name')" required autofocus
                        autocomplete="given-name" label="Votre prénom" placeholder="Votre prénom"
                        icon="o-user" />
                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <!-- LastName -->
                <div class="mt-4">
                    <x-ui.form.input wire:model="last_name"
                        class="block w-full focus:ring-primary-focus" type="text"
                        name="last_name" :value="old('last_name')" required autofocus
                        autocomplete="family-name" label="Votre nom" placeholder="Votre nom"
                        icon="o-user" />
                    <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-ui.form.input wire:model="email"
                        class="block w-full focus:ring-primary-focus" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="email"
                        label="Votre adresse email de connexion" placeholder="Votre adresse email"
                        icon="o-user" />
                    <x-ui.form.input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-ui.form.input wire:model="password"
                        class="block w-full focus:ring-primary-focus" type="password"
                        name="password" required autofocus autocomplete="new-password"
                        label="Votre mot de passe de connexion" placeholder="******"
                        icon="o-key" />
                    <x-ui.form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-ui.form.input wire:model="password_confirmation"
                        class="block w-full focus:ring-primary-focus" type="password"
                        name="password_confirmation" required autofocus
                        autocomplete="new-password" label="Confirmez votre mot de passe"
                        placeholder="******" icon="o-key" />
                    <x-ui.form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                        href="#" @click.prevent="show = 'login'">
                        Déjà inscrit ?
                    </a>

                    <x-ui.primary-button class="ml-3 btn-sm" wire:click.prevent='registerUser()'>
                        {{ __('Register') }}
                    </x-ui.primary-button>
                </div>
            </form>
        </div>

    </template>
    {{-- Fin Formulaire d'inscription --}}
</div>

