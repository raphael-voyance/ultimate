<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/tarot/tarot.js")
        @vite("resources/js/add/universe/tarot/tarot.css")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.tarot.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span>{{ $card->name }} arcane {{ $card->numberArcane }}</span>
            </div>
        </h2>
    </x-slot>

    <section data-update-route="{{ route('admin.tarot.update', $card->slug) }}">
        <header class="relative flex justify-center flex-wrap gap-2 mb-8 pb-8 after:absolute after:w-1/2 after:-translate-x-1/2 after:h-[2px] after:rounded after:bottom-0 after:left-1/2 after:bg-white/50">
            <a href="{{ route('admin.tarot.index') }}" class="btn btn-sm">Toutes les cartes</a>
        </header>

        <section class="grid grid-cols-4 gap-2 relative md:-left-12">
            <div>
                <img class="w-32 m-auto mr-1" src="{{ $card->imgPath }}" alt="Image {{ $card->name }}" />
            </div>
            <div class="col-span-3 flex flex-col justify-between">
                <ul>
                    <li class="flex gap-1 items-baseline min-h-9">
                        <span>
                            <u>Arcane</u> : 
                        </span>
                        @php
                            $dataTransformInput = [
                                'value' => $card->name,
                                'field' => 'name',
                                'inputType' => 'input'
                            ];
                        @endphp
                        <span class="p-1" data-transform-input='@json($dataTransformInput)'>{{ $card->name }}</span>
                    </li>

                    <li class="flex gap-1 items-baseline min-h-9">
                        <span>
                            <u>Arcane numéro</u> :
                        </span>
                        <span>{{ $card->numberArcane }}</span>
                    </li>

                    <li class="flex flex-col gap-1 items-baseline">
                        <span>
                            <u>Description générale</u> : 
                        </span>
                        @php
                            $dataTransformInput = [
                                'value' => $card->description,
                                'field' => 'description',
                                'inputType' => 'textarea'
                            ];
                        @endphp
                        <p data-transform-input='@json($dataTransformInput)'>{{ $card->description }}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="my-8 p-3 rounded bg-base-100">
            <h4>{{ $card->name }} dans les différents tirages : </h4>

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">A la coupe : </span></h5>
                
                    @foreach ($interpretations->cut as $k => $i)
                    <div class="px-8 relative z-20">
                        <h6 class="py-1 px-2 mb-1 relative inline-block bg-teal-900">En position {{ $k }}</h6>
                        @php
                            $dataTransformInput = [
                                'value' => $i == '' ? 'Aucune interprétation enregistrée pour cette position' : $i,
                                'draw' => 'cut',
                                'position' => $k,
                                'field' => 'interpretation',
                                'inputType' => 'textarea'
                            ];
                        @endphp
                        @if($i == '')
                        <div class="flex flex-col gap-1 items-baseline">
                            <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                        </div>
                        @else
                        <div class="flex flex-col gap-1 items-baseline">
                            <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $i }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                
            </div>

            @foreach ($draws as $d)
            @php
                $s = $d->slug;
            @endphp

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">{{ $d->name }}</span></h5>
                
                    @foreach ($interpretations->$s as $k => $i)
                    <div class="px-8 relative z-20">
                        <h6 class="py-1 px-2 mb-1 relative inline-block bg-teal-900">En position {{ $k }}</h6>
                        @php
                            $dataTransformInput = [
                                'value' => $i == '' ? 'Aucune interprétation enregistrée pour cette position' : $i,
                                'draw' => $s,
                                'position' => $k,
                                'field' => 'interpretation',
                                'inputType' => 'textarea'
                            ];
                        @endphp
                        @if($i == '')
                        <div class="flex flex-col gap-1 items-baseline">
                            <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                        </div>
                        @else
                        <div class="flex flex-col gap-1 items-baseline">
                            <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $i }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                
            </div>
                
                
            @endforeach
        </section>

        <section class="my-8 p-3 rounded bg-base-100">
            <h4>{{ $card->name }} numérologique : </h4>

            {{-- {{ dd($numerology) }} --}}

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Arcane de naissance :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numerology->lifePath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numerology->lifePath,
                            'field' => 'numerology',
                            'arcanePath' => 'lifePath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numerology->lifePath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numerology->lifePath }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Arcane de l'année :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numerology->annualPath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numerology->annualPath,
                            'field' => 'numerology',
                            'arcanePath' => 'annualPath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numerology->annualPath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numerology->annualPath }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Arcane des énergies secrètes :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numerology->sumPath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numerology->sumPath,
                            'field' => 'numerology',
                            'arcanePath' => 'sumPath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numerology->sumPath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numerology->sumPath }}</p>
                    </div>
                    @endif
                </div>
            </div>






        </section>

    </section>

</x-admin-layout>