import gsap from "gsap";

document.addEventListener("livewire:init", () => {
    // VARIABLES
    const drawingCardsPage = document.getElementById("drawing-cards");
    if (drawingCardsPage) {
        let anchor = window.location.hash;

        const header = document.getElementById("header-drawing-cards");
        const nameOfDrawingCardsEl = document.getElementById("name-of-drawing-cards");
        const totalCardsForDrawingCardsEl = document.getElementById("total-cards-for-drawing-cards");
        const tarotCardsContainer = document.getElementById("tarot-cards");
        const selectDrawingCardEl = document.getElementById(
            "select-drawing-card-el"
        );

        const btnsTo = document.querySelectorAll('[data-to-step]');

        const btnFinalyStep = document.getElementById("btn-finaly-step");
        const btnStepDrawingCard = document.getElementById(
            "btn-step-drawing-card"
        );

        const spreadBtn = document.getElementById("spread-btn");
        const shuffleBtn = document.getElementById("shuffle-btn");
        const cutBtn = document.getElementById("cut-btn");

        let tarotCards = JSON.parse(
            tarotCardsContainer.getAttribute("data-cards")
        );
        
        const drawingCards = JSON.parse(
            tarotCardsContainer.getAttribute("data-games")
        );

        let hasDeck = false;
        let totalCards;
        let restCards = 0;
        let nameOfDrawingCards;
        let selectIsOpen = false;
        let cardsSelected = [];

        let isMobile;
        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
        )
            isMobile = true;
        else isMobile = false;

        let screenSize = window.innerWidth;

        // FONCTIONS GLOBALES
        const createDrawingCardsList = function () {
            drawingCards.forEach((g) => {
                let li = document.createElement("li");

                li.setAttribute("data-total-cards", g.totalSelectedCards);

                li.classList =
                    "text-center cursor-pointer transition-all hover:scale-105";

                let name = g.name;
                let nameEl = document.createElement("h4");
                nameEl.textContent = name;
                let desc = g.description;
                let descEl = document.createElement("p");
                descEl.textContent = desc;

                nameEl.classList = "bg-accent";
                descEl.classList = "bg-secondary px-2";

                li.append(nameEl);
                li.append(descEl);
                selectDrawingCardEl.append(li);

                li.addEventListener("click", () => {
                    let otherLi =
                        document.querySelectorAll("[data-total-cards]");

                    otherLi.forEach((el) => {
                        el.classList.remove("scale-105");
                    });
                    li.classList.add("scale-105");

                    btnStepDrawingCard.classList.remove("hidden");

                    totalCards = g.totalSelectedCards;
                    nameOfDrawingCards = name;

                    nameOfDrawingCardsEl.innerText = nameOfDrawingCards;
                    totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${restCards > 1 ? 's' : ''} sur ${totalCards}`;
                });
            });
        };
        createDrawingCardsList();

        const steping = function (btn = null, to = null) {
            const steps = [
                "DRAWING_CARD_INTRO",
                "SELECT_GAME",
                "DRAWING_CARD",
                "FINALY_STEP",
                "INTERPRETATION_DRAWING_CARD",
            ];

            //Elements
            const stepsEls = document.querySelectorAll('[data-step]');
            
            let activeStep = 'DRAWING_CARD_INTRO';
            let activeStepEl = document.querySelector(
                '[data-step="' + activeStep + '"]'
            );

            //Get visible nextStepEl & Mask activeStepEl
            if(to != null) {
                activeStep = to;
                activeStepEl = document.querySelector(
                    '[data-step="' + activeStep + '"]'
                );

                stepsEls.forEach(step => {
                    step.classList.add('hidden');
                })
                activeStepEl.classList.remove('hidden');
            }else {
                activeStep = btn.getAttribute('data-to-step');
                activeStepEl = document.querySelector(
                    '[data-step="' + activeStep + '"]'
                );

                stepsEls.forEach(step => {
                    step.classList.add('hidden');
                })
                activeStepEl.classList.remove('hidden');
            }

            //Create & Manipulate DrawingCardsList

            if (activeStep == "DRAWING_CARD") {
                header.classList.remove('hidden');
                if(!hasDeck) {
                    createDeck(tarotCards, tarotCardsContainer);
                }
            }else {
                header.classList.add('hidden');
            }
        };

        const createDeck = function ($tarotCards, $container) {
            hasDeck = true;
            restCards = 0;
            let cardsContainerWidth = $container.offsetWidth;
            let cardWidth = Math.floor(
                (cardsContainerWidth / $tarotCards.length) * 2.2
            );
            let cardHeight = cardWidth * 1.85;

            $tarotCards.forEach((card) => {
                let li = document.createElement("li");

                li.setAttribute(
                    "id",
                    "tarot-card-" + card.slug + "-" + card.id
                );
                li.innerHTML = `<img class="w-full h-full object-contain" src="${card.imgPath}"/>`;

                li.style.width = cardWidth + "px";
                li.style.height = cardHeight + "px";

                li.classList =
                    "tarot-card flex-none cursor-pointer absolute left-[50%] -translate-x-[50%]";
                $container.appendChild(li);

                selectCard(li);
            });
        };

        const spreadDeck = function () {
            let tarotCardsEl = document.querySelectorAll(".tarot-card");

            spreadBtn.classList.add('hidden');

            for (let $i = 0; $i < tarotCardsEl.length; $i++) {
                let cardHeight = tarotCardsEl[$i].style.height;
                let cardWidth = tarotCardsEl[$i].style.width;

                tarotCardsEl[$i].classList.add("hover:-mt-4");
                tarotCardsEl[$i].classList.remove("-translate-x-[50%]");
                tarotCardsEl[$i].classList.remove("left-[50%]");
                tarotCardsEl[$i].classList.remove("left-auto");

                tarotCardsEl[$i].style.cssText = "";
                tarotCardsEl[$i].style.width = cardWidth;
                tarotCardsEl[$i].style.height = cardHeight;

                setTimeout(() => {
                    // if($i > 0) {
                    const translateXValue = 30 * $i;
                    tarotCardsEl[$i].classList.add("transition-all");
                    tarotCardsEl[
                        $i
                    ].style.transform = `translateX(${translateXValue}%)`;
                    // }
                }, 100);
            }

            selectIsOpen = true;
        };

        const schuffleDeck = function () {
            tarotCardsContainer.innerHTML = "";

            selectIsOpen = false;
            restCards = 0;
            
            tarotCards = gsap.utils.shuffle(tarotCards);

            createDeck(tarotCards, tarotCardsContainer);
            cardsSelected = [];
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${restCards > 1 ? 's' : ''} sur ${totalCards}`;
            btnFinalyStep.classList.add("hidden");

            let tarotCardsEl = document.querySelectorAll(".tarot-card");

            // Animation de mélange
            gsap.to(tarotCardsEl, {
                duration: 1, // Durée de l'animation en secondes
                x: () => gsap.utils.random(-100, 100), // Déplacement aléatoire en x
                y: () => gsap.utils.random(-100, 100), // Déplacement aléatoire en y
                rotation: () => gsap.utils.random(-360, 360), // Rotation aléatoire
                stagger: 0.1, // Délai entre chaque animation
                ease: "power1.inOut", // Type de courbe d'animation
                onComplete: () => {
                    // Réinitialiser la position et la rotation après le mélange
                    gsap.to(tarotCardsEl, {
                        duration: 0.5,
                        x: 0,
                        y: 0,
                        rotation: 0,
                        stagger: 0.1,
                        ease: "power1.inOut",
                    });

                    shuffleBtn.classList.add('hidden');
                    cutBtn.classList.remove('hidden');
                    cutBtn.addEventListener("click", cutDeck);
                }
            });
            
        };

        

        const cutDeck = function () {
            let cards = tarotCardsContainer.children;
            let card = cards[1];

            const originalClass = Array.from(card.classList).find(cls => cls.startsWith('-translate-x-'));
            
            card.classList.add('transition-all');
            card.classList.add('!translate-x-20');
            card.classList.add('z-10');
            setTimeout(function(callback) {
                card.classList.remove('!translate-x-20');
                card.classList.remove('z-10');
                setTimeout(function() {
                    card.classList.remove('transition-all');
                }, 100)
            }, 500);

            cutBtn.classList.add('hidden');
            spreadBtn.classList.remove('hidden');
            spreadBtn.addEventListener("click", spreadDeck);
        };

        const selectCard = function (el) {
            el.addEventListener("click", function () {
                let numberArcane = el.getAttribute("id").split("-").pop();
                let found = cardsSelected.find((item) => item == numberArcane);

                if (selectIsOpen) {
                    el.classList.add("selected");
                    el.classList.add("-mt-4");
                    cardsSelected.push(numberArcane);
                }

                if (
                    el.classList.contains("selected") &&
                    found == numberArcane
                ) {
                    el.classList.remove("selected");
                    el.classList.remove("-mt-4");
                    cardsSelected = cardsSelected.filter(
                        (item) => item != numberArcane
                    );
                }

                afterSelectCard(cardsSelected, totalCards);
            });
        };

        const afterSelectCard = function (cardsSelected, numberTotalCards) {
            if (cardsSelected.length == numberTotalCards) {
                btnFinalyStep.classList.remove("hidden");
                selectIsOpen = false;
            } else {
                btnFinalyStep.classList.add("hidden");
                selectIsOpen = true;
            }
            restCards = cardsSelected.length;
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${restCards > 1 ? 's' : ''} sur ${totalCards}`;
        };

        // CONSTRUCTION DU TIRAGE

        if(anchor) {
            let found = false;

            anchor = anchor.substring(1);

            drawingCards.forEach(drawing => {
                if(drawing.slug == anchor) {
                    console.log('tirage trouve', anchor)

                    header.classList.remove('hidden');

                    steping(null, 'DRAWING_CARD');
                    totalCards = drawing.totalSelectedCards;
                    nameOfDrawingCards = drawing.name;

                    nameOfDrawingCardsEl.innerText = nameOfDrawingCards;
                    totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${restCards > 1 ? 's' : ''} sur ${totalCards}`;

                    selectIsOpen = true;

                    console.log(totalCards, nameOfDrawingCards)




                    

                    // steps.forEach(step => {
                    //     if(step.getAttribute('data-step') != 'DRAWING_CARD') {
                    //         totalCards = drawing.totalSelectedCards;
                    //         nameOfDrawingCards = drawing.name;
                    //         //selectIsOpen = true;
                    //         createDeck(tarotCards, tarotCardsContainer);
                    //         step.classList.add('hidden');
                    //         activeStepEl.classList.remove('hidden');
                    //     }
                    // })






                }
            })
        }
        
        btnsTo.forEach((btn) => {
            btn.addEventListener("click", () => {
                steping(btn);
            });
        });

        //cutBtn.addEventListener("click", cutDeck);
        shuffleBtn.addEventListener("click", schuffleDeck);
    }
});
