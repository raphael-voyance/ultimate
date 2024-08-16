<x-admin-layout>

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
            @if (strpos($folder, '/') !== false)
            <a class="btn" href="{{ route('admin.get-files', ['folder' => dirname($folder)]) }}"><i class="fa-thin fa-arrow-up"></i> Remonter d'un cran</a>
            @else
            <a class="btn" href="{{ route('admin.list-folders') }}"><i class="fa-thin fa-arrow-up"></i> Remonter d'un cran</a>
            @endif

            
        </header>

        <h5>Dossier courant : {{ $folder }}</h5>

        <h4>Dossier(s) :</h4>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 align-middle justify-center items-center">
            @foreach ($directories as $d)
                <a class="m-auto" href="{{ route('admin.get-files', ['disk' => $disk, 'folder' => $folder ? $folder . '/' . $d : $d]) }}">
                    <div class="flex flex-col justify-center items-center w-20 group">
                        <span class="text-7xl block group-hover:hidden"><i class="fa-thin fa-folder"></i></span>
                        <span class="text-7xl hidden group-hover:block"><i class="fa-thin fa-folder-open"></i></span>
                        <span class="text-xs">{{ $d }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        <h4>Fichier(s) :</h4>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 align-middle justify-center items-center">
            @foreach ($files as $f)
                <a class="m-auto" href="#">
                    <div class="flex flex-col justify-center items-center w-20 group">
                        <span class="text-7xl block group-hover:hidden"><i class="fa-thin fa-folder"></i></span>
                        <span class="text-7xl hidden group-hover:block"><i class="fa-thin fa-folder-open"></i></span>
                        <span class="text-xs">{{ $f }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

</x-admin-layout>
