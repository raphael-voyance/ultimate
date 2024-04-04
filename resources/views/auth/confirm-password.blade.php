<x-guest-layout>
        <div class="relative m-auto  max-w-full w-96 bg-neutral p-4 rounded-lg">
            <div class="mb-4 text-sm text-gray-400">
                Par mesure de sécurité, merci de saisir à nouveau votre mot de passe pour continuer.
            </div>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-ui.form.input id="password" class="block w-full focus:ring-primary-focus" type="password" name="password" :value="old('first_name')" required autofocus autocomplete="current-password" label="Saisissez votre mot de passe" placeholder="******" icon="o-key" />
                    <x-ui.form.input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-ui.primary-button>
                        {{ __('Confirm') }}
                    </x-ui.primary-button>
                </div>
            </form>
        </div>
</x-guest-layout>
