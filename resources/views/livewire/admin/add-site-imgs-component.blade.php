<ul class="flex flex-row flex-wrap gap-2 gap-y-6 justify-between">
    <script>
    document.addEventListener('livewire:init', () => {

    const uploaderImgElements = document.querySelectorAll('[data-uploader-img]');

    uploaderImgElements.forEach((uploader) => {
        const inputFileElement = uploader.querySelector('[data-input-file]');
        const imgsPreviewElement = uploader.querySelector('[data-img-preview]');
        const saveButtonElement = uploader.querySelector('[data-save-button]');
        const infoImgElement = uploader.querySelector('[data-info-img]');

        const fileName = inputFileElement.getAttribute('name');

        // Initialement masquer le bouton
        saveButtonElement.style.display = 'none';

        inputFileElement.addEventListener('change', function(event) {
            var file = event.target.files[0];
            if (file) {

                var reader = new FileReader();
                
                reader.onload = function(e) {
                    imgsPreviewElement.src = e.target.result;
                }
                
                reader.readAsDataURL(file);

                // Afficher le bouton lorsqu'un fichier est sélectionné
                saveButtonElement.style.display = 'block';
                saveButtonElement.style.margin = 'auto';
                saveButtonElement.style.marginTop = '15px';

                infoImgElement.style.display = 'none';
            } else {
                // Masquer le bouton si aucun fichier n'est sélectionné
                saveButtonElement.style.display = 'none';
                infoImgElement.style.display = 'block';
            }
        });
    });

    Livewire.on('fileSaved', () => {
        Toast.success('Image enregistrée avec succès.');
    });
    });
    </script>

    <li data-uploader-img class="max-w-[45%]" wire:ignore>
        <div class="max-w-full relative rounded-full overflow-hidden">
            <img class="w-full h-full" data-img-preview id="favicon-preview" src="{{ asset('storage/site-images/' . config('siteconfig.favicon', 'favicon.ico')) }}" />

            <div class="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <!-- Champ input file masqué -->
                <input data-input-file name="favicon" wire:model="favicon" id="favicon" type="file" class="hidden" />
              
                <!-- Label stylisé agissant comme déclencheur -->
                <label for="favicon" class="cursor-pointer w-full h-full flex flex-col items-center justify-center p-4 transition-all opacity-0 bg-black/50 rounded-lg hover:opacity-100">
                  <!-- Icône d'upload -->
                  <span>
                    <i class="fa-thin fa-upload fa-xl"></i>
                  </span>

                  <!-- Texte optionnel pour une meilleure accessibilité -->
                  <span class="mt-2 text-center text-xs text-white">Charger une image...</span>

                </label>
              </div>
        </div>
        <span data-info-img class="text-center text-xs text-white/80 inline-block mt-2 px-1 leading-4">Favicon du site</span>

        <button data-save-button class="btn btn-circle btn-outline btn-accent btn-sm" wire:click="saveFile('favicon')">
    </li>


    <li data-uploader-img class="max-w-[45%]" wire:ignore>
        <div class="max-w-full relative rounded-full overflow-hidden">
            <img class="w-full h-full" data-img-preview id="pending-preview" src="{{ asset('storage/site-images/' . config('siteconfig.pending', 'pending.jpg')) }}" />

            <div class="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <!-- Champ input file masqué -->
                <input data-input-file name="pending" wire:model="pending" id="pending" type="file" class="hidden" />
              
                <!-- Label stylisé agissant comme déclencheur -->
                <label for="pending" class="cursor-pointer w-full h-full flex flex-col items-center justify-center p-4 transition-all opacity-0 bg-black/50 rounded-lg hover:opacity-100">
                  <!-- Icône d'upload (utilisant par exemple Heroicons) -->
                  <span>
                    <i class="fa-thin fa-upload fa-xl"></i>
                  </span>

                  <!-- Texte optionnel pour une meilleure accessibilité -->
                  <span class="mt-2 text-center text-xs text-white">Charger une image...</span>

                </label>
              </div>
        </div>
        <span data-info-img class="text-center text-xs text-white/80 inline-block mt-2 px-1 leading-4">Image par défaut</span>

        <button data-save-button class="btn btn-circle btn-outline btn-accent btn-sm" wire:click="saveFile('pending')">
            <i class="fa-thin fa-upload"></i>
        </button>

    </li>
</ul>

{{-- <div>
    <div>
        <input type="file" wire:model="favicon">
        <button wire:click="saveFile('favicon')">Upload Favicon</button>
    </div>

    <div>
        <input type="file" wire:model="pending">
        <button wire:click="saveFile('pending')">Upload Pending Image</button>
    </div>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div> --}}
