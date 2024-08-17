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

        <div class="grid grid-cols-2 md:grid-cols-6 gap-2 align-middle justify-center items-center">
        @foreach ($disks as $name => $disk)
        {{-- {{ dd($disk) }} --}}
            <a class="m-auto" href="{{ route('admin.get-files', ['disk' => $name]) }}">
                <div class="flex flex-col justify-center items-center w-20 group">
                    <span class="text-7xl block group-hover:hidden"><i class="fa-thin fa-folder"></i></span>
                    <span class="text-7xl hidden group-hover:block"><i class="fa-thin fa-folder-open"></i></span>
                    <span class="text-xs">{{ $name }}</span>
                </div>
            </a>
        @endforeach
        </div>
        

    </section>

</x-admin-layout>
