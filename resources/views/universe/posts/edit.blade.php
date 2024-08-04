<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/blog/blog.js")
        <script>
            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

            function postForm() {
                return {
                    title: decodeHtml('{{ old('title') ?? $post->title }}'),
                    slug: decodeHtml('{{ old('slug') ?? $post->slug }}'),
        
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
            <a href="{{ route('admin.post.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Modifier l'article : </span>
                <span class="italic"> {{ $post->title }} </span>
            </div>
        </h2>
    </x-slot>

    <section id="blog-create">
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
                    <!-- Post Slug (Hidden) -->
                    <input type="hidden" name="slug" id="slug" x-model="slug">
                </div>
                
                <!-- Résumé de l'article -->
                <div class="mt-4">
                    <label for="excerpt" class="pt-0 label label-text font-semibold">Résumé de l'article</label>
                    <textarea id="excerpt" rows="4" class="textarea textarea-primary w-full peer @error('excerpt') border-error @enderror" required name="excerpt"  placeholder="Résumé de l'article">{{ old('excerpt') ? old('excerpt') : $post->excerpt }}</textarea>
                    @error('excerpt')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Contenu de l'article -->
                <div class="mt-4 text-white">
                    <div id="editorjs"></div>
                </div>

                <div>
                    Catégories
                </div>

                <div>
                    <h5>Image à la une :</h5>
                    <img class="w-36" src="{{ $post->image }}" />
                </div>

                <div>
                    <h5>Status :</h5>
                    @switch($post->status)
                        @case('PUBLISH')
                        Publié
                        @break
                        @case('DRAFT')
                        Brouillon
                        @break
                        @case('PRIVATE')
                        Privé
                        @break
                    @endswitch
                    <p>Créé le : {{ $post->created_at }}</p>
                    @if($post->status == "PUBLISH" || $post->status == "PRIVATE")
                        <p>Publié le : {{ $post->published_at }}</p>
                    @endif
                    @if($post->updated_at && $post->created_at != $post->updated_at)
                        <p>Modifié le : {{ $post->updated_at }}</p>
                    @endif
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Poster l'article</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
