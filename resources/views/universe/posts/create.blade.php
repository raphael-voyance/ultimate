<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Créer un article</span>
        </h2>
    </x-slot>

    <section id="blog-create">
        <header>
            <a href="{{ route('admin.post.index') }}" class="btn">Voir tous les articles</a>
        </header>

        <section>
            <form action="{{ route('admin.post.store') }}" method="POST" autocomplete="off" x-data="{
                name: '',
                slug: '',

                slugify() {
                    this.slug = this.title
                        .normalize('NFD') // Normalize the string to decompose combined characters
                        .replace(/[\u0300-\u036f]/g, '') // Remove diacritical marks
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                        .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
                }
            }" x-init="$watch('title', value => slugify())">
                @csrf
                @method('POST')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Post Title -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('title') input-error @enderror" id="title" type="text" x-model="title"
                        name="title" value="{{ old('title') }}" required
                        label="Titre de l'article" placeholder="Titre de l'article" />
                        @error('title')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    <!-- Draw Slug -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" id="slug_t" disabled type="text" x-model="slug"
                        name="slug" required
                        label="Slug de l'article" placeholder="Slug de l'article" />
                    </div>
                    <!-- Draw Slug (Hidden) -->
                    <input type="hidden" name="slug" id="slug" x-model="slug">
                </div>
                
                <!-- Draw Desc -->
                <div class="mt-4">
                    <label for="content" class="pt-0 label label-text font-semibold">L'article</label>
                    <textarea id="content" rows="4" class="textarea textarea-primary w-full peer @error('content') border-error @enderror" required name="content"  placeholder="Contenu de l'article">{{ old('content') }}</textarea>
                    @error('content')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Poster l'article</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
