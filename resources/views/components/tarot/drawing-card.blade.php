@props(['draw'])

<div id="drawing-cards" class="flex flex-col items-center">
    <section @if ($draw) data-user-draw="{{ $draw }}" @endif
        class="relative w-full max-w-full max-h-full min-h-[375px] flex justify-evenly h-full flex-col m-auto">
        {{-- <section class="relative w-full max-w-full max-h-full bg-violet-700 flex justify-evenly items-center h-full flex-col mb-20"> --}}

        <header id="header-drawing-cards"
            class="relative p-4 flex flex-col md:flex-row gap-4 justify-between items-center bg-violet-900/55 hidden">

            <div class="mb-4 md:mb-0 md:max-w-[50%]">
                <h3 class="mb-2" id="name-of-drawing-cards"></h3>
                <p id="notice-of-drawing-cards"></p>
                <p class="hidden" id="date-of-drawing-cards"></p>
            </div>

            <span class="hidden" id="total-cards-for-drawing-cards"></span>

            <div id="draw-actions" class="hidden md:max-w-[50%] flex flex-col gap-2">

                <div>
                    <a href="{{ route('tarot.index') }}" id="new-draw"
                        class="w-full flex flex-col md:flex-row justify-center items-center gap-6 p-6 pt-8 rounded-sm bg-accent/100 text-white hover:text-white focus:text-white active:text-white active:bg-accent/85 hover:bg-accent/85 focus:bg-accent/85">
                        <i class="fa-thin fa-thin fa-cards fa-2xl"></i>
                        <span class="text-center">Faire un nouveau tirage</span>
                    </a>
                </div>

                <div class="flex flex-row gap-2">
                    <a href="#" id="open-save-draw"
                        class="w-full md:w-1/2 max-w-[160px] flex flex-col justify-center items-center gap-6 p-6 pt-8 rounded-sm bg-accent/100 text-white hover:text-white focus:text-white active:text-white active:bg-accent/85 hover:bg-accent/85 focus:bg-accent/85">
                        <i class="fa-thin fa-save fa-2xl"></i>
                        <span class="text-center">Enregistrez et/ou annotez votre tirage</span>
                    </a>
                    <a href="#" id="send-draw"
                        class="w-full md:w-1/2 max-w-[160px] flex flex-col justify-center items-center gap-6 p-6 pt-8 rounded-sm bg-accent/100 text-white hover:text-white focus:text-white active:text-white active:bg-accent/85 hover:bg-accent/85 focus:bg-accent/85">
                        <i class="fa-thin fa-feather fa-2xl"></i>
                        <span class="text-center">Demander une interprétation personnalisée</span>
                    </a>
                </div>


            </div>
        </header>

        <div class="w-full">

            <div data-step="DRAWING_CARD_INTRO"
                class="m-auto w-full h-full max-w-md p-6 flex flex-col justify-center gap-6">

                <p class="text-center">Bienvenue sur votre assistant virtuel de tirage de cartes. J'ai créé cet outil en
                    intégrant ma propre interprétation du Tarot de Marseille.</p>

                <button class="btn btn-sm btn-primary text-white w-1/2 mx-auto"
                    data-to-step="SELECT_GAME">Commencer</button>

            </div>

            <div data-step="SELECT_GAME"
                class="m-auto w-full h-full max-w-md p-6 flex flex-col justify-center gap-6 hidden">
                <p>Dans un premier temps, sélectionnez le tirage que vous souhaitez effectuer : </p>

                <ul class="flex flex-col justify-between gap-3" id="select-drawing-card-el">
                </ul>

                <button id="btn-step-drawing-card" class="btn btn-sm btn-primary text-white w-3/4 mx-auto hidden"
                    data-to-step="DRAWING_CARD">Passer au tirage</button>
            </div>

            <div id="card_map" data-games="{{ $drawCards }}" data-step="DRAWING_CARD"
                class="m-auto py-4 w-full h-full relative hidden">

                <div class="flex flex-col w-full h-full max-w-full min-h-[400px] md:min-h-[550px]">
                    <ul id="tarot-cards" class="tarot-cards-container transition-all" data-cards="{{ $cards }}">
                    </ul>



                    {{-- CUT --}}
                    <template id="draw-interpretation-block-cut">
                        <div class="tarot-cards-container tarot-cards-container-cut">
                            <div class="block-interpretation max-w-md">
                                <p>
                                    Les cartes de la coupe indique une tendance générale à votre tirage. Elles
                                    permettent une meilleure compréhension de votre jeu car elle viennent colorer votre
                                    interprétation.
                                </p>
                            </div>
                        </div>
                    </template>

                    <template id="cut-interpretation-card">
                        <div class="tarot-card">
                            <div>
                                <img class="card-img" src="" alt="Card Image">
                            </div>
                        </div>
                    </template>

                    {{-- DRAW CROSS --}}
                    <template id="draw-interpretation-block-draw-cross">
                        <div class="tarot-cards-container tarot-cards-container-draw-cross">
                            <div class="block-interpretation max-w-md">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eligendi pariatur
                                    officia, iusto dolorum tenetur totam et officiis quidem laboriosam, placeat, a
                                    itaque eum vero voluptatum fugit! Voluptatem, magnam quo.
                                </p>
                            </div>
                        </div>
                    </template>

                    <template id="draw-interpretation-card-draw-cross">
                        <div class="tarot-card">
                            <div>
                                <img class="card-img" src="" alt="Card Image">
                            </div>
                        </div>
                    </template>


                    {{-- DRAW DAY --}}
                    <template id="draw-interpretation-block-draw-day">
                        <div class="tarot-cards-container tarot-cards-container-draw-day">
                            <div class="block-interpretation max-w-md">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eligendi pariatur
                                    officia, iusto dolorum tenetur totam et officiis quidem laboriosam, placeat, a
                                    itaque eum vero voluptatum fugit! Voluptatem, magnam quo.
                                </p>
                            </div>
                        </div>
                    </template>

                    <template id="draw-interpretation-card-draw-day">
                        <div class="tarot-card">

                            <div>
                                <img class="card-img" src="" alt="Card Image">
                            </div>

                        </div>
                    </template>


                    {{-- DRAW year --}}
                    <template id="draw-interpretation-block-draw-year">
                        <div class="tarot-cards-container tarot-cards-container-draw-year max-w-lg"></div>
                    </template>

                    <template id="draw-interpretation-card-draw-year">
                        <div class="tarot-card">

                            <div class="domaine">
                                <span class="draw-domaine-icone"></span>
                                <span class="draw-domaine-text"></span>
                            </div>

                            <div class="block-card-year flex flew-col md:flex-row">
                                <div class="mr-4">
                                    <img class="card-img" src="" alt="Card Image">
                                </div>
                                <div>
                                    <h4>
                                        <span class="card-nb"></span>
                                        <span class="card-name"></span>
                                    </h4>
                                    <p class="card-interpretation-text"></p>
                                </div>
                            </div>


                        </div>
                    </template>

                    {{-- DRAW spread --}}
                    <template id="draw-interpretation-block-draw-spread">
                        <div class="tarot-cards-container tarot-cards-container-draw-spread">
                            <div class="block-interpretation max-w-md">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eligendi pariatur
                                    officia, iusto dolorum tenetur totam et officiis quidem laboriosam, placeat, a
                                    itaque eum vero voluptatum fugit! Voluptatem, magnam quo.
                                </p>
                            </div>
                        </div>
                    </template>

                    <template id="draw-interpretation-card-draw-spread">
                        <div class="tarot-card">
                            <div>
                                <img class="card-img" src="" alt="Card Image">
                            </div>
                        </div>
                    </template>
                </div>


            </div>

        </div>

        <footer id="footer-drawing-cards"
            class="hidden flex relative -top-20 flex-col justify-center items-center w-full h-20 bg-transparent">

            <button class="btn btn-sm bg-secondary" id="shuffle-btn">Mélanger</button>
            <button class="hidden btn btn-sm bg-secondary" id="cut-btn">Couper</button>
            <button class="hidden btn btn-sm bg-secondary" id="spread-btn">Etaler</button>

            <button class="hidden btn btn-sm bg-primary" id="interpretation_drawing_card">Interpréter mon
                tirage</button>
        </footer>

    </section>

    <div class="drawer drawer-end">
        <input id="drawer-save" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side z-50">
            <div class="drawer-overlay !cursor-default"></div>

            <div class="relative bg-base-200 text-base-content min-h-full w-full md:w-96 p-4 md:pr-7">

                <span id="drawer-save-close"
                    class="absolute z-10 text-lg w-9 h-9 border leading-9 border-white rounded-full text-center top-3 cursor-pointer right-6 text-white transition-all hover:scale-110"><i
                        class="fa-thin fa-xmark"></i></span>

                <div class="mt-16">
                    <h3 class="mb-2">Annotez et enregistrez votre tirage</h3>

                    <p class="mb-4">Vous pouvez enregistrer votre tirage dans votre espace personnel pour y revenir
                        par la suite. Vous pouvez également ajouter des informations personnelles à votre tirage.</p>

                    @guest
                        <div role="alert" class="mb-4 alert alert-info">
                            <i class="fa-duotone fa-message"></i>
                            <span>Vous devez vous connecter pour poursuivre</span>
                        </div>

                        @livewire('components.form-register-user')

                    @endguest

                    @auth

                        <form id="form-save-draw">

                            @php
                                $jsonString = html_entity_decode($draw);
                                $decodedDraw = json_decode($jsonString, true);
                            @endphp

                            <div class="form-control mb-4">
                                <label for="question" class="label">
                                    <span class="label-text">Votre question au moment du tirage :</span>
                                </label>
                                <input type="text" id="question" name="question" class="input input-bordered"
                                    placeholder="Votre question..." value="{{ $decodedDraw['question'] ?? old('question') }}">
                            </div>
                            <div class="form-control mb-4">
                                <label for="feeling" class="label">
                                    <span class="label-text">Votre ressenti personnel du tirage :</span>
                                </label>
                                <textarea id="feeling" name="feeling" rows="8" class="textarea textarea-bordered"
                                    placeholder="Votre ressenti personnel...">{{ $decodedDraw['feeling'] ?? old('feeling') }}</textarea>
                            </div>
                        </form>

                        <button id="save-draw-btn" class="btn btn-sm btn-primary text-white w-full mt-4">Enregistrez votre
                            tirage</button>
                    @endauth

                </div>

            </div>

        </div>
    </div>

</div>
