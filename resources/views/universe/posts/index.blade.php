<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog/blog.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span> Tous les articles : </span>
            </div>
        </h2>
    </x-slot>

    <section id="blog-index">
        <header>
            <a href="{{ route('admin.post.create') }}" class="btn">Nouvel article</a>
        </header>

        <section>
            @livewire('admin.data-table-posts')
        </section>

    </section>

</x-admin-layout>
