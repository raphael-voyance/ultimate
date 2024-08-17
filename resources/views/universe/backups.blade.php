<x-admin-layout>

    @section(('js'))
        @vite("resources/js/add/universe/backups.js")
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Sauvegarde du site : </span>
            </div>
        </h2>
    </x-slot>

    <section>

        <header id="element-save-backup-container" class="mb-6">
            <button id="btn-save-backup" class="btn"><i class="fa-thin fa-floppy-disk"></i> Créer une sauvegarde du site</button>
        </header>

        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 align-middle justify-center items-center">
        @foreach ($zipFiles as $file)
            <a class="m-auto" href="{{ route('admin.download-backup', $file['name']) }}">
                <div class="flex flex-col justify-center items-center w-20">
                    <span class="text-7xl"><i class="fa-duotone fa-solid fa-file-zip"></i></span>
                    <span class="text-xs">{{ $file['name'] }}</span>
                </div>
            </a>
        @endforeach
        </div>
        

    </section>

</x-admin-layout>
