<div>
    <button @click.prevent="$wire.ModalCreateUser = true" class="btn btn-sm btn-warning">
        <i class="fal fa-user-plus"></i> Créer un consultant
    </button>

    <x-ui.dialog wire:model="ModalCreateUser" title="Créer un utilisateur" class="text-left">

        {{-- Loader --}}
        <div class="relative" wire:loading>
            <x-ui.loader :loadingText="false" :overlay="false" />
        </div>
        {{-- Fin Loader --}}


        <div>
            <!-- FirstName -->
            <div>
                <x-ui.form.input wire:model="first_name"
                    class="block w-full focus:ring-primary-focus" type="text"
                    name="first_name" :value="old('first_name')" required autofocus
                    autocomplete="first_name" label="Prénom" placeholder="Prénom"
                    icon="o-user" />
                <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- LastName -->
            <div class="mt-4">
                <x-ui.form.input wire:model="last_name"
                    class="block w-full focus:ring-primary-focus" type="text"
                    name="last_name" :value="old('last_name')" required autofocus
                    autocomplete="last_name" label="Nom" placeholder="Nom"
                    icon="o-user" />
                <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <label class="label font-semibold block mb-2">Genre :</label>
                <div class="flex items-center gap-4">
                    <!-- Option Homme -->
                    <label for="gender-m" class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" id="gender-m" wire:model="sexe" name="sexe" value="M" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" checked="checked" />
                        <span class="label-text">Homme</span>
                    </label>
                    <!-- Option Femme -->
                    <label for="gender-f" class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" id="gender-f" name="sexe" wire:model="sexe" name="sexe" value="F" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" />
                        <span class="label-text">Femme</span>
                    </label>
                    <!-- Option Non-Binaire -->
                    <label for="gender-nb" class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" id="gender-nb" name="sexe" wire:model="sexe" name="sexe" value="NB" class="radio radio-primary checked:hover:bg-primary checked:focus:bg-primary" />
                        <span class="label-text">Non-binaire</span>
                    </label>
                </div>
                <x-ui.form.input-error :messages="$errors->get('sexe')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-ui.form.input wire:model="email" class="block w-full" type="email"
                    name="email" :value="old('email')" required autocomplete="email"
                    label="Adresse email" placeholder="Adresse email"
                    icon="o-user" />
                @error('email')
                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-ui.form.input wire:model="phone"
                    class="block w-full focus:ring-primary-focus" type="text"
                    name="phone" :value="old('phone')" required autofocus
                    autocomplete="phone" label="Numéro de téléphone" placeholder="Téléphone"
                    icon="o-phone" />
                @error('first_name')
                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                @enderror
            </div>

            {{-- Début Date de naissance --}}
            @php
                $dateConfig = ['altFormat' => 'd/m/Y'];
            @endphp
            <div class="mt-4">
                <x-mary-datepicker class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" label="Date de naissance" wire:model="birthday" icon-right="o-calendar" :config="$dateConfig" />
            </div>

            <div class="mt-4">
                <x-ui.form.date-time class="input-primary" label="Heure de naissance" wire:model="time_of_birth" type="time" />
                @error('time_of_birth')
                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
            
            <div class="mt-4">
                <x-ui.form.input wire:model="city_of_birth" class="input-primary block w-full" type="text" :value="old('city_of_birth')" label="Ville de naissance" placeholder="Ville de naissance" />
                @error('city_of_birth')
                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
            
            <div class="mt-4">
                <x-ui.form.input wire:model="native_country" class="input-primary block w-full" type="text" :value="old('native_country')" label="Pays de naissance" placeholder="Pays de naissance" />
                @error('native_country')
                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                @enderror
            </div>
            {{-- Fin Date de naissance --}}
        </div>

        <x-slot:actions>
            <button class="btn btn-secondary btn-sm h-12 mr-auto md:h-8 mt-4" @click.prevent="$wire.ModalCreateUser = false">Annuler</button>
            <x-ui.primary-button class="btn-sm h-12 md:h-8 mt-4" wire:click.prevent="createUser()">Créer l'utilisateur</x-ui.primary-button>
        </x-slot:actions>
    </x-ui.dialog>
</div>
