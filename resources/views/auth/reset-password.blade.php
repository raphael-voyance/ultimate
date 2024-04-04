<x-guest-layout>
    <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">

        <div class="mb-4 text-sm text-gray-400">
            Pour réinitialiser votre mot de passe, remplissez le formulaire suivant :
            </div>

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('password.email') }}" class="w-full">
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
                        <x-ui.form.input id="password" class="block w-full focus:ring-primary-focus" type="password" name="password" required autofocus autocomplete="new-password" label="Votre nouveau mot de passe de connexion" placeholder="******" icon="o-key" />
                        <x-ui.form.input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-ui.form.input id="password_confirmation" class="block w-full focus:ring-primary-focus" type="password" name="password_confirmation" required autofocus autocomplete="new-password" label="Confirmez votre mot de passe" placeholder="******" icon="o-key" />
                        <x-ui.form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-ui.primary-button class="btn-sm text-xs">
                            Réinitialiser le mot de passe
                        </x-ui.primary-button>
                    </div>
                </form>
            </div>
        </div>
</x-guest-layout>
