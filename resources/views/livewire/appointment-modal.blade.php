<div>

    <a href="#" wire:click.prevent="openModal()"
        class="outline-none block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white hover:opacity-75 active:opacity-75 focus:opacity-75 transition-all"><i
            class="fa-thin fa-calendar"></i> Prendre RDV</a>

    <x-modal wire:model="appointmentModal">

        {{-- Loader --}}
        <div class="relative" wire:loading>
            <x-ui.loader :loadingText="false" :overlay="false" />
        </div>
        {{-- Fin Loader --}}

        <header x-data class="sticky top-0 flex align-middle justify-between items-center py-2 px-4 bg-base-300 z-50
        before:absolute before:top-[-2.75rem] before:w-full before:h-11 before:bg-base-100">
            <div class="w-[48px]">
                <button x-show="$wire.activeStep > 1" @click="$wire.prevStep()" class="btn btn-circle btn-ghost">
                    <i class="fal fa-arrow-left"></i>
                </button>
            </div>

            <div class="badge text-xs">{{ $activeStep }} / {{ $totalStep }}</div>

            <button @click="$wire.closeModal()" class="btn btn-circle btn-ghost">
                <i class="fal fa-times"></i>
            </button>
        </header>


        <div class="flex flex-wrap gap-2 py-4 px-5 mx-auto">
            <div x-data class="w-full">

                @php
                    dump('appointment //array ', $appointment);
                    dump('session appointment //array ', session('appointment_form'));
                    
                    
                    
                    
                    
                    dump('writingConsultationQuestion ', $writingConsultationQuestion);
                    
                    dump('session(appointment_form.writing_consultation) ', session('appointment_form.writing_consultation'));
                @endphp
                <br>
                <br>
                <br>

                {{-- Début Step 1 : Selection du mode de consultation --}}
                <section x-show="$wire.activeStep == 1">
                    <h3 class="my-5">Pour prendre rendez-vous, suivez les étapes ci-après :</h3>

                    <h4 class="mb-4">1 - Choisissez un mode de consultation</h4>

                    <div class="flex flex-col gap-4 justify-start content-start align-middle">
                        @foreach ($services as $service)
                            @if($service->stripe_price_id == 'price_1OjKbnLzRFCnOVo763YXK88S')
                                <button wire:click="selectAppointmentType('phone')" @class([
                                    'consultation_type text-left px-4 py-2 border border-solid border-white/30 transition-all hover:border-primary/50 focus:border-primary/50 hover:text-primary focus:text-primary',
                                    '!border-primary/50 shadow-sm shadow-primary/50 !text-primary cursor-default' =>
                                        $appointmentType == 'phone',
                                ])>{{ $service->name }}</button>
                            @elseif($service->stripe_price_id == 'price_1OjX7aLzRFCnOVo7IgNnkDO0')
                                <button wire:click="selectAppointmentType('tchat')" @class([
                                    'consultation_type text-left px-4 py-2 border border-solid border-white/30 transition-all hover:border-primary/50 focus:border-primary/50 hover:text-primary focus:text-primary',
                                    '!border-primary/50 shadow-sm shadow-primary/50 !text-primary cursor-default' =>
                                        $appointmentType == 'tchat',
                                ])>{{ $service->name }}</button>
                            @elseif($service->stripe_price_id == 'price_1OjKamLzRFCnOVo7ZUMaJAPa')
                                <button wire:click="selectAppointmentType('writing')" @class([
                                    'consultation_type text-left px-4 py-2 border border-solid border-white/30 transition-all hover:border-primary/50 focus:border-primary/50 hover:text-primary focus:text-primary',
                                    '!border-primary/50 shadow-sm shadow-primary/50 !text-primary cursor-default' =>
                                        $appointmentType == 'writing',
                                ])>{{ $service->name }}</button>
                            @endif
                        @endforeach 
                    </div>

                    @if ($appointmentType)
                        <x-ui.primary-button class="btn-sm mt-4 float-right"
                            @click="$wire.nextStep()">Suivant</x-ui.primary-button>
                    @endif

                </section>
                {{-- Fin Step 1 --}}

                {{-- Début Step 2 --}}
                <section x-show="$wire.activeStep == 2">

                    <h4 class="mb-4">2 - @guest S'enregistrer @else Vos informations de naissance @endguest</h4>

                    {{-- Début Si l'utilisateur n'est pas connecté ou inscrit : Connexion ou inscription --}}
                    @guest
                        <div role="alert" class="mb-4 alert alert-info">
                            <i class="fa-duotone fa-message"></i>
                            <span>Vous devez vous connecter pour poursuivre</span>
                        </div>

                        <div x-data="{ show: 'login' }">
                            {{-- Début Formulaire de Connexion --}}
                            <template x-if="show == 'login'">
                                <div>
                                    <!-- Session Status -->
                                    @if (session('error'))
                                        <div class="alert alert-error mb-4">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form>
                                        @csrf

                                        <!-- Email Address -->
                                        <div>
                                            <x-ui.form.input wire:model="email" class="block w-full" type="email"
                                                name="email" :value="old('email')" required autofocus autocomplete="email"
                                                label="Votre adresse email de connexion " placeholder="Votre adresse email"
                                                icon="o-user" />
                                            @error('email')
                                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-ui.form.input wire:model="password"
                                                class="block w-full focus:ring-primary-focus" type="password"
                                                name="password" required autofocus autocomplete="current-password"
                                                label="Votre mot de passe de connexion " placeholder="******"
                                                icon="o-key" />
                                            @error('password')
                                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                                            @enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <label for="remember" class="inline-flex items-center">
                                                <x-checkbox wire:model="remember" name="remember"
                                                    label="{{ __('Remember') }}"
                                                    class="focus:ring-primary-focus  checkbox-sm" />
                                            </label>
                                        </div>

                                        <div class="flex items-center justify-center mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot') }}
                                                </a>
                                            @endif

                                            <x-ui.primary-button class="ml-3 btn-sm" wire:click.prevent='userLogin()'>
                                                {{ __('Login') }}
                                            </x-ui.primary-button>
                                        </div>
                                    </form>
                                    <div class="mt-4 text-center">
                                        <a class="inline-block opacity-50 px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                                            href="#" @click.prevent="show = 'register'">
                                            Pas encore inscrit ?
                                        </a>
                                    </div>

                                </div>
                            </template>
                            {{-- Fin Formulaire de Connexion --}}
                            {{-- Début Formulaire d'inscription --}}
                            <template x-if="show == 'register'">
                                <div>
                                    <form>
                                        @csrf

                                        <!-- FirstName -->
                                        <div>
                                            <x-ui.form.input wire:model="first_name"
                                                class="block w-full focus:ring-primary-focus" type="text"
                                                name="first_name" :value="old('first_name')" required autofocus
                                                autocomplete="given-name" label="Votre prénom" placeholder="Votre prénom"
                                                icon="o-user" />
                                            <x-ui.form.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                        </div>

                                        <!-- LastName -->
                                        <div class="mt-4">
                                            <x-ui.form.input wire:model="last_name"
                                                class="block w-full focus:ring-primary-focus" type="text"
                                                name="last_name" :value="old('last_name')" required autofocus
                                                autocomplete="family-name" label="Votre nom" placeholder="Votre nom"
                                                icon="o-user" />
                                            <x-ui.form.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <x-ui.form.input wire:model="email"
                                                class="block w-full focus:ring-primary-focus" type="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="email"
                                                label="Votre adresse email de connexion" placeholder="Votre adresse email"
                                                icon="o-user" />
                                            <x-ui.form.input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-ui.form.input wire:model="password"
                                                class="block w-full focus:ring-primary-focus" type="password"
                                                name="password" required autofocus autocomplete="new-password"
                                                label="Votre mot de passe de connexion" placeholder="******"
                                                icon="o-key" />
                                            <x-ui.form.input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-ui.form.input wire:model="password_confirmation"
                                                class="block w-full focus:ring-primary-focus" type="password"
                                                name="password_confirmation" required autofocus
                                                autocomplete="new-password" label="Confirmez votre mot de passe"
                                                placeholder="******" icon="o-key" />
                                            <x-ui.form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="flex items-center justify-center mt-4">
                                            <a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out"
                                                href="#" @click.prevent="show = 'login'">
                                                Déjà inscrit ?
                                            </a>

                                            <x-ui.primary-button class="ml-3 btn-sm" wire:click.prevent='registerUser()'>
                                                {{ __('Register') }}
                                            </x-ui.primary-button>
                                        </div>
                                    </form>
                                </div>

                            </template>
                            {{-- Fin Formulaire d'inscription --}}
                        </div>

                    @endguest
                    {{-- Fin début Si l'utilisateur n'est pas connecté ou inscrit : Connexion ou inscription --}}


                    {{-- Début Si l'utilisateur est connecté --}}
                    @auth
                        {{-- Début Si le mode de consultation est écrite //writing --}}
                        @if ($appointmentType == 'writing')
                        <section>
                            @if ($userProfile->birthday)
                            <p>Vous êtes sur le point de faire une demande de consultation par écrit, merci de confirmer les
                            informations suivantes avant de poursuivre :</p>
                            @endif

                            <div class="py-6 px-4 mt-2 rounded bg-base-300/75">

                                {{-- Début Date de naissance --}}
                                @php
                                    $dateConfig = ['altFormat' => 'd/m/Y'];
                                @endphp
                                <div x-data="{open: false}">
                                    @if ($userProfile->birthday)
                                        <p class="mb-4">Vous êtes né(e) le : <span class="badge badge-secondary">{{ Carbon\Carbon::parse($userProfile->birthday)->translatedFormat('l j F Y') }}</span></p>

                                        <button class="btn btn-secondary btn-outline btn-sm mb-4 flex flex-nowrap w-full justify-between items-center align-middle" @click="open = !open">
                                            <span>Modifier votre date de naissance</span>
                                            <i class="opacity-0 sm:opacity-100 fa-thin hidden md:visible" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                        </button>
                                        <div x-show="open" x-transition>
                                            <form class="mt-4">


                                                <x-datepicker class="input-secondary" label="Votre date de naissance" wire:model="birthday" icon-right="o-calendar" :config="$dateConfig" />

                                                <x-ui.secondary-button class="btn-sm btn-secondary btn-outline mt-3 float-right" wire:click.prevent="saveBirthday">Enregistrer ma date de naissance</x-ui.secondary-button>
                                                <div class="clear-both"></div>
                                            </form>
                                        </div>
                                    @else
                                        <div role="alert" class="alert alert-info">
                                            <div>
                                                <p>Merci de saisir votre date de naissance ci-dessous (celle-ci sera enregistrée dans votre profil personnel)</p>
                                                <em class="inline-block mt-4">J'utilise votre date de naissance afin de mettre en pratique mes connaissances numérologiques. Utiles pour moi lorsque je réponds à votre question par écrit.</em>
                                            </div>
                                        </div>


                                        <form class="mt-4">
                                            <x-datepicker class="input input-secondary w-full peer focus:border-none focus:ring-secondary-focus" label="Votre date de naissance" wire:model="birthday" icon-right="o-calendar" :config="$dateConfig" />

                                            <x-ui.secondary-button class="btn-sm btn-outline mt-3 float-right" wire:click.prevent="saveBirthday">Enregistrer ma date de naissance</x-ui.secondary-button>
                                            <div class="clear-both"></div>
                                        </form>
                                    @endif
                                </div>
                                {{-- Fin Date de naissance --}}

                                {{-- Début Heure de naissance --}}
                                @if ($userProfile->birthday)
                                    <div x-data="{open: false}" class="mt-4">
                                        @if ($userProfile->astrology)
                                            @if(isset($userProfile->astrology->time_of_birth))
                                                <p class="mb-4">Vous êtes né(e) à : <span class="badge badge-secondary">{{ $userProfile->astrology->time_of_birth }}</span></p>
                                            @endif
                                            @if(isset($userProfile->astrology->native_country))
                                                <p class="mb-4">Vous êtes né(e) en : <span class="badge badge-secondary">{{ $userProfile->astrology->native_country }}</span></p>
                                            @endif
                                            @if(isset($userProfile->astrology->city_of_birth))
                                                <p class="mb-4">Vous êtes né(e) dans la ville de : <span class="badge badge-secondary">{{ $userProfile->astrology->city_of_birth }}</span></p>
                                            @endif

                                            <button class="btn btn-secondary btn-outline btn-sm mb-4 flex flex-nowrap w-full justify-between items-center align-middle" @click="open = !open">
                                                <span>Modifier vos informations de naissance</span>
                                                <i class="fa-thin" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                            </button>
                                            <div x-show="open" x-transition>
                                                <form class="mt-4">
                                                    <div>
                                                        <x-ui.form.datetime class="input-secondary" label="Votre heure de naissance" wire:model="time_of_birth" type="time" />
                                                        @error('time_of_birth')
                                                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                        @enderror
                                                    </div>
                                                    <div class="mt-3 md:flex md:flex-row md:gap-2">
                                                        <div class="mt-3">
                                                            <x-ui.form.input wire:model="city_of_birth" class="input-secondary block w-full" type="text" :value="old('city_of_birth')" label="Votre ville de naissance" placeholder="Ville de naissance" />
                                                            @error('city_of_birth')
                                                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                            @enderror
                                                        </div>
                                                        <div class="mt-3">
                                                            <x-ui.form.input wire:model="native_country" class="input-secondary block w-full" type="text" :value="old('native_country')" label="Votre pays de naissance" placeholder="Pays de naissance" />
                                                            @error('native_country')
                                                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <x-ui.secondary-button class="btn-sm btn-outline mt-3 float-right" wire:click.prevent="saveNativeInformation()">Enregistrer mes informations de naissance</x-ui.secondary-button>
                                                    <div class="clear-both"></div>

                                                </form>
                                            </div>
                                        @else
                                            <div x-data="{open: false}">

                                                <button class="btn btn-secondary btn-outline btn-sm mb-4 flex flex-nowrap w-full justify-between items-center align-middle" @click="open = !open">
                                                    <span>Compléter vos informations de naissance</span>
                                                    <i class="fa-thin" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                                </button>

                                                <div x-show="open" x-transition>
                                                    <div role="alert" class="alert alert-info">
                                                        <div>
                                                            <p>Vous connaissez votre heure de naissance ? Vous pouvez renseigner votre heure de naissance et votre lieu de naissance, ces informations sont <em>optionnelles</em>.</p>
                                                            <em class="inline-block mt-4">Cela peut m'être utile pour réaliser votre thème astrologique. Ces informations ne sont pas indispensables, rassurez-vous, choisissez de renseigner celles que vous connaissez.</em>
                                                        </div>
                                                    </div>

                                                    <form class="mt-4">
                                                        <div>
                                                            <x-ui.form.datetime class="input-secondary" label="Votre heure de naissance" wire:model="time_of_birth" type="time" />
                                                            @error('time_of_birth')
                                                                <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                            @enderror
                                                        </div>
                                                        <div class="mt-3 md:flex md:flex-row md:gap-2">
                                                            <div class="mt-3">
                                                                <x-ui.form.input wire:model="city_of_birth" class="input-secondary block w-full" type="text" :value="old('city_of_birth')" label="Votre ville de naissance" placeholder="Ville de naissance" />
                                                                @error('city_of_birth')
                                                                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                                @enderror
                                                            </div>
                                                            <div class="mt-3">
                                                                <x-ui.form.input wire:model="native_country" class="input-secondary block w-full" type="text" :value="old('native_country')" label="Votre pays de naissance" placeholder="Pays de naissance" />
                                                                @error('native_country')
                                                                    <x-ui.form.input-error :messages="$message" class="mt-2" />
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <x-ui.secondary-button class="btn-sm btn-outline mt-3 float-right" wire:click.prevent="saveNativeInformation()">Enregistrer mes informations de naissance</x-ui.secondary-button>
                                                        <div class="clear-both"></div>

                                                    </form>
                                                </div>
                                            </div>

                                        @endif
                                    </div>
                                @endif
                                {{-- Fin Heure de naissance --}}

                            </div>

                        </section>
                        {{-- Fin Si le mode de consultation est écrite //writing --}}

                        {{-- Début Si le mode de consultation est par téléphone ou par tchat //phone - tchat --}}
                        @else
                        <section class="py-6 px-4 mt-2 rounded bg-base-300/75">
                            <p>
                                Avant de poursuivre, merci de confirmer votre identité :
                                <br>
                                Vous êtes connecté(e) en tant que : {{ Auth::user()->fullName() }}
                            </p>
                        </section>
                            
                        @endif
                        {{-- Fin Si le mode de consultation est par téléphone ou par tchat //phone - tchat --}}

                        {{-- Début NextStep --}}

                        @if ($userProfile->birthday || $appointmentType != 'writing')
                            <x-ui.primary-button class="btn-sm mt-4 float-right" @click="$wire.nextStep()">Suivant</x-ui.primary-button>
                        @endif
                        {{-- Fin NextStep --}}
                    @endauth
                    {{-- Fin Si l'utilisateur est connecté --}}


                </section>
                {{-- Fin Step 2 --}}

                {{-- Début Step 3 : Si le mode de consultation est par écrit : Rédaction de la question --}}
                {{--                Si le mode de consultation est par tel ou tchat : choix du moment --}}
                <section x-show="$wire.activeStep == 3">

                    @if ($appointmentType != 'writing')
                        <h4 class="mb-4">3 - Choisissez la date de consultation</h4>
                        <div>
                            @foreach ($timeSlotDays as $timeSlotDay)
                                <div
                                    class="group day bg-base-300 mb-4 py-4 px-6 hover:shadow-lg hover:ring-2 hover:ring-neutral-900/25 transition-all">

                                    <div
                                        class="relative inline-block mb-5 pb-3 text-neutral-200
                                after:absolute after:bottom-0 after:left-0 after:h-1 after:w-[60%] after:origin-leftz after:rounded-sm after:bg-neutral-100/75
                                after:transition-all group-hover:after:w-full">
                                        {{ $timeSlotDay['dayFormatte'] }}
                                    </div>
                                    <div class="hours grid grid-cols-3 gap-3">

                                        {{-- Ajouter une propriété ActiveTimeSlot sur le composant --}}
                                        {{-- Au clic sur le bouton, rajouter l'id du timeslot cliqué --}}
                                        {{-- Dans la vue si l'id correspond au bouton cliqué lui ajouter la classe active --}}
                                        {{--  --}}

                                        @if (collect($timeSlotDay['time_slots'])->isNotEmpty())
                                            @foreach ($timeSlotDay['time_slots'] as $slotTime)
                                                <button
                                                    wire:click="selectTimeSlot({{ $timeSlotDay['id'] }}, {{ $slotTime['id'] }})"
                                                    @class([
                                                        'hour btn btn-primary btn-sm',
                                                        'hidden' => !$slotTime[
                                                            'pivot'
                                                        ]['available'],
                                                    ])>{{ Carbon\Carbon::parse($slotTime['start_time'])->format('H\hi') }}</button>
                                            @endforeach
                                        @else
                                            <p class="text-neutral-400">Aucun créneau horaire disponible pour cette
                                                journée.</p>
                                        @endif


                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            @if ($offsetTimeSlot >= 5)
                                <button wire:click="prevTimeSlots()"
                                    class="block mx-auto mt-8 w-64 max-w-full btn btn-sm btn-secondary btn-outline col-start-1 col-end-2">Créneaux
                                    précédents</button>
                            @endif
                            @if ($offsetTimeSlot <= $totalOffsetTimeSlot - 1)
                                <button wire:click="nextTimeSlots()"
                                    class="block mx-auto mt-8 w-64 max-w-full btn btn-sm btn-secondary btn-outline col-start-2 col-end-3">Créneaux
                                    suivants</button>
                            @endif
                        </div>
                    @else
                        <h4 class="mb-4">3 - Décrivez votre demande ci-dessous</h4>

                        <div class="alert mb-4">

                            <p>Je réponds généralement aux questions qui vous concernent directement. Si d'autres
                                personnes
                                ont une importance dans votre demande, merci de renseigner les dates de naissance de ces personnes si
                                vous les
                                connaissez.
                                Je ne traite pas les questions trop vagues ou trop évasives. Si je ne comprends pas le sens
                                de
                                votre demande, je pourrai être amené à vous contacter pour vous demander plus de
                                renseignements au besoin. </p>

                        </div>

                        <x-ui.form.textarea wire:model="writingConsultationQuestion"
                            placeholder="Renseignez votre demande ici..." rows="5" inline></x-ui.form.textarea>
                        @error('writingConsultationQuestion')
                            <x-ui.form.input-error :messages="$message" class="mt-2" />
                        @enderror

                    @endif

                    @auth
                        @if ($appointmentType)
                            @if ($timeSlotDayId && $timeSlotId)
                                <x-ui.primary-button class="btn-sm mt-4 float-right"
                                    @click="$wire.nextStep()">Suivant</x-ui.primary-button>
                            @elseif ($appointmentType == 'writing')
                                <x-ui.primary-button class="btn-sm mt-4 float-right"
                                    @click="$wire.nextStep()">Suivant</x-ui.primary-button>
                            @endif
                        @endif
                    @endauth




                </section>
                {{-- Fin Step 3 --}}

                {{-- Début Step 4 : Récapitulatif de la question si demande écrite sinon récapitulatif du moment --}}
                <section x-show="$wire.activeStep == 4">

                    <h4 class="mb-4">4 - Confirmation de votre demande</h4>

                    @if (isset($writingConsultation['question']) && $appointmentType == 'writing')
                        <div class="alert mb-4">Merci de confirmer votre demande de consultation par écrit :</div>
                        <div class="max-w-full break-words alert mb-4">
                            <div>
                                <span class="block mb-2 text-secondary">Votre question : </span>
                                <p>"{{ $writingConsultation['question'] }}"</p>
                            </div>

                        </div>
                    @else {
                        Merci de confirmer votre demande rendez-vous :

                        <ul>
                            <li>Date : </li>
                            <li>Moment : de à </li>
                        </ul>
                    }
                    @endif

                    @auth
                        @if ($appointmentType)
                            <x-ui.secondary-button class="btn-sm btn-outline mt-4 float-left"
                                    @click="$wire.prevStep()">Modifier</x-ui.secondary-button>
                            <x-ui.primary-button class="btn-sm mt-4 float-right"
                                @click="$wire.nextStep()">Confirmer</x-ui.primary-button>
                        @endif
                    @endauth


                </section>
                {{-- Fin Step 4 --}}

                {{-- Début Step 5 : Paiement --}}
                <section x-show="$wire.activeStep == 5">

                    <h4 class="mb-4">5 - Paiement</h4>

                    @if(!$hasError)
                        Votre demande : Question par email
                        Montant à payer : {{ $priceForHuman }}
                    @else
                        Merci de corriger les erreurs pour continuer.
                    @endif

                    @auth
                        @if ($appointmentType)
                            <x-ui.primary-button class="btn-sm mt-4 float-right"
                                @click="$wire.nextStep({{ $totalStep }})">Valider ma demande et accéder au paiement</x-ui.primary-button>
                        @endif
                    @endauth

                </section>
                {{-- Fin Step 5 --}}

            </div>
        </div>
    </x-modal>
</div>
