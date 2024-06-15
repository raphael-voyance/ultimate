<div>
    <x-mary-modal wire:model="ModalUserProfileContactForm" title="Vos informations de contact" subtitle="Gestion de vos informations de contact" separator>

        {{-- Loader --}}
        <div class="relative" wire:loading>
            <x-ui.loader :loadingText="false" :overlay="false" />
        </div>
        {{-- Fin Loader --}}

        
        <div>Pour ajouter ou modifier vos informations de contact, enregistrez le formulaire suivant :</div>
    
        <form>

        <div class="mt-4">
            <x-ui.form.input id="phone" wire:model="phone" class="block w-full" type="text" name="phone" :value="old('phone') ? old('phone') : $phone"
                required autocomplete="tel" label="Votre numéro de téléphone"
                placeholder="0606060606" icon="o-phone" />
            <x-ui.form.input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-ui.form.input id="email" wire:model="email" class="block w-full" type="email" name="email" :value="old('email') ? old('email') : $email"
                required autocomplete="email" label="Votre adresse email"
                hint="Il s'agit également de l'adresse email utilisée pour vous connecter."
                placeholder="Votre adresse email" icon="o-user" />
            <x-ui.form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-slot:actions>
            <x-mary-button label="Quitter" @click="$wire.ModalUserProfileContactForm = false" class="btn-sm" />
            <x-mary-button label="Enregistrer" @click="$wire.ProfileContactFormSubmit()" class="btn-primary btn-sm" />
        </x-slot:actions>
        </form>
        
    </x-mary-modal>

    <button @click="$wire.ModalUserProfileContactForm = true" class="btn btn-sm btn-accent">{{ $btnText }}</button>

</div>
