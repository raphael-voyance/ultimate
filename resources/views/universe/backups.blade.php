<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.blog.post.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Sauvegarde du site : </span>
            </div>
        </h2>
    </x-slot>

    <section>

        @foreach ($zipFiles as $file)
            {{ $file }}
        @endforeach
        

    </section>

</x-admin-layout>
