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

        
        
        <header class="flex flex-row flex-nowrap justify-center mb-4">

            <div>
                <div style="box-shadow: 4px 1px 20px 0px white; border-radius: 50%;" class="m-auto h-36 w-36">
                    <img class="m-auto w-36" id="lunar_img" />
                </div>
                <h5 class="m-auto mt-3" id="lunar_img_title" />
            </div>
            {{-- <div class="w-1/2">
                <h3 class="mb-6" id="season_text"></h3>
            </div> --}}
        </header>
        

        <section class="mb-4" id="numerology_details">
            <div id="numerology_details_content">
                    <div id="numerology_details_content_header" class="relative flex flex-wrap items-center bg-secondary p-6 pt-0 justify-center md:justify-between gap-4 md:flex-row-reverse min-h-[136px] max-w-full mb-4 mt-6 mx-auto rounded">
                        <div>
                            <h2 class="mb-2">Vos prévisions personnelles :</h2>
                            <p>Cette page vous est consacrée. Elle évoluera au fur et à mesure du temps avec de nouvelles fonctionnalités. Vous retrouverez des interprétations personnalisées en fonction de votre date de naissance. Plongez dans les secrets de vos arcanes cachés pour stimuler votre réalisation personnelle. Bien entendu, ces interprétations sont à prendre avec du recul, elles ne déterminent d'aucune façon vos choix ou actions à entreprendre. Il s'agit de représentations symboliques pouvant vous guider à trouver des réponses à vos préoccupations. Profitez-en avec légèreté, sagesse et discernement.</p>

                            <div class="divider mb-auto w-3/4 mx-auto"></div>

                        </div>
                        <div id="form-change-date" class="flex flex-col justify-center items-center gap-4">
                            <h4 class="text-center">Votre date de naissance : <span class="birthdate_path badge-primary rounded-2xl py-1 px-2 text-sm"></span></h4>
                        </div>
                        
                    </div>
                
                
                <div class="grid md:grid-cols-6 max-w-full grid-cols-1 gap-4 my-8 px-6 pb-8 pt-0 justify-center items-baseline bg-base-100 rounded">
                    <div class="md:col-span-6 p-6 mx-auto">
                        <h3 class="mb-2">Les chiffres de votre naissance :</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae nostrum quisquam tempore assumenda vero incidunt nam unde provident neque alias ipsum exercitationem repellat fuga ullam dicta repellendus, nemo consequatur!</p>
                        <div class="divider mt-10 mb-auto w-1/2 mx-auto"></div>
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

                <div class="grid md:grid-cols-6 max-w-full grid-cols-1 gap-4 my-8 px-6 pb-8 pt-0 justify-center items-baseline bg-base-100 rounded">
                    <div class="md:col-span-6 p-6 mx-auto">
                        <h3 class="mb-2">Les arcanes de votre naissance : </h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae nostrum quisquam tempore assumenda vero incidunt nam unde provident neque alias ipsum exercitationem repellat fuga ullam dicta repellendus, nemo consequatur!</p>
                        <div class="divider mt-10 mb-auto w-1/2 mx-auto"></div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_life_path mt-2 text-center border-t-2 bg-indigo-400 px-4 py-5"></div>
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_annual_path mt-2 text-center border-t-2 bg-amber-500 px-4 py-5"></div>
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 max-w-lg w-full m-auto mt-6 md:mt-0">
                            <div class="container_arcane_sum_path mt-2 text-center border-t-2 bg-teal-500 px-4 py-5"></div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        @if($drawCards->count() > 0)
        <section>
            <div class="flex-col flex-wrap items-center bg-secondary p-6 pt-3 justify-center md:justify-between gap-4 max-w-full mb-4 mt-6 mx-auto rounded">
                <div>
                    <h2 class="mb-2">Espace tirage de Tarot :</h2>
                    <p>Vous souhaitez poser une question au tarot ? Vous pouvez lancer un tirage en le sélectionnant dans la liste suivante :</p>

                    <div class="divider mb-auto w-3/4 mx-auto"></div>

                    <div class="grid md:grid-cols-4 max-w-full grid-cols-1 gap-4 my-8 px-6 pb-8 pt-0 justify-center items-baseline">
                        @foreach ($drawCards as $draw)
                        <div class="gap-4 h-[320px] cursor-default group perspective">
                            <div class="relative preserve-3d group-hover:my-rotate-y-180 duration-1000 flex gap-4 flex-col md:flex-row bg-transparent w-full h-full m-auto">
                                <div class="absolute backface-hidden w-full h-full border-t-2">
                                    <img src="https://picsum.photos/200/320" class="w-full h-full object-cover" />
                                </div>
                                <div class="absolute my-rotate-y-180 backface-hidden w-full h-full border-t-2 bg-base-100">
                                    <div class="text-center p-2 flex flex-col items-center justify-center h-full">
                                        <h3>{{ $draw->name }}</h3>
                                        <p class="my-4 text-sm">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, maiores esse facere saepe aut illum ducimus officia quisquam!
                                        </p>
                                        <a href="{{ route('my_space.previsions.tarot') }}#{{ $draw->slug }}" class="btn btn-primary btn-outline btn-sm delay-300 hover:delay-0 duration-500 scale-0 group-hover:scale-100">Réaliser un tirage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    </article>
</x-app-layout>
