<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Votre profil
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">



        {{-- Debut --}}
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-primary">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{ $user->profile->avatar }}"
                            alt="{{ Auth::user()->fullName() }}" />
                    </div>
                    <h2 class="text-gray-900 font-bold text-lg leading-8 my-1">{{ Auth::user()->fullName() }}</h2>
                    
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Date d'inscription</span>
                            <span class="ml-auto">{{ Auth::user()->registeredAt() }}</span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Nombre de consultations réalisées</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">8</span></span>
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 md:mx-2">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm mb-4">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">A propos de vous :</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Prénom</div>
                                <div class="px-4 py-2">{{ Auth::user()->first_name }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Nom</div>
                                <div class="px-4 py-2">{{ Auth::user()->last_name }}</div>
                            </div>
                            @if(Auth::user()->sexe())
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Sexe</div>
                                <div class="px-4 py-2">{{ Auth::user()->sexe() }}</div>
                            </div>
                            @endif
                            @if(Auth::user()->phone())
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Téléphone</div>
                                <div class="px-4 py-2">{{ Auth::user()->phone() }}</div>
                            </div>
                            @endif
                            @if(Auth::user()->facturateAddress())
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Adresse de facturation</div>
                                <div class="px-4 py-2">{!! Auth::user()->facturateAddress() !!}</div>
                            </div>
                            @endif
                            
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2 break-words">
                                    <a class="text-blue-800" href="mailto:jane@example.com">{{ Auth::user()->email }}</a>
                                </div>
                            </div>

                            @if(Auth::user()->birthday())
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Date de naissance</div>
                                <div class="px-4 py-2">{{ Auth::user()->birthday() }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <button
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Modifier mes informations personnelles
                    </button>
                    {{-- Début Form Edit Profile --}}
                    <form>
                        {{-- Identité --}}
                        <section class="w-full">
                            <h3>Identité</h3>
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Votre prénom"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="last_name" type="text" name="last_name" :value="old('last_name') ? old('last_name') : Auth::user()->last_name"
                                    required label="Votre nom"
                                    placeholder="Nom" />
                                    <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="pt-0 label label-text font-semibold">Votre genre</label>
                                    <select id="sexe" name="sexe" required class="select select-primary w-full max-w-xs">
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
                                    <x-datepicker class="input input-secondary w-full peer focus:border-none focus:ring-secondary-focus" label="Votre date de naissance" icon-right="o-calendar" :config="$dateConfig" />
                                </div>
                                <div>
                                    <x-ui.form.datetime class="input-secondary" label="Votre heure de naissance" id="time_of_birth" name="time_of_birth" type="time" />
                                    @error('time_of_birth')
                                        <x-ui.form.input-error :messages="$message" class="mt-2" />
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <div>
                                    <x-ui.form.input id="last_name" type="text" name="last_name" :value="old('last_name') ? old('last_name') : Auth::user()->last_name"
                                    required label="Ville de naissance"
                                    placeholder="Nom" />
                                    <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="last_name" type="text" name="last_name" :value="old('last_name') ? old('last_name') : Auth::user()->last_name"
                                    required label="Pays de naissance"
                                    placeholder="Nom" />
                                    <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                
                            </div>
                        </section>

                        {{-- Contact Informations --}}
                        <section class="w-full mt-4">
                            <h3>Informations de contact</h3>
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Votre email"
                                    placeholder="Email" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Votre téléphone"
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
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="N"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Type"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Nom"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Code postal"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Ville"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-ui.form.input id="first_name" type="text" name="first_name" :value="old('first_name') ? old('first_name') : Auth::user()->first_name"
                                    required label="Pays"
                                    placeholder="Prénom" />
                                    <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                            </div>
                        </section>
                    </form>
                    
                    {{-- Fin Form Edit Profile --}}
                </div>
                <!-- End of about section -->

                <!-- Experience and education -->
                <div class="bg-white p-3 shadow-sm rounded-sm">

                    <div class="grid grid-cols-2">
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Experience</span>
                            </div>
                            <ul class="list-inside space-y-2">
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Owner at Her Company Inc.</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path fill="#fff"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Education</span>
                            </div>
                            <ul class="list-inside space-y-2">
                                <li>
                                    <div class="text-teal-600">Masters Degree in Oxford</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                                <li>
                                    <div class="text-teal-600">Bachelors Degreen in LPU</div>
                                    <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
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
