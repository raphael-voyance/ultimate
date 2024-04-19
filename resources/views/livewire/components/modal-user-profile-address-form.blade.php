<div>
    <x-modal wire:model="ModalUserProfileAddressForm" title="Votre adresse" subtitle="Gestion de votre adresse" separator>
        
        {{-- Loader --}}
        <div class="relative" wire:loading>
            <x-ui.loader :loadingText="false" :overlay="false" />
        </div>
        {{-- Fin Loader --}}

        <div>Pour ajouter ou modifier votre adresse, enregistrez le formulaire suivant :</div>
    
        <form class="">

            <div class="mt-4 grid grid-cols-3 gap-3">

                <div>
                    <x-ui.form.input id="number_of_way" wire:model="number_of_way" type="text" name="number_of_way" :value="old('number_of_way') ? old('number_of_way') : $number_of_way"
                    required label="N° de voie"
                    placeholder="N°" />
                <x-ui.form.input-error :messages="$errors->get('number_of_way')" class="mt-2" />
                </div>
                <div>
                    <x-ui.form.input id="type_of_way" wire:model="type_of_way" type="text" name="type_of_way" :value="old('type_of_way') ? old('type_of_way') : $type_of_way"
                    required label="Type de voie"
                    placeholder="rue" />
                <x-ui.form.input-error :messages="$errors->get('type_of_way')" class="mt-2" />
                </div>
                <div>
                    <x-ui.form.input id="name_of_way" wire:model="name_of_way" type="text" name="name_of_way" :value="old('name_of_way') ? old('name_of_way') : $name_of_way"
                    required label="Nom de voie"
                    placeholder="Nom de voie" />
                <x-ui.form.input-error :messages="$errors->get('name_of_way')" class="mt-2" />
                </div>

                <div>
                    <x-ui.form.input id="postal_code" wire:model="postal_code" type="text" name="postal_code" :value="old('postal_code') ? old('postal_code') : $postal_code"
                    required label="Code postal"
                    placeholder="10000" />
                <x-ui.form.input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>
                <div>
                    <x-ui.form.input id="city" wire:model="city" type="text" name="city" :value="old('city') ? old('city') : $city"
                    required label="Ville"
                    placeholder="Ville" />
                <x-ui.form.input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <x-ui.form.input id="country" wire:model="country" type="text" name="country" :value="old('country') ? old('country') : $country"
                    required label="Pays"
                    placeholder="Pays" />
                <x-ui.form.input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

            </div>

        <x-slot:actions>
            <x-button label="Annuler" @click="$wire.ModalUserProfileAddressForm = false" />
            <x-button @click="$wire.ProfileAddressFormSubmit()" label="Enregistrer" class="btn-primary" />
        </x-slot:actions>
        </form>

    </x-modal>
    
    <button @click="$wire.ModalUserProfileAddressForm = true" class="btn btn-sm btn-accent">{{ $btnText }}</button>
</div>
