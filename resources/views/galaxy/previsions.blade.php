<x-app-layout>
    @section('css')
        @vite(['resources/css/add/numerology_tree.css'])
    @endsection
    @section('js')
        @vite(['resources/js/add/lunar.js', 'resources/js/add/numerology.js'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Entre lune et tarot
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

        <section class="mb-4" id="numerology_details">
            <div id="numerology_details_content">
                <h4>Votre date de naissance : <span class="birthdate_path"></span></h4>
                <div class="grid md:grid-cols-6 grid-cols-1 gap-4 my-8 justify-center items-baseline">

                    <div class="md:col-span-3 h-full">
                        <div class="relative p-4 pt-10 bg-primary w-full h-full m-auto border-t-2">
                            <div class="life_path absolute -top-7 left-[50%] -translate-x-[50%] w-16 h-16 bg-primary pt-5 text-xl text-center rounded-full"></div>
    
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis unde quaerat quasi iusto veniam commodi omnis voluptate deserunt, quis corporis quibusdam, nihil recusandae ut autem distinctio obcaecati libero nobis minima.</p>
                            
                        </div>
                    </div>

                    <div class="md:col-span-3 h-full">
                        <div class="bg-accent border-t-2 my-8 h-full">
                            <div class="relative p-4 pt-10 max-w-lg w-full m-auto mt-6 md:mt-0">
                                <div class="annual_path absolute -top-7 left-[50%] -translate-x-[50%] w-16 h-16 bg-accent pt-5 text-xl text-center rounded-full"></div>
        
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Blanditiis unde quaerat quasi iusto veniam commodi omnis voluptate deserunt, quis corporis quibusdam, nihil recusandae ut autem distinctio obcaecati libero nobis minima.</p>
                                <div class="container_arcane_annual_path grid md:grid-cols-2 items-center mt-8 text-center"></div>
                            </div>
        
                            
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-6 grid-cols-1 gap-4 my-8 justify-center items-baseline">
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 pt-10 max-w-lg w-full m-auto mt-6 md:mt-0">
        
                            <div class="container_arcane_life_path mt-8 text-center"></div>
            
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 pt-10 max-w-lg w-full m-auto mt-6 md:mt-0">
        
                            <div class="container_arcane_annual_path mt-8 text-center"></div>
                        </div>
                    </div>
                    <div class="md:col-span-2 h-full">
                        <div class="relative p-4 pt-10 max-w-lg w-full m-auto mt-6 md:mt-0">
        
                            <div class="container_arcane_sum_path mt-8 text-center"></div>
                        </div>
                    </div>
                </div>
                
            </div>


        </section>

        <h3 class="mb-6" id="season_text"></h3>
        <li id="lunar_phase_text"></li>
        <li id="lunar_phase_emoji"></li>
        <li id="lunar_is_waxing"></li>
        <li id="lunar_is_waning"></li>
        <li id="lunar_age"></li>
        </ul>

        <h3 class="mt-6">Tirages de Tarot : </h3>
        <ul>
            <li>Energie du jour</li>
            <li>Energie de la semaine à venir</li>
            <li>Répondre à une question</li>
        </ul>

    </article>

</x-app-layout>
