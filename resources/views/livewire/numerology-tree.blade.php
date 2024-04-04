<section>

        <x-modal wire:model="birthdayModal">

            <button
                @click="$wire.birthdayModal = false"
                class="
                    absolute top-2 right-4
                    btn btn-circle btn-ghost">
                <i class="fal fa-times"></i>
            </button>

            <div wire:loading wire:target="saveBirthday" class="py-4 px-5 mx-auto">
                Calcul de vos arbres numérologiques en cours...
            </div>
            <div wire:loading.remove wire:target="saveBirthday"
                class="flex flex-wrap gap-2 py-4 px-5 mx-auto max-w-[300px]">
                @if ($hasError)
                    <div class="w-full">
                        <p class="text-error"><i class="fa-duotone fa-circle-info"></i> {{ $errorMessage }}</p>
                    </div>
                @endif
                @if (!$birthdayIsEmpty)
                <div class="w-full mb-4">
                    <p>Renseignez votre date de naissance dans le formulaire ci-après afin de calculer vos arbres numérologiques</p>
                </div>
                @else
                <div class="w-full mb-4">
                    <p>Renseignez votre date de naissance dans le formulaire ci-après afin de modifier vos arbres numérologiques</p>
                </div>
                @endif

                <div class="w-20">
                    <label class="block" for="day">Jour</label>
                    <input class="max-w-full" name="day" id="day" type="number" wire:model="day"
                        placeholder="15" />
                </div>
                <div class="w-20">
                    <label class="block" for="month">Mois</label>
                    <input class="max-w-full" name="month" id="month" type="number" wire:model="month"
                        placeholder="01" />
                </div>
                <div class="w-20">
                    <label class="block" for="year">Année</label>
                    <input class="max-w-full" name="year" id="year" type="number" wire:model="year"
                        placeholder="1991" />
                </div>
                <div class="w-full">
                    <p class="text-info-content"><i class="fa-duotone fa-circle-info"></i> Par exemple : 15/01/1991
                    </p>
                </div>
                <div class="w-full">
                <x-ui.primary-button wire:click="saveBirthday" class="block">{{ $btnText }}</x-ui.primary-button>
                </div>
            </div>
        </x-modal>

    @if (!$birthdayIsEmpty)
        <div>
            <h4>Vos arbres de vie numérologiques :</h4>
            <p>Votre date de naissance :
                <span>{{ str_pad(intval($day), 2, '0', STR_PAD_LEFT) }}</span>/<span>{{ str_pad(intval($month), 2, '0', STR_PAD_LEFT) }}</span>/<span>{{ $year }}</span>
            </p>
        </div>
    @else
        <div>
            <p>
                Pour calculer vos arbres numérologiques vous devez renseigner votre date de naissance.
            </p>
        </div>
    @endif
    <div class="md:w-full">
        <x-ui.primary-button
            wire:click="$toggle('birthdayModal')">
                {{ $btnText }}
        </x-ui.primary-button>

        @if ($hasError || !$results)
            <div class="w-full">
                <p class="text-error"><i class="fa-duotone fa-circle-info"></i> {{ $errorMessage }}</p>
            </div>
            @endif
    </div>

        @if (!$hasError && $results)
        <div class="max-w-full flex flex-col md:flex-row gap-4 justify-center">
            <div class="md:w-1/2 p-2">
                    <div class="numerology-tree flex flex-col">
                        @php
                            $totalIterationsNumerologyResults = count($results['numerologyResults']); // Remplacez par le tableau approprié
                        @endphp
                        <h4>Votre arbre numérologique de naissance :</h4>
                        <div class="flex flex-col">
                            <div class="numerology-tree--row flex flex-row justify-evenly">
                                <span>{{ str_pad(intval($day), 2, '0', STR_PAD_LEFT) }}</span>
                                <span>{{ str_pad(intval($month), 2, '0', STR_PAD_LEFT) }}</span>
                                <span>{{ $year }}</span>
                            </div>
                            @foreach ($results['numerologyResults'] as $key => $reduction)
                                <div class="numerology-tree--row flex flex-row justify-evenly {{ $key === $totalIterationsNumerologyResults - 1 ? 'numerology-tree--last--row--numerology-results' : '' }}">
                                    @foreach ($reduction as $digit)
                                        <span>{{ $digit }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                            @foreach ($results['lifePathResults'] as $reduction)
                                <div class="numerology-tree--row flex flex-row justify-evenly">
                                    @foreach ($reduction as $digit)
                                        <span>{{ $digit }}</span>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
            </div>

            <div class="md:w-1/2 p-2">
                <div class="numerology-tree flex flex-col">
                    @php
                        $totalIterationsCurrentYearResults = count($results['numerologyCurrentYearResults']); // Remplacez par le tableau approprié
                    @endphp
                        <h4>Votre arbre numérologique de l'année : </h4>
                        <p><i>Votre âge : {{ $age }}ans</i></p>
                        <div class="flex flex-col">
                                <div class="numerology-tree--row flex flex-row justify-evenly">
                                    <span>{{ str_pad(intval($day), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ str_pad(intval($month), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ $currentYear }}</span>
                                </div>
                                @foreach ($results['numerologyCurrentYearResults'] as $key => $reduction)
                                    <div class="numerology-tree--row flex flex-row justify-evenly {{ $key === $totalIterationsCurrentYearResults - 1 ? 'numerology-tree--last--row--numerology-results' : '' }}">
                                        @foreach ($reduction as $digit)
                                            <span>{{ $digit }}</span>
                                        @endforeach
                                    </div>
                                @endforeach
                                @foreach ($results['currentYearResults'] as $reduction)
                                    <div class="numerology-tree--row flex flex-row justify-evenly">
                                        @foreach ($reduction as $digit)
                                            <span>{{ $digit }}</span>
                                        @endforeach
                                    </div>
                                @endforeach
                        </div>

                        <div class="flex flex-row justify-center gap-8">
                            <x-ui.primary-button wire:click='decrementYear'>Année précédente</x-ui.primary-button>
                            <x-ui.primary-button wire:click='incrementYear'>Année suivante</x-ui.primary-button>
                            @if($currentYear != date('Y'))
                                <x-ui.primary-button wire:click='resetCurrentYear'>Année actuelle</x-ui.primary-button>
                            @endif
                        </div>
                    </div>
            </div>
        @endif


    </div>
</section>
