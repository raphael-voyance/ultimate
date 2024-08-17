<div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('fileSaved', () => {
                console.log('salcccccy')
                Toast.success('Fichier enregistré avec succès !');
            });
        })
    </script>
    <a href="#" wire:click.prevent="openModal()"
        class="btn btn-circle"><i class="fa-thin fa-plus fa-xl"></i></a>

    <x-mary-modal wire:model="newFileModal">

        <section class="p-4 bg-base-200">
            <details class="collapse collapse-arrow bg-base-200">
                <summary class="collapse-title text-xl font-medium">Dossier d'enregistrement du fichier</summary>
                <div class="collapse-content">

                    @if(!in_array('private/uploads', $allFolders))
                        <div class="form-control">
                            <label for="private/uploads" class="label cursor-pointer gap-2 justify-start">
                                <input type="radio" id="private/uploads" wire:model="folder" name="folder" value="private/uploads" class="radio radio-primary radio-sm" />
                                <span class="label-text">private/uploads</span>
                            </label>
                        </div>
                    @endif
    
                    @if(!in_array('public/uploads', $allFolders))
                        <div class="form-control">
                            <label for="public/uploads" class="label cursor-pointer gap-2 justify-start">
                                <input type="radio" id="public/uploads" wire:model="folder" name="folder" value="public/uploads" class="radio radio-primary radio-sm" />
                                <span class="label-text">public/uploads</span>
                            </label>
                        </div>
                    @endif
        
                    @foreach ($allFolders as $folderOption)
                    <div class="form-control">
                        <label for="{{ $folderOption }}" class="label cursor-pointer gap-2 justify-start">
                            <input type="radio" id="{{ $folderOption }}" wire:model="folder" name="folder" value="{{ $folderOption }}" class="radio radio-primary radio-sm" />
                            <span class="label-text">{{ $folderOption }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </details>
        </section>

        <section>

            <input id="file" type="file" wire:model="file" class="file-input w-full max-w-xs" />

            <button wire:click="saveFile" class="btn btn-primary mt-4">Enregistrer le fichier</button>
        </section>
        
    </x-mary-modal>
</div>