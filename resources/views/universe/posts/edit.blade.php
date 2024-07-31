<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog/blog.js")
        <script>
            function postForm() {
                return {
                    title: '{{ old('title') ?? $post->title }}',
                    slug: '{{ old('slug') ?? $post->slug }}',
        
                    slugify() {
                        this.slug = this.title
                            .normalize('NFD') // Normalize the string to decompose combined characters
                            .replace(/[\u0300-\u036f]/g, '') // Remove diacritical marks
                            .toLowerCase()
                            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                            .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
                    }
                }
            }
        </script>
    @endsection
    @section("css")
        @vite("resources/js/add/universe/blog/blog.css")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Modifier l'article : {{ $post->title }}</span>
        </h2>
    </x-slot>

    <section id="blog-create">
        {{ $post }}
        <header>
            <a href="{{ route('admin.post.index') }}" class="btn">Voir tous les articles</a>
        </header>

        <section>
            <form action="{{ route('admin.post.update', $post->id) }}" method="POST" autocomplete="off" x-data="postForm()">
                @csrf
                @method('PUT')
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

                    <!-- Post Slug -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" id="slug_t" disabled type="text" x-model="slug"
                        name="slug" required
                        label="Slug de l'article" placeholder="Slug de l'article" />
                    </div>
                    <!-- Draw Slug (Hidden) -->
                    <input type="hidden" name="slug" id="slug" x-model="slug">
                </div>
                
                <!-- Résumé de l'article -->
                <div class="mt-4">
                    <label for="excerpt" class="pt-0 label label-text font-semibold">Résumé de l'article</label>
                    <textarea id="excerpt" rows="4" class="textarea textarea-primary w-full peer @error('excerpt') border-error @enderror" required name="excerpt"  placeholder="Contenu de l'article">{{ old('excerpt') ? old('excerpt') : $post->excerpt }}</textarea>
                    @error('excerpt')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <div>
                    Ajouter un composant
                </div>

                <div>
                    Catégories
                </div>

                <div>
                    Image à la une
                </div>

                <div>
                    Status
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Poster l'article</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
