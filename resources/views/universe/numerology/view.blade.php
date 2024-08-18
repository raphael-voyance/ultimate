<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/numerology/numerology.js")
        @vite("resources/js/add/universe/numerology/numerology.css")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.numerology.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span> Le {{ $number->name }} : </span>
            </div>
        </h2>
    </x-slot>

    <section data-update-route="{{ route('admin.numerology.update', $number->number) }}">
        <header class="relative flex justify-center flex-wrap gap-2 mb-8 pb-8 after:absolute after:w-1/2 after:-translate-x-1/2 after:h-[2px] after:rounded after:bottom-0 after:left-1/2 after:bg-white/50">
            <a href="{{ route('admin.numerology.index') }}" class="btn btn-sm">Tous les nombres</a>
        </header>

        <section class="grid grid-cols-4 gap-2">
            <div class="flex justify-center items-center">
                <span class="text-8xl cursor-default">{{ $number->number }}</span>
            </div>
            <div class="col-span-3 flex flex-col justify-between">
                <ul>
                    <li class="flex gap-1 items-baseline min-h-9">
                        <span>
                            <u>Chiffre</u> : 
                        </span>
                        <span class="p-1">{{ $number->name }} - {{ $number->number }}</span>
                    </li>

                    <li class="flex flex-col gap-1 items-baseline">
                        <span>
                            <u>Description générale</u> : 
                        </span>
                        @php
                            $dataTransformInput = [
                                'value' => $number->description,
                                'field' => 'description',
                                'inputType' => 'textarea'
                            ];
                        @endphp
                        <p data-transform-input='@json($dataTransformInput)'>{{ $number->description }}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="my-8 p-3 rounded bg-base-100">
            <h4>{{ $number->name }} numérologique : </h4>

            @php
                $numberInterpretations = json_decode($number->interpretations);
            @endphp

            {{-- {{ dd($numberInterpretations) }} --}}

            {{-- {{ dd($number) }} --}}

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Chemin de vie :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numberInterpretations->lifePath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numberInterpretations->lifePath,
                            'field' => 'interpretation',
                            'pathType' => 'lifePath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numberInterpretations->lifePath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numberInterpretations->lifePath }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Année personnelle :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numberInterpretations->annualPath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numberInterpretations->annualPath,
                            'field' => 'interpretation',
                            'pathType' => 'annualPath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numberInterpretations->annualPath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numberInterpretations->annualPath }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-3 mb-12 relative after:absolute after:border-2 after:rounded after:border-teal-900 after:w-full after:h-full after:top-[25px] after:left-0">
                <h5 class="mb-8 relative z-10 text-lg text-center">
                    <span class="py-2 px-4 bg-teal-900">Le potentiel caché :</span></h5>
                
                <div class="px-8 relative z-20">
                    @php
                        $dataTransformInput = [
                            'value' => $numberInterpretations->sumPath == '' ? 'Aucune interprétation enregistrée pour cette position' : $numberInterpretations->sumPath,
                            'field' => 'interpretation',
                            'pathType' => 'sumPath',
                            'inputType' => 'textarea'
                        ];
                    @endphp
                    @if($numberInterpretations->sumPath == '')
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>Aucune interprétation enregistrée pour cette position</p>
                    </div>
                    @else
                    <div class="flex flex-col gap-1 items-baseline">
                        <p class="mb-4" data-transform-input='@json($dataTransformInput)'>{{ $numberInterpretations->sumPath }}</p>
                    </div>
                    @endif
                </div>
            </div>






        </section>

    </section>

</x-admin-layout>