<x-admin-layout>

    @section(('js'))
        @vite("resources/js/add/universe/files.js")
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Tous les dossiers : </span>
            </div>
        </h2>
    </x-slot>

    <section>

        <header id="element-backup-container" class="mb-6">
            @php
                // On utilise rtrim pour s'assurer qu'il n'y a pas de barre oblique à la fin
                $parentFolder = rtrim(dirname($folder), '/');
            @endphp
        
            @if ($folder && $folder !== $disk)  <!-- Assurez-vous que $folder n'est pas vide et ne correspond pas à la racine du disque -->
                <a class="btn" href="{{ route('admin.get-files', ['disk' => $disk, 'folder' => $parentFolder]) }}">
                    <i class="fa-thin fa-arrow-up"></i> Remonter d'un cran
                </a>
            @else
                <a class="btn" href="{{ route('admin.list-folders') }}">
                    <i class="fa-thin fa-arrow-up"></i> Remonter d'un cran
                </a>
            @endif
        </header>

        <h5>Dossier courant : {{ $disk != $folder ? $disk : '' }}/{{ $folder }}</h5>

        @if(count($directories) >= 1)
        <h4>Dossier(s) :</h4>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 align-middle justify-center items-center">
            @foreach ($directories as $d)
                {{-- <a class="m-auto" href="{{ route('admin.get-files', ['disk' => $disk, 'folder' => $folder ? $folder . '/' . $d : $d]) }}"> --}}
                <a class="m-auto" href="{{ route('admin.get-files', ['disk' => $disk, 'folder' => $d]) }}">
                    <div class="flex flex-col justify-center items-center w-20 group">
                        <span class="text-7xl block group-hover:hidden"><i class="fa-thin fa-folder"></i></span>
                        <span class="text-7xl hidden group-hover:block"><i class="fa-thin fa-folder-open"></i></span>
                        <span class="text-xs">{{ $d }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        @endif

        @if(count($files) >= 1)
        <h4>Fichier(s) :</h4>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 justify-center items-start">
            @foreach ($files as $f)
                @php
                    $extension = pathinfo($f, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
                    $extensionsNotVisibles = ['gitignore'];
                    $folder = dirname($f);  // Chemin du dossier
                    $filename = basename($f);  // Nom du fichier
                @endphp
                
                @if (!in_array($extension, $extensionsNotVisibles))
                <div class="mx-auto relative group">
                    <div class="absolute w-full -top-4 flex flex-nowrap flex-row justify-around items-center transition-all opacity-0 group-hover:opacity-100">
                        <button data-btn-download-file="{{ route('admin.download-file', ['disk' => $disk, 'folder' => $folder, 'file' => $filename]) }}" class="btn hover:btn-warning hover:text-white btn-xs btn-circle">
                            <i class="fa-thin fa-download"></i>
                        </button>
                        <button data-btn-remove-file="{{ route('admin.remove-file', ['disk' => $disk, 'folder' => $folder, 'file' => $filename]) }}" class="btn hover:btn-error hover:text-white btn-xs btn-circle">
                            <i class="fa-thin fa-trash"></i>
                        </button>
                    </div>
                    <div class="flex flex-col justify-center items-center w-20">
                        @if(in_array($extension, $imageExtensions)) 
                            <!-- Si le fichier est une image, affiche l'image -->
                            @if($disk == 'private')
                                <img src="{{ route('admin.private-file', ['folder' => $folder, 'file' => $filename]) }}" alt="{{ basename($f) }}" class="w-full h-auto" />
                            @elseif ($disk == 'public')
                                <img src="{{ route('admin.public-file', ['folder' => $folder, 'file' => $filename]) }}" alt="{{ basename($f) }}" class="w-full h-auto" />
                            @else
                                Il semblerait que vous n'ayez pas accés à ce dossier
                            @endif
                        @elseif($extension == 'zip')
                            <!-- Si le fichier est un zip, affiche une icône de fichier zip -->
                            <span class="text-7xl"><i class="fa-thin fa-file-archive"></i></span>
                        @else
                            <!-- Icône générique pour les autres fichiers -->
                            <span class="text-7xl"><i class="fa-thin fa-file"></i></span>
                        @endif
                        <span class="text-xs break-all">{{ basename($f) }}</span>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    @endif
    </section>

</x-admin-layout>
