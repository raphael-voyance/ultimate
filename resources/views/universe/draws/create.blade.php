<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Créer un tirage</span>
        </h2>
    </x-slot>

    <section>
        <header>
            <a href="{{ route('admin.draw.index') }}" class="btn">Voir tous les tirages</a>
        </header>

        <section>
            <form action="{{ route('admin.draw.store') }}" autocomplete="off" x-data="{
                name: '',
                slug: this.name,

                slugify() {
                    this.slug = this.name
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                }
            }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Draw Name -->
                    <div>
                        <x-ui.form.input id="name" type="text"
                            name="name" :value="old('name')" required autofocus
                            label="Nom du tirage " placeholder="Nom du tirage" x-on:input="slugify()" x-model="name" />
                        @error('name')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>

                    <!-- Draw Slug -->
                    <div>
                        <x-ui.form.input id="slug_d" disabled type="text" x-model="slug"
                            name="slug" :value="old('slug')" required
                            label="Slug du tirage " placeholder="Slug du tirage" />
                        @error('slug')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror
                    </div>
                    <!-- Draw Slug (Hidden) -->
                    <input type="hidden" name="slug" id="slug" x-model="slug">

                    <!-- Draw totalSelectedCards -->
                    <div>
                        <x-ui.form.input id="totalSelectedCards" type="number"
                            name="totalSelectedCards" :value="old('totalSelectedCards')" required
                            label="Nombre de carte(s) à choisir" placeholder="Nombre de carte(s) à choisir" />
                            @error('totalSelectedCards')
                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                            @enderror
                    </div>
                </div>
                
                <!-- Draw Desc -->
                <div class="mt-4">
                    <x-ui.form.textarea id="description" rows="4"
                        name="description" :value="old('description')" required
                        label="Description du tirage " placeholder="Description du tirage" />
                    @error('description')
                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                    @enderror
                </div>

                <!-- Draw Desc -->
                <div class="mt-4">
                    <label for="hasSumCards" class="inline-flex items-center">
                        <x-mary-checkbox id="hasSumCards" name="hasSumCards" label="Calculer la synthèse ?"
                            class="focus:ring-primary-focus  checkbox-sm" />
                    </label>
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Ajouter le tirage</button>
                </div>
            </form>
        </section>

    </section>

</x-admin-layout>
