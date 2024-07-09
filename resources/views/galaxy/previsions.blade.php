<x-app-layout>
    @section('css')
        @vite(['resources/css/add/numerology_tree.css'])
    @endsection
    @section('js')
        @vite(['resources/js/add/previsions/lunar.js', 'resources/js/add/previsions/numerology.js'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Entre lune et tarot, découvrez vos prévisions et faites la lumière sur votre Destinée.
        </h2>
    </x-slot>


    {{-- <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

                @livewire('numerology-tree', ['user' => $user])

            </article> --}}

    {{-- <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                @livewire('tarot-scope', ['user' => $user])

                {{-- <x-tarot.tarot-interpretation /> --}}
    {{-- </article> --}}

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        <h3 class="mb-6" id="season_text"></h3>

        <section class="mb-4" id="numerology_details">
            <div id="numerology_details_content">

                <div>
                    <h2>Vos prévisions personnelles :</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae nostrum quisquam tempore assumenda vero incidunt nam unde provident neque alias ipsum exercitationem repellat fuga ullam dicta repellendus, nemo consequatur!</p>

                    <div id="numerology_details_content_header" class="flex flex-wrap items-center bg-secondary p-6 justify-center md:justify-between gap-4 md:flex-row-reverse min-h-[136px] max-w-[800px] mb-4 mt-6 mx-auto">
                        <h4 class="text-center">Votre date de naissance : <span class="birthdate_path"></span></h4>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-6 grid-cols-1 gap-4 my-8 justify-center items-baseline">
                    <div class="md:col-span-6">
                        <h3>Les chiffres de votre naissance :</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae nostrum quisquam tempore assumenda vero incidunt nam unde provident neque alias ipsum exercitationem repellat fuga ullam dicta repellendus, nemo consequatur!</p>
                    </div>

                    <div class="md:col-span-3">
                        <div class="relative flex gap-4 flex-col md:flex-row p-4 bg-indigo-400 w-full h-full m-auto border-t-2">
                            <div class="life_path relative mt-6 mb-8 min-w-24 bg-indigo-400 text-xl flex justify-center items-center rounded-full after:w-16 after:h-16 after:absolute after:border after:border-white after:rotate-45 before:w-16 before:h-16 before:absolute before:border before:border-white"></div>
                            <div id="container_life_path"></div>
                        </div>
                    </div>

                    <div class="md:col-span-3 mt-4 md:mt-auto h-full">
                        <div class="relative flex gap-4 flex-col md:flex-row p-4 bg-amber-500 w-full h-full m-auto border-t-2">
                            <div class="annual_path relative mt-6 mb-8 min-w-24 bg-amber-500 text-xl flex justify-center items-center rounded-full after:w-16 after:h-16 after:absolute after:border after:border-white after:rotate-45 before:w-16 before:h-16 before:absolute before:border before:border-white"></div>
                            <div id="container_annual_path"></div>
                        </div>
                    </div>

                    <div class="md:col-span-6 md:flex md:justify-center mt-4">
                        <div class="relative flex gap-4 flex-col md:flex-row p-4 bg-teal-500 w-full h-full m-auto border-t-2 md:w-1/2">
                            <div class="sum_path relative mt-6 mb-8 min-w-24 bg-teal-500 text-xl flex justify-center items-center rounded-full after:w-16 after:h-16 after:absolute after:border after:border-white after:rotate-45 before:w-16 before:h-16 before:absolute before:border before:border-white"></div>
                            <div id="container_sum_path"></div>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-6 grid-cols-1 gap-2 my-8 justify-center items-baseline">
                    <div class="md:col-span-6">
                        <h3>Les arcanes de votre naissance : </h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae nostrum quisquam tempore assumenda vero incidunt nam unde provident neque alias ipsum exercitationem repellat fuga ullam dicta repellendus, nemo consequatur!</p>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_life_path mt-2 text-center bg-indigo-400 px-4 py-5"></div>
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_annual_path mt-2 text-center bg-amber-500 px-4 py-5"></div>
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_sum_path mt-2 text-center bg-teal-500 px-4 py-5"></div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <ul>
        <li id="lunar_phase_text"></li>
        <li id="lunar_phase_emoji"></li>
        <li id="lunar_is_waxing"></li>
        <li id="lunar_is_waning"></li>
        <li id="lunar_age"></li>
        </ul>

        @if($drawCards->count() > 0)
        <h3 class="mt-6">Tirages de Tarot : </h3>
        <ul>
            @foreach ($drawCards as $draw)
                <li><a href="{{ route('my_space.previsions.tarot') }}#{{ $draw->slug }}">{{ $draw->name }}</a></li>
            @endforeach
        </ul>
        @endif

    </article>

</x-app-layout>
