<ul class="flex flex-row flex-wrap gap-2 gap-y-6 justify-between">



    <script>
    document.addEventListener('livewire:init', () => {

        const uploaderImgElements = document.querySelectorAll('[data-uploader-img]');

        uploaderImgElements.forEach((uploader) => {
            const inputFileElement = uploader.querySelector('[data-input-file]');
            const imgsPreviewElement = uploader.querySelector('[data-img-preview]');

            const id = inputFileElement.getAttribute('id') + "-uploader";
            uploader.setAttribute('id', id);
            const fileName = inputFileElement.getAttribute('name');

            inputFileElement.addEventListener('change', function(event) {
                var file = event.target.files[0];
                if (file) {

                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imgsPreviewElement.src = e.target.result;
                    }
                    
                    reader.readAsDataURL(file);

                }
            });
        });

        Livewire.on('fileSaved', () => {
            Toast.success('Image enregistrée avec succès.');
        });
    });
    </script>




    <li data-uploader-img class="max-w-[45%]">
        <div class="max-w-full relative rounded-full overflow-hidden">
            <img class="w-full h-full" data-img-preview id="favicon-preview" src="{{ asset(config('siteconfig.favicon', 'favicon.ico')) }}" />

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
        <span class="text-center text-xs text-white/80 inline-block mt-2 px-1 leading-4">Favicon du site avec l'extension .ico</span>

        <button wire:click="saveFile('favicon')">Save Fav</button>
    </li>


    <li data-uploader-img class="max-w-[45%]">
        <div class="max-w-full relative rounded-full overflow-hidden">
            <img class="w-full h-full" data-img-preview id="pending-preview" src="{{ asset('imgs/' . config('siteconfig.pending', 'pending.jpg')) }}" />

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
        <span class="text-center text-xs text-white/80 inline-block mt-2 px-1 leading-4">Image par défaut des articles avec l'extension .jpg</span>
        <button wire:click="saveFile('pending')">Save pending</button>
    </li>
</ul>
