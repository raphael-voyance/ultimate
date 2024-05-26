<div>
    <section id="drawing-cards" class="w-full min-h-96 max-w-full max-h-full bg-red-200">
        
        <header>

            <h3 id="h-title-drawing-cards"></h3>

        </header>

        <div class="w-full bg-violet-700 flex justify-center items-center min-h-96">

            <div data-step="DRAWING_CARD_INTRO" class="m-auto w-full h-full min-h-96 max-w-md p-6 flex flex-col justify-center gap-6">

                <p class="text-center">Bienvenue sur votre assistant de tirage de cartes. J'ai créé cet outil en intégrant ma propre interprétation du Tarot de Marseille.</p>

                <button class="btn btn-sm btn-primary text-white w-1/2 mx-auto" data-next-step="SELECT_GAME">Commencer</button>

            </div>

            <div data-step="SELECT_GAME" class="m-auto w-full h-full min-h-96 max-w-md p-6 flex flex-col justify-center gap-6 hidden">
                <p>Dans un premier temps, sélectionnez le tirage que vous souhaitez effectuer : </p>

                <ul class="flex flex-col justify-between gap-3" id="select-drawing-card-el">
                </ul>

                <button id="btn-step-drawing-card" class="btn btn-sm btn-primary text-white w-3/4 mx-auto hidden" data-next-step="DRAWING_CARD">Passer au tirage</button>
            </div>

            <div data-step="DRAWING_CARD" class="m-auto w-full h-full min-h-96 relative hidden">

                <button class="z-10 absolute top-1 left-1" data-prev-step="SELECT_GAME">Retour</button>

                <ul id="tarot-cards" class="relative m-auto flex flex-row items-center flex-nowrap p-4 w-full h-full min-h-80" data-cards="{{$cards}}" data-games="{{$drawCards}}"></ul>

                <div class="absolute bottom-0 w-full h-16 bg-green-200">
<button class="bg-yellow-400" id="shuffle-btn">Mélanger</button>
                <button class="bg-red-400" id="etale-btn">Etaler</button>
            
                <button class="hidden" id="btn-finaly-step" data-next-step="FINALY_STEP">Poursuivre</button>
                </div>

                
            </div>

            <div data-step="FINALY_STEP" class="m-auto w-full h-full min-h-96 hidden">
                <button data-next-step="INTERPRETATION_DRAWING_CARD">Interpréter mon tirage</button>
            </div>

        </div>
        
    </section>
</div>