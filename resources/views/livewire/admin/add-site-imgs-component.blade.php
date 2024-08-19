<div class="relative">
    {{-- Loader --}}
    <div class="absolute h-full w-full top-0" wire:loading>
        <x-ui.loader :loadingText="false" :overlay="false" :fixed="false" />
    </div>
    {{-- Fin Loader --}}

    <ul class="flex flex-row flex-wrap gap-2 gap-y-6 justify-between">
        
        {{-- Favicon --}}
        <li data-uploader-img class="max-w-[45%]" wire:ignore>
            <div class="max-w-full relative rounded-full overflow-hidden">
                <img class="w-full h-full" data-img-preview id="favicon-preview" src="{{ asset('storage/site-images/' . config('siteconfig.favicon', 'favicon.ico')) }}" />

                <div class="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <!-- Champ input file masqué -->
                    <input data-input-file name="favicon" wire:model="favicon" id="favicon" type="file" class="hidden" />
                
                    <!-- Label stylisé agissant comme déclencheur -->
                    <label for="favicon" class="cursor-pointer w-full h-full flex flex-col items-center justify-center p-4 transition-all opacity-0 bg-black/50 rounded-lg hover:opacity-100">

                    <!-- Texte optionnel pour une meilleure accessibilité -->
                    <span class="mt-2 text-center text-xs text-white">Charger une image...</span>

                    </label>
                </div>
            </div>
            <span data-info-img class="text-center text-xs text-white/80 block mt-2 px-1 leading-4">Favicon du site</span>

            <button data-save-button class="btn btn-circle btn-outline btn-accent btn-sm" wire:click="saveFile('favicon')">
                <i class="fa-thin fa-upload"></i>
            </button>
        </li>

        {{-- Image à la une --}}
        <li data-uploader-img class="max-w-[45%]" wire:ignore>
            <div class="max-w-full relative rounded-full overflow-hidden">
                <img class="w-full h-full" data-img-preview id="pending-preview" src="{{ asset('storage/site-images/' . config('siteconfig.pending', 'pending.jpg')) }}" />

                <div class="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <!-- Champ input file masqué -->
                    <input data-input-file name="pending" wire:model="pending" id="pending" type="file" class="hidden" />
                
                    <!-- Label stylisé agissant comme déclencheur -->
                    <label for="pending" class="cursor-pointer w-full h-full flex flex-col items-center justify-center p-4 transition-all opacity-0 bg-black/50 rounded-lg hover:opacity-100">
                    <!-- Icône d'upload -->
                    <span>
                        <i class="fa-thin fa-upload fa-xl"></i>
                    </span>

                    <!-- Texte optionnel pour une meilleure accessibilité -->
                    <span class="mt-2 text-center text-xs text-white">Charger une image...</span>

                    </label>
                </div>
            </div>
            <span data-info-img class="text-center text-xs text-white/80 block mt-2 px-1 leading-4">Image par défaut</span>

            <button data-save-button class="btn btn-circle btn-outline btn-accent btn-sm" wire:click="saveFile('pending')">
                <i class="fa-thin fa-upload"></i>
            </button>

        </li>

        {{-- Logo --}}
        <li data-uploader-img class="max-w-[45%]" wire:ignore>
            <div class="max-w-full relative rounded-full overflow-hidden">
                <img class="w-full h-full" data-img-preview id="logo-preview" src="{{ asset('storage/site-images/' . config('siteconfig.logo', 'logo.png')) }}" />

                <div class="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <!-- Champ input file masqué -->
                    <input data-input-file name="logoimg" wire:model="logo" id="logoimg" type="file" class="hidden" />
                
                    <!-- Label stylisé agissant comme déclencheur -->
                    <label for="logoimg" class="cursor-pointer w-full h-full flex flex-col items-center justify-center p-4 transition-all opacity-0 bg-black/50 rounded-lg hover:opacity-100">
                    <!-- Icône d'upload -->
                    <span>
                        <i class="fa-thin fa-upload fa-xl"></i>
                    </span>

                    <!-- Texte optionnel pour une meilleure accessibilité -->
                    <span class="mt-2 text-center text-xs text-white">Charger une image...</span>

                    </label>
                </div>
            </div>
            <span data-info-img class="text-center text-xs text-white/80 block mt-2 px-1 leading-4">Logo du site</span>

            <button data-save-button class="btn btn-circle btn-outline btn-accent btn-sm" wire:click="saveFile('logo')">
                <i class="fa-thin fa-upload"></i>
            </button>

        </li>
    </ul>
</div>
