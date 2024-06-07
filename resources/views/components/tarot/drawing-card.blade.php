<div>
    <section id="drawing-cards" class="w-full min-h-[28em] max-w-full max-h-full">

        <header id="header-drawing-cards" class="relative h-20 p-4 flex flex-col md:flex-row justify-between items-center bg-gradient-to-b from-violet-900 to-violet-700 hidden">

            <h3 class="mb-2 md:mb-auto" id="name-of-drawing-cards"></h3>

            <div class="hidden">
                <span id="total-cards-for-drawing-cards"></span>
            </div>

        </header>

        <div class="w-full bg-violet-700 flex justify-center items-center h-full min-h-[30em]">

            <div data-step="DRAWING_CARD_INTRO"
                class="m-auto w-full h-full min-h-96 max-w-md p-6 flex flex-col justify-center gap-6">

                <p class="text-center">Bienvenue sur votre assistant de tirage de cartes. J'ai créé cet outil en
                    intégrant ma propre interprétation du Tarot de Marseille.</p>

                <button class="btn btn-sm btn-primary text-white w-1/2 mx-auto"
                data-to-step="SELECT_GAME">Commencer</button>

            </div>

            <div data-step="SELECT_GAME"
                class="m-auto w-full h-full min-h-96 max-w-md p-6 flex flex-col justify-center gap-6 hidden">
                <p>Dans un premier temps, sélectionnez le tirage que vous souhaitez effectuer : </p>

                <ul class="flex flex-col justify-between gap-3" id="select-drawing-card-el">
                </ul>

                <button id="btn-step-drawing-card" class="btn btn-sm btn-primary text-white w-3/4 mx-auto hidden"
                data-to-step="DRAWING_CARD">Passer au tirage</button>
            </div>

            <div id="card_mat" data-step="DRAWING_CARD" class="m-auto w-full h-full min-h-96 relative hidden">

                <ul id="tarot-cards"
                    class="relative -translate-y-7 m-auto flex flex-row items-center flex-nowrap p-4 w-full h-full min-h-[30em] overflow-hidden overscroll-none"
                    data-cards="{{ $cards }}" data-games="{{ $drawCards }}"></ul>

                <div class="absolute flex flex-col justify-center items-center bottom-0 w-full h-20 bg-gradient-to-t from-violet-900 to-violet-700">

                    <button class="btn btn-sm bg-secondary" id="shuffle-btn">Mélanger</button>
                    <button class="hidden btn btn-sm bg-secondary" id="cut-btn">Couper</button>
                    <button class="hidden btn btn-sm bg-secondary" id="spread-btn">Etaler</button>

                    <button class="hidden btn btn-sm bg-primary" id="interpretation_drawing_card">Interpréter mon tirage</button>
                </div>


            </div>

        </div>

    </section>
</div>
