<x-guest-layout>

    <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-sm text-gray-400">
        Vous avez oublié votre mot de passe ? Pas de soucis, renseignez simplement votre adresse email de connexion et nous vous enverrons un lien de réinitialisation de votre mot de passe.
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

                <div class="flex justify-end mt-6">
                    <x-ui.primary-button class="btn-sm text-xs">
                        Envoyer le lien de réinitialisation
                    </x-ui.primary-button>
                </div>
            </form>
        </div>
    </div>


</x-guest-layout>
