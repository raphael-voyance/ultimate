<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog/category.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span> Toutes les catégories : </span>
            </div>
        </h2>
    </x-slot>

    <section id="category-index">
        <header class="mb-6 flex flex-wrap flex-row gap-3 justify-normal items-center">
            <a href="{{ route('admin.blog.category.create') }}" class="btn btn-sm">Nouvelle catégorie</a>
        </header>

        <section>
            @livewire('admin.data-table-categories')
        </section>

    </section>

</x-admin-layout>
