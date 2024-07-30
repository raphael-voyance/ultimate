<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/draws.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Créer un tirage</span>
        </h2>
    </x-slot>

    <section>
        <header>
            <a href="{{ route('admin.draw.index') }}" class="btn">Voir tous les tirages</a>
            <a href="{{ route('admin.tarot.index') }}" class="btn">Accéder aux interprétations des cartes</a>
        </header>

        <section>
            <form action="{{ route('admin.draw.store') }}" method="POST" autocomplete="off" x-data="{
                name: '',
                slug: '',

                slugify() {
                    this.slug = this.name
                        .normalize('NFD') // Normalize the string to decompose combined characters
                        .replace(/[\u0300-\u036f]/g, '') // Remove diacritical marks
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                        .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens
                }
            }" x-init="$watch('name', value => slugify())">
                @csrf
                @method('POST')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Draw Name -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('name') input-error @enderror" id="name" type="text" x-model="name"
                        name="name" value="{{ old('name') }}" required
                        label="Nom du tirage " placeholder="Nom du tirage" />
                        @error('name')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    <!-- Draw Slug -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" id="slug_d" disabled type="text" x-model="slug"
                        name="slug" required
                        label="Slug du tirage " placeholder="Slug du tirage" />
                    </div>
                    <!-- Draw Slug (Hidden) -->
                    <input type="hidden" name="slug" id="slug" x-model="slug">

                    <!-- Draw totalSelectedCards -->
                    <div>
                        <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus @error('totalSelectedCards') input-error @enderror" id="totalSelectedCards" type="number"
                        name="totalSelectedCards" value="{{ old('totalSelectedCards') }}" required
                        label="Nombre de carte(s) à choisir" placeholder="Nombre de carte(s) à choisir" />
                        
                        @error('totalSelectedCards')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>
                </div>
                
                <!-- Draw Desc -->
                <div class="mt-4">
                    <label for="description" class="pt-0 label label-text font-semibold">Description du tirage</label>
                    <textarea id="description" rows="4" class="textarea textarea-primary w-full peer @error('description') border-error @enderror" required name="description"  placeholder="Description du tirage">{{ old('description') }}</textarea>
                    @error('description')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Draw Checkbox -->
                <div class="mt-4 flex flex-row justify-between">
                    <div>
                        <label for="hasSumCards" class="inline-flex gap-3 items-center cursor-pointer">
                        <input type="checkbox" id="hasSumCards" name="hasSumCards" value="1" class="checkbox checkbox-primary focus:ring-primary-focus  checkbox-sm" @if(old('hasSumCards')) checked @endif >
                                Calculer la synthèse ?
                        </label>
                    </div>
                    <div>
                        <label for="active" class="inline-flex gap-3 items-center cursor-pointer">
                        <input type="checkbox" id="active" name="active" value="1" class="checkbox checkbox-primary focus:ring-primary-focus  checkbox-sm" @if(old('active')) checked @endif >
                                Actif ?
                        </label>
                    </div>
                    
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Ajouter le tirage</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
