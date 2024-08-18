<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/draws.js")
        <script>
            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

            function drawForm() {
                return {
                    name: decodeHtml('{{ old('name') ?? $draw->name }}'),
                    slug: decodeHtml('{{ old('slug') ?? $draw->slug }}'),
        
                    slugify() {
                        this.slug = this.name
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
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.draw.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Modifier le tirage : </span>
                <span class="italic"> {{ $draw->name }} </span>
            </div>
        </h2>
    </x-slot>

    <section>
        <header>
            <a href="{{ route('admin.draw.index') }}" class="btn btn-sm">Voir tous les tirages</a>
            <a href="{{ route('admin.draw.create') }}" class="btn btn-sm">Créer un tirage</a>
            <a href="{{ route('admin.tarot.index') }}" class="btn btn-sm">Accéder aux interprétations des cartes</a>
        </header>

        <section>
            <form action="{{ route('admin.draw.update', $draw->id) }}" method="POST" autocomplete="off" x-data="drawForm()">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Draw Name -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('name') input-error @enderror" id="name" type="text" x-model="name"
                        name="name" data-name="{{ old('name') ?? $draw->name }}" value="{{ old('name') ?? $draw->name }}" required
                        label="Nom du tirage " placeholder="Nom du tirage" />
                        @error('name')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    <!-- Draw Slug -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" id="slug_d" disabled type="text" x-model="slug"
                        name="slug" data-slug="{{ old('slug') ?? $draw->slug }}" required
                        label="Slug du tirage " placeholder="Slug du tirage" />
                    </div>
                    <!-- Draw Slug (Hidden) -->
                    <input type="hidden" name="slug" value="{{ old('slug') ?? $draw->slug }}" id="slug" x-model="slug">

                    <!-- Draw totalSelectedCards -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('totalSelectedCards') input-error @enderror" id="totalSelectedCards" type="number"
                        name="totalSelectedCards" value="{{ old('totalSelectedCards') ?? $draw->totalSelectedCards }}" required
                        label="Nombre de carte(s) à choisir" placeholder="Nombre de carte(s) à choisir" />
                        
                        @error('totalSelectedCards')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>
                </div>
                
                <!-- Draw Desc -->
                <div class="mt-4">
                    <label for="description" class="pt-0 label label-text font-semibold">Description du tirage</label>
                    <textarea id="description" rows="4" class="textarea textarea-primary w-full peer @error('description') border-error @enderror" required name="description"  placeholder="Description du tirage">{{ old('description') ?? $draw->description }}</textarea>
                    @error('description')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Draw Checkbox -->
                <div class="mt-4 flex flex-row justify-between">
                    <div>
                        <label for="hasSumCards" class="inline-flex gap-3 items-center cursor-pointer">
                        <input type="checkbox" id="hasSumCards" name="hasSumCards" value="1" class="checkbox checkbox-primary focus:ring-primary-focus  checkbox-sm" @if($draw->hasSumCards) checked @endif >
                                Calculer la synthèse ?
                        </label>
                    </div>
                    <div>
                        <label for="active" class="inline-flex gap-3 items-center cursor-pointer">
                        <input type="checkbox" id="active" name="active" value="1" class="checkbox checkbox-primary focus:ring-primary-focus  checkbox-sm" @if($draw->active) checked @endif >
                                Actif ?
                        </label>
                    </div>
                    
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer le tirage</button>
                </div>
            </form>

            <!-- Draw Keywords -->

            
            <div x-data="{ open: false }" :class="open ? 'collapse-open' : 'collapse-hidden'" class="mt-4 collapse bg-base-200">
                
                <div x-on:click="open = !open" class="collapse-title text-xl font-medium cursor-pointer">Mots-clefs des positions du tirage</div>
                <div class="collapse-content">
                    <div class="flex flex-col" id="keywordsContainer" data-submit-save-position="{{ route('admin.draw.save.keywords') }}">
                        {{-- {{ dd($drawKeywords) }} --}}
                        @if($draw->positionsKeywords)
                        @foreach ($drawKeywords as $keyword)
                        {{-- {{ dd($keyword->position) }} --}}
                            <div class="mt-4 flex flex-col md:flex-row gap-4 keyword-field">
            
                                <div class="w-full md:w-3/6">
                                    <label for="position-{{ $keyword->position }}-keyword" class="inline-flex gap-3 items-center cursor-pointer">Position {{ $keyword->position }}</label>
                                    <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('totalSelectedCards') input-error @enderror" id="position-{{ $keyword->position }}-keyword" type="text"
                                    name="position-{{ $keyword->position }}-keyword" value="{{ $keyword->keywords }}"
                                    label="Mots-clefs" placeholder="Mots-clefs" />
                                </div>
            
                                <div class="w-full md:w-3/6">
                                    <label for="position-{{ $keyword->position }}-icone" class="inline-flex gap-3 items-center cursor-pointer">Icône</label>
                                    <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('totalSelectedCards') input-error @enderror" id="position-{{ $keyword->position }}-icone" type="text"
                                    name="position-{{ $keyword->position }}-icone" value="{{ $keyword->icone }}" placeholder="fa-thin fa-dragon" />
                                </div>
            
                                <div class="w-full md:w-1/6 content-end">
                                    <button data-submit-position='@json(["position" => $keyword->position, "drawId" => $draw->id])' class="btn btn-outline btn-ghost border-primary text-primary btn-circle"><i class="fa-thin fa-floppy-disk fa-lg"></i></button>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
              </div>
            
            <template id="keywordTemplate">
                <div class="mt-4 flex flex-col md:flex-row gap-4 keyword-field">
                    <div class="w-full md:w-3/6">
                        <label class="inline-flex gap-3 items-center cursor-pointer">Position <span class="position-number"></span></label>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" type="text" name="position-__index__-keyword" placeholder="Mots-clefs" />
                    </div>
                    <div class="w-full md:w-3/6">
                        <label class="inline-flex gap-3 items-center cursor-pointer">Icône</label>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" type="text" name="position-__index__-icone" placeholder="fa-thin fa-dragon" />
                    </div>
                    <div class="w-full md:w-1/6 content-end">
                        <button data-submit-save-position="" data-submit-position='' class="btn btn-outline btn-ghost border-primary text-primary btn-circle"><i class="fa-thin fa-floppy-disk fa-lg"></i></button>
                    </div>
                </div>
            </template>
        </section>

    </section>

</x-admin-layout>
