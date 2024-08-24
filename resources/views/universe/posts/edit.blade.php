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
            <a href="{{ route('admin.blog.post.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Modifier l'article : </span>
                <span class="italic"> "{{ $post->title }}" </span>
            </div>
        </h2>
    </x-slot>

    <section id="blog-edit" data-post-id="{{ $post->id }}">
        <header class="mb-6 flex flex-wrap flex-row gap-3 justify-normal items-center">
            <a href="{{ route('admin.blog.post.index') }}" class="btn btn-sm">Voir tous les articles</a>

            <a href="{{ route('my_universe.show', $post->slug) }}" target="_blank" class="btn btn-sm">Voir l'article</a>

            <a href="{{ route('admin.blog.post.duplicate', $post->id) }}" target="_blank" class="btn btn-sm">Dupliquer l'article</a>

            <a href="{{ route('admin.blog.post.create') }}" class="btn btn-sm">Nouvel article</a>

            <a href="#" data-btn-post-del="{{ route('admin.blog.post.destroy', $post->id) }}" class="btn btn-sm btn-error hover:text-white">Supprimer l'article</a>
        </header>

        <section>
            <form action="{{ route('admin.blog.post.update', $post->id) }}" method="POST" autocomplete="off" x-data="postForm()" x-init="$watch('title', value => slugify())">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-6">
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
                <div x-data="{ 
                    wordCount: 0,
                    init() {
                        this.wordCount = this.$refs.excerpt.value.split(/\s+/).filter(word => word.length > 0).length;
                    } 
                }" class="mb-6">
                    <label for="excerpt" class="pt-0 label label-text font-semibold">Résumé de l'article</label>
                    <textarea
                        x-ref="excerpt"
                        id="excerpt"
                        rows="4" 
                        class="textarea textarea-primary w-full peer @error('excerpt') border-error @enderror"
                        name="excerpt" 
                        placeholder="Résumé de l'article"
                        @input="wordCount = $event.target.value.split(/\s+/).filter(word => word.length > 0).length">{{ old('excerpt') ? old('excerpt') : $post->excerpt }}</textarea>
                    @error('excerpt')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                
                    <div :class="wordCount > 100 ? 'text-red-600' : (wordCount < 70 ? 'text-orange-600' : 'text-green-600')" class="mt-2">
                        <span x-text="wordCount"></span> mot<span x-text="wordCount > 1 ? 's' : ''"></span> / 100
                    </div>
                </div>

                <!-- Contenu de l'article -->
                <div class="mt-4 text-white">
                    <div id="editor"></div>
                </div>

                <div class="mb-8">
                    <h5 class="mb-2">Image à la une :</h5>
                    <div class="flex flex-wrap gap-4 justify-start items-center">
                        <div class="avatar">
                            
                            <div class="w-20 rounded-full">
                                @if(Str::contains(basename($post->image), 'pending'))
                                    <!-- Affichage spécifique si le nom de l'image contient "pending" -->
                                    <img id="thumbnail-preview" src="{{ asset('storage/site-images/' . config('siteconfig.pending', 'pending.jpg')) }}" alt="{{ asset($post->title) }}" />
                                @elseif($post->status == 'PRIVATE')
                                <img id="thumbnail-preview" src="{{ route('image.private', ['postSlug' => $post->slug, 'filename' => basename($post->image)]) }}" alt="{{ $post->title }}">
                                    {{-- <img id="thumbnail-preview" src="{{ route('image.private', ['filename' => basename(str_replace('/storage/', '', $post->image)), 'postSlug' => $post->slug]) }}" alt="{{ $post->title }}"> --}}
                                @else
                                    <img id="thumbnail-preview" src="{{ asset($post->image) }}" alt="{{ $post->title }}" />
                                    {{-- <img id="thumbnail-preview" src="{{ route('image.post.thumbnail', ['filename' => basename($post->image)]) }}" alt="Thumbnail" /> --}}
                                @endif
                            </div>
                        </div>

                          <input name="thumbnail" id="thumbnail" type="file" class="file-input w-full max-w-xs" />
                    </div>
                    
                </div>

                {{-- Métas infos --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

                    {{-- Catégories --}}
                    <fieldset>
                        <legend>Catégories : </legend>

                        <div id="categories-list" x-data="{ showAll: false }">
                            <!-- La liste des catégories -->
                            @foreach ($categories as $index => $category)
                                <div 
                                    class="form-control" 
                                    x-show="{{ $index < 4 ? 'true' : 'showAll' }}">
                                    <label for="{{ $category->slug }}" class="label cursor-pointer gap-2 justify-start">
                                        <input 
                                            type="checkbox" 
                                            id="{{ $category->slug }}"
                                            name="{{ $category->slug }}"
                                            value="{{ $category->id }}"
                                            class="checkbox checkbox-primary checkbox-sm"
                                            {{ $post->categories->contains($category->id) ? 'checked' : '' }}
                                        />
                                        <span class="label-text">{{ $category->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        
                            <!-- Le lien "Tout afficher" ou "Voir moins" -->
                            @if(count($categories) > 4)
                            <button @click.prevent="showAll = !showAll" class="btn btn-ghost btn-sm"><span x-text="showAll ? 'Voir moins' : 'Afficher toutes les catégories'"></span></button>
                            @endif
                        </div>

                        {{-- Ajouter une Catégorie --}}
                        <button id="add-categorie" class="btn btn-ghost btn-sm"><i class="fal fa-plus"></i>Ajouter une catégorie</button>
                        <div class="hidden flex flex-nowrap max-w-full justify-start items-center gap-2" id="add-categorie-input-container">
                            <input class="input input-primary input-sm peer focus:border-none focus:ring-primary-focus" type="text" placeholder="Nom de la catégorie" id="add-categorie-input" name="add-categorie-input" />
                            <button id="add-categorie-submit-btn" data-submit-url="{{ route('admin.blog.category.store') }}" class="btn btn-sm btn-outline btn-ghost btn-circle"><i class="fal fa-save"></i></button>
                            <button id="add-categorie-cancel-btn" class="btn btn-sm btn-outline btn-ghost btn-circle"><i class="fal fa-times"></i></button>
                        </div>
                    </fieldset>

                    {{-- Status --}}
                    <fieldset>
                        <legend>Status : </legend>
                        
                        <div class="form-control">
                            <label for="publish" class="label cursor-pointer gap-2 justify-start">
                              <input type="radio" id="publish" name="status" value="publish" {{ $post->status == 'PUBLISH' ? 'checked' : '' }} class="radio radio-primary radio-sm" />
                              <span class="label-text">Publié</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="draft" class="label cursor-pointer gap-2 justify-start">
                              <input type="radio" id="draft" name="status" value="draft" {{ $post->status == 'DRAFT' ? 'checked' : '' }} class="radio radio-primary radio-sm" />
                              <span class="label-text">Brouillon</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="private" class="label cursor-pointer gap-2 justify-start">
                              <input type="radio" id="private" name="status" value="private" {{ $post->status == 'PRIVATE' ? 'checked' : '' }} class="radio radio-primary radio-sm" />
                              <span class="label-text">Privé</span>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Publication --}}
                    <fieldset>
                        <legend>Date de la publication : </legend>
                        
                        <div class="form-control">
                            <label for="now" class="label cursor-pointer gap-2 justify-start">
                              <input type="radio" id="now" name="published_at" value="now" class="radio radio-primary radio-sm" />
                              <span class="label-text">Maintenant</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="published_at" id="published_at_select_date" class="label cursor-pointer gap-2 justify-start">
                              <input type="radio" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y') }}" checked="checked" class="radio radio-primary radio-sm" />
                              <span id="published_at_text" class="label-text">Publié le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}</span>
                            </label>
                        </div>

                        <p class="label-text pl-[2.2em] mb-[0.6em]">Créé le {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l d F Y') }}</p>
                        <p class="label-text pl-[2.2em]">Modifié le {{ \Carbon\Carbon::parse($post->updated_at)->translatedFormat('l d F Y') }}</p>

                        <div class="hidden flex flex-nowrap max-w-full justify-start items-center gap-2" id="published_at_input_container">
                            <input class="input input-primary input-sm peer focus:border-none focus:ring-primary-focus" id="published_at_input" type="text" />
                            <button id="published_at_input_submit_btn" class="btn btn-sm btn-outline btn-ghost btn-circle"><i class="fal fa-save"></i></button>
                            <button id="published_at_input_cancel_btn" class="btn btn-sm btn-outline btn-ghost btn-circle"><i class="fal fa-times"></i></button>
                        </div>
                    </fieldset>

                </div>

                {{-- Soumission --}}
                <div class="flex justify-end mt-2">
                    <button id="btn-submit-post" type="submit" class="btn btn-primary btn-sm">Enregistrer l'article</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
