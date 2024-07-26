<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Votre profil
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">



        {{-- Debut --}}
        <div x-data="{ editProfileIsOpen: false, sensibleZoneIsOpen: false }" class="md:flex no-wrap md:-mx-2 ">
            {{-- Left Side --}}
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-base-100 p-3 border-t-4 border-primary">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto" src="{{ $user->profile->avatar }}"
                            alt="{{ Auth::user()->fullName() }}" />


                    </div>
                    <div @class([
                        'mb-2',
                        'grid grid-cols-3 items-center' => Auth::user()->sexe(),
                    ])>
                        <div @class([
                            'col-span-2' => Auth::user()->sexe(),
                        ])>
                            <h2 class="text-base-content font-bold text-lg leading-6 my-1">
                                {{ Auth::user()->fullName() }}</h2>
                        </div>


                        @if (Auth::user()->sexe())
                            <div class="text-2xl text-base-content text-center">
                                @if (Auth::user()->sexe() == 'Homme')
                                    <i class="fa-duotone fa-mars"></i>
                                @elseif (Auth::user()->sexe() == 'Femme')
                                    <i class="fa-duotone fa-venus"></i>
                                @else
                                    <i class="fa-duotone fa-mars-and-venus"></i>
                                @endif
                            </div>
                        @endif
                    </div>

                    <p class="text-base-content mb-4">Vous êtes inscrit depuis le {{ Auth::user()->registeredAt() }}</p>
                    <p class="text-base-content">Vous avez réalisé <span
                            class="bg-primary py-1 px-2 rounded text-base-content text-sm">8</span> consultations</p>
                </div>
                <!-- End of profile card -->
            </div>

            {{-- Right Side --}}
            <div class="w-full md:w-9/12 md:mx-2">
                {{-- Profile tab --}}
                {{-- About Section --}}
                <div class="bg-base-100 p-3 shadow-sm border-t-4 border-primary rounded-sm mb-4">
                    <div class="flex items-center space-x-2 font-semibold text-base-content leading-8 mb-4">
                        <span>
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">A propos de vous :</span>
                    </div>
                    <div class="text-base-content">

                        <div class="grid md:grid-cols-2 text-sm">
                            @if (Auth::user()->phone())
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Téléphone</div>
                                    <div class="px-4 py-2">{{ Auth::user()->phone() }}</div>
                                </div>
                            @endif

                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2 break-words">
                                    <a class="text-base-content/75 hover:text-base-content/100"
                                        href="mailto:jane@example.com">{{ Auth::user()->email }}</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="grid md:grid-cols-2 text-sm">
                            @if (Auth::user()->facturateAddress())
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Adresse de facturation</div>
                                    <div class="px-4 py-2">{!! Auth::user()->facturateAddress() !!}</div>
                                </div>
                            @endif
                        </div>

                        <hr>

                        <div class="grid md:grid-cols-2 text-sm">
                            @if (Auth::user()->birthday())
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Date de naissance</div>
                                    <div class="px-4 py-2">{{ Auth::user()->birthday() }}</div>
                                </div>
                            @endif

                            @if (Auth::user()->birthDateInformations())
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Informations de naissance</div>
                                    <div class="px-4 py-2">
                                        {{-- {{ dd(Auth::user()->birthDateInformations())}} --}}
                                        <ul>
                                            @if (isset(Auth::user()->birthDateInformations()['time_of_birth']))
                                                <li>Heure : {{ Auth::user()->birthDateInformations()['time_of_birth'] }}
                                                </li>
                                            @endif

                                            @if (isset(Auth::user()->birthDateInformations()['city_of_birth']))
                                                <li>Ville : {{ Auth::user()->birthDateInformations()['city_of_birth'] }}
                                                </li>
                                            @endif

                                            @if (isset(Auth::user()->birthDateInformations()['native_country']))
                                                <li>Pays : {{ Auth::user()->birthDateInformations()['native_country'] }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button x-on:click="editProfileIsOpen = !editProfileIsOpen"
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Modifier
                        vos informations personnelles
                    </button>

                    <template x-if="editProfileIsOpen">
                        {{-- Début Form Edit Profile --}}
                        <form>
                            {{-- Identité --}}
                            <section class="w-full">
                                <h3>Identité</h3>
                                <div class="grid grid-cols-3 gap-4 mt-2">
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Votre prénom" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="last_name" type="text" name="last_name"
                                            :value="old('last_name') ? old('last_name') : Auth::user()->last_name" required label="Votre nom" placeholder="Nom" />
                                        <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="pt-0 label label-text font-semibold">Votre genre</label>
                                        <select id="sexe" name="sexe" required
                                            class="select select-primary w-full max-w-xs peer focus:border-none focus:ring-primary-focus">
                                            <option disabled selected>Genre</option>
                                            <option>Homme</option>
                                            <option>Femme</option>
                                            <option>Non binaire</option>
                                        </select>
                                        <x-ui.form.input-error :messages="$errors->get('sexe')" class="mt-2" />
                                    </div>
                                </div>
                            </section>

                            {{-- BirthDay Informations --}}
                            @php
                                $dateConfig = ['altFormat' => 'd/m/Y'];
                            @endphp
                            <section class="w-full mt-4">
                                <h3>Informations de naissance</h3>
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <x-mary-datepicker
                                            class="input input-primary w-full peer focus:border-none focus:ring-primary-focus"
                                            label="Votre date de naissance" icon-right="o-calendar" :config="$dateConfig" />
                                    </div>
                                    <div>
                                        <x-ui.form.date-time
                                            class="input input-primary w-full peer focus:border-none focus:ring-primary-focus"
                                            label="Votre heure de naissance" id="time_of_birth" name="time_of_birth"
                                            type="time" />
                                        @error('time_of_birth')
                                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                                        @enderror
                                    </div>

                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <x-ui.form.input id="last_name" type="text" name="last_name"
                                            :value="old('last_name') ? old('last_name') : Auth::user()->last_name" required label="Ville de naissance" placeholder="Nom" />
                                        <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="last_name" type="text" name="last_name"
                                            :value="old('last_name') ? old('last_name') : Auth::user()->last_name" required label="Pays de naissance" placeholder="Nom" />
                                        <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>

                                </div>
                            </section>

                            {{-- Contact Informations --}}
                            <section class="w-full mt-4">
                                <h3>Informations de contact</h3>
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Votre email" placeholder="Email" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Votre téléphone"
                                            placeholder="Téléphone" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>

                                </div>
                            </section>

                            {{-- Address --}}
                            <section class="w-full mt-4">
                                <h3>Adresse de facturation</h3>
                                <div class="grid grid-cols-3 gap-4 mt-2">
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="N" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Type" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Nom" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mt-2">
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Code postal" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Ville" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-ui.form.input id="first_name" type="text" name="first_name"
                                            :value="old('first_name') ? old('first_name') : Auth::user()->first_name" required label="Pays" placeholder="Prénom" />
                                        <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                </div>
                            </section>

                            <footer>
                                <button
                                    class="mt-3 float-right btn btn-primary btn-outline btn-sm mb-4 flex flex-nowrap justify-between items-center align-middle">
                                    <span>Enregistrer</span>
                                    <i
                                        class="opacity-0 sm:opacity-100 fa-thin hidden md:visible fa-duotone fa-user-pen"></i>
                                </button>
                                <div class="clear-both"></div>
                            </footer>
                        </form>
                        {{-- Fin Form Edit Profile --}}
                    </template>

                
                    <button x-on:click="sensibleZoneIsOpen = !sensibleZoneIsOpen"
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Modifier votre mot de passe ou supprimer votre compte
                    </button>
                    <template x-if="sensibleZoneIsOpen">
                        {{-- Delete & Edit password --}}
                        <section class="w-full mt-4">
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <button
                                    class="btn btn-error btn-outline btn-sm mb-4 flex flex-nowrap w-full justify-between items-center align-middle">
                                    <span>Supprimer votre compte</span>
                                    <i
                                        class="opacity-0 sm:opacity-100 fa-thin hidden md:visible fa-duotone fa-user-xmark"></i>
                                </button>
                                <button
                                    class="btn btn-warning btn-outline btn-sm mb-4 flex flex-nowrap w-full justify-between items-center align-middle">
                                    <span>Modifier votre mot de passe</span>
                                    <i
                                        class="opacity-0 sm:opacity-100 fa-thin hidden md:visible fa-duotone fa-lock"></i>
                                </button>
                            </div>

                        </section>
                    </template>

                </div>
                <!-- End of about section -->
            </div>
        </div>
        {{-- Fin --}}
    </article>

    <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('galaxy.profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('galaxy.profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('galaxy.profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
