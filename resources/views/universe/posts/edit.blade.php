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
                <span class="italic"> "{{ $post->title }}" </span>
            </div>
        </h2>
    </x-slot>

    <section id="blog-edit" data-post-id="{{ $post->id }}">
        <header class="mb-6">
            <a href="{{ route('admin.post.index') }}" class="btn">Voir tous les articles</a>
            <a href="{{ route('my_universe.show', $post->slug) }}" target="_blank" class="btn">Voir l'article</a>
            <a href="{{ route('admin.post.create') }}" class="btn">Nouvel article</a>
        </header>

        <section>
            <form action="{{ route('admin.post.update', $post->id) }}" method="POST" autocomplete="off" x-data="postForm()" x-init="$watch('title', value => slugify())">
                @csrf
                @method('PUT')
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
                <div class="mb-6">
                    <label for="excerpt" class="pt-0 label label-text font-semibold">Résumé de l'article</label>
                    <textarea id="excerpt" rows="4" class="textarea textarea-primary w-full peer @error('excerpt') border-error @enderror" required name="excerpt"  placeholder="Résumé de l'article">{{ old('excerpt') ? old('excerpt') : $post->excerpt }}</textarea>
                    @error('excerpt')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
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
                              <img src="http://ultimate.test/imgs/pending.jpg" />
                            </div>
                          </div>

                        <input type="file" class="file-input w-full max-w-xs" />
                    </div>
                    
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

                    <fieldset>
                        <legend>Catégories : </legend>
                        
                        <div class="form-control">
                            <label for="cat-1" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="cat-1" name="cat-1" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Catégorie 1</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="cat-2" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="cat-2" name="cat-2" class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Catégorie 2</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="cat-3" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="cat-3" name="cat-3" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Catégorie 3</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Status : </legend>
                        
                        <div class="form-control">
                            <label for="publish" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="publish" name="publish" @if($post->status == 'PUBLISH') checked="checked" @endif class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Publié</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="draft" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="draft" name="draft" @if($post->status == 'DRAFT') checked="checked" @endif class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Brouillon</span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label for="private" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="private" name="private" @if($post->status == 'PRIVATE') checked="checked" @endif class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Privé</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Date de la publication : </legend>

                        <div class="form-control">
                            <p>Créé le : {{ $post->created_at }}</p>
                            @if($post->status == "PUBLISH" || $post->status == "PRIVATE")
                                <p>Publié le : {{ $post->published_at }}</p>
                            @endif
                            @if($post->updated_at && $post->created_at != $post->updated_at)
                                <p>Modifié le : {{ $post->updated_at }}</p>
                            @endif

                            <div class="form-control">
                                <label for="now" class="label cursor-pointer gap-2 justify-start">
                                  <input type="checkbox" id="now" name="now" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                                  <span class="label-text">Maintenant</span>
                                </label>
                            </div>
                            
                            <label for="published_at" class="label cursor-pointer gap-2 justify-start">
                              <input type="checkbox" id="published_at" name="published_at" class="checkbox checkbox-primary checkbox-sm" />
                              <span class="label-text">Publier le...</span>
                            </label>
                        </div>
                    </fieldset>

                </div>

                <div class="flex justify-end mt-2">
                    <button id="btn-submit-post" type="submit" class="btn btn-primary btn-sm">Enregistrer l'article</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
