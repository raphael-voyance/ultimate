<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog/category.js")
        <script>
            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }
        </script>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.blog.category.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Modifier la catégorie : </span>
                <span class="italic"> "{{ $category->name }}" </span>
            </div>
        </h2>
    </x-slot>

    <section>
        <header class="mb-6 flex flex-wrap flex-row gap-3 justify-normal items-center">
            <a href="{{ route('admin.blog.category.create') }}" class="btn btn-sm">Nouvelle catégorie</a>
            <a href="{{ route('admin.blog.category.index') }}" class="btn btn-sm">Voir toutes les catégories</a>
            <a href="#" data-btn-category-del="{{ route('admin.blog.category.destroy', $category->id) }}" class="btn btn-sm btn-error hover:text-white focus:text-white">Supprimer la categorie</a>
        </header>

        <section>
            <form action="#" autocomplete="off" x-data="{
                name: decodeHtml('{{ old('name') ?? $category->name }}'),
                slug: decodeHtml('{{ old('slug') ?? $category->slug }}'),

                slugify() {
                    this.slug = this.name
                        .normalize('NFD') // Normalize the string to decompose combined characters
                        .replace(/[\u0300-\u036f]/g, '') // Remove diacritical marks
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                        .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
                }
            }" x-init="$watch('name', value => slugify())">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-6">
                    {{-- Post Title --}}
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('name') input-error @enderror" id="name" type="text" x-model="name"
                        name="title" value="{{ old('name') }}" required
                        placeholder="Nom de la catégorie" />
                        @error('name')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    {{-- Category Slug --}}
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" id="slug_t" disabled type="text" x-model="slug"
                        name="slug" required
                        label="Slug de l'article" placeholder="Slug de la catégorie" />
                    </div>
                    {{-- Category Slug (Hidden) --}}
                    <input type="hidden" name="slug" id="slug" x-model="slug">
                </div>
                
                {{-- Description --}}
                <div class="mb-6">
                    <label for="description" class="pt-0 label label-text font-semibold">Description de la catégorie</label>
                    <textarea
                        id="description"
                        rows="4" 
                        class="textarea textarea-primary w-full peer @error('description') border-error @enderror" 
                        required 
                        name="description" 
                        placeholder="Description de la catégorie">{{ old('description') ?? $category->description }}</textarea>
                    @error('description')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                {{-- Soumission --}}
                <div class="flex justify-end mt-2">
                    <button data-submit-url="{{ route('admin.blog.category.update', $category->id) }}" id="btn-submit-category" type="submit" class="btn btn-primary btn-sm">Enregistrer la catégorie</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
