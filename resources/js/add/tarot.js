import gsap from "gsap";
import axios from "axios";

document.addEventListener("livewire:init", () => {
    // VARIABLES
    const drawingCardsPage = document.getElementById("drawing-cards");
    if (drawingCardsPage) {
        let anchor = window.location.hash;

        const header = document.getElementById("header-drawing-cards");
        const nameOfDrawingCardsEl = document.getElementById(
            "name-of-drawing-cards"
        );
        const totalCardsForDrawingCardsEl = document.getElementById(
            "total-cards-for-drawing-cards"
        );
        const tarotCardsContainer = document.getElementById("tarot-cards");
        const selectDrawingCardEl = document.getElementById(
            "select-drawing-card-el"
        );

        const btnsTo = document.querySelectorAll("[data-to-step]");

        const btnStepDrawingCard = document.getElementById(
            "btn-step-drawing-card"
        );
        const interpretationDrawingCardBtn = document.getElementById("interpretation_drawing_card");

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
        let drawSlug;
        let selectIsOpen = false;
        let cardsSelected = [];
        let cardsCutSelected = [];

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
                    drawSlug = g.slug;

                    anchor = g.slug;

                    nameOfDrawingCardsEl.innerText = nameOfDrawingCards;
                    totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                        restCards > 1 ? "s" : ""
                    } sur ${totalCards}`;
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
            ];

            //Elements
            const stepsEls = document.querySelectorAll("[data-step]");

            let activeStep = "DRAWING_CARD_INTRO";
            let activeStepEl = document.querySelector(
                '[data-step="' + activeStep + '"]'
            );

            //Get visible nextStepEl & Mask activeStepEl
            if (to != null) {
                activeStep = to;
                activeStepEl = document.querySelector(
                    '[data-step="' + activeStep + '"]'
                );

                stepsEls.forEach((step) => {
                    step.classList.add("hidden");
                });
                activeStepEl.classList.remove("hidden");
            } else {
                activeStep = btn.getAttribute("data-to-step");
                activeStepEl = document.querySelector(
                    '[data-step="' + activeStep + '"]'
                );

                stepsEls.forEach((step) => {
                    step.classList.add("hidden");
                });
                activeStepEl.classList.remove("hidden");
            }

            //Create & Manipulate DrawingCardsList

            if (activeStep == "DRAWING_CARD") {
                header.classList.remove("hidden");
                if (!hasDeck) {
                    createDeck(tarotCards, tarotCardsContainer);
                }

                let changeGameBtnsContainer = document.createElement("div");
                let changeGameBtnsUl = document.createElement("ul");

                let changeGameBlocTitle = document.createElement("span");

                let drawingCardBtns = drawingCards.filter(
                    (d) => d.slug != anchor
                );

                drawingCardBtns.forEach((d) => {
                    let changeGameBtnsLi = document.createElement("li");
                    let changeGameBtnsA = document.createElement("a");

                    let origin = window.location.origin;
                    let pathname = window.location.pathname;
                    let hash = "#" + d.slug;
                    let url = origin + pathname;

                    changeGameBtnsA.setAttribute("href", url + hash);
                    changeGameBtnsA.innerText = d.name;
                    changeGameBtnsA.classList.add(
                        "btn",
                        "btn-sm",
                        "btn-primary",
                        "text-white/70",
                        "hover:text-white/70",
                        "active:text-white/70",
                        "focus:text-white/70"
                    );

                    changeGameBtnsLi.append(changeGameBtnsA);
                    changeGameBtnsUl.append(changeGameBtnsLi);

                    changeGameBtnsA.addEventListener("click", function (e) {
                        e.preventDefault();
                        window.location.hash = hash;
                        location.reload();
                    });
                });

                changeGameBlocTitle.innerText = "Changer de tirage :";

                changeGameBtnsContainer.classList.add("p-4", "bg-base-100");
                changeGameBlocTitle.classList.add(
                    "text-xl",
                    "mb-3",
                    "inline-block"
                );
                changeGameBtnsUl.classList.add("flex", "gap-4");

                changeGameBtnsContainer.append(changeGameBlocTitle);
                changeGameBtnsContainer.append(changeGameBtnsUl);
                drawingCardsPage.append(changeGameBtnsContainer);
            } else {
                header.classList.add("hidden");
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
                // li.innerHTML = `<img class="w-full h-full object-contain" src="http://ultimate.test/imgs/tarot/back-card.png"/>`;
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
            
            selectIsOpen = true;

            spreadBtn.classList.add("hidden");
            totalCardsForDrawingCardsEl.parentElement.classList.remove(
                "hidden"
            );

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
        };

        const shuffleDeck = function () {
            tarotCardsContainer.innerHTML = "";

            selectIsOpen = false;
            restCards = 0;

            tarotCards = gsap.utils.shuffle(tarotCards);

            createDeck(tarotCards, tarotCardsContainer);
            cardsSelected = [];
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                restCards > 1 ? "s" : ""
            } sur ${totalCards}`;

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

                    shuffleBtn.classList.add("hidden");
                    cutBtn.classList.remove("hidden");
                    cutBtn.addEventListener("click", cutDeck);
                },
            });
        };

        const cutDeck = function () {
            let cards = tarotCardsContainer.children;
            let card = cards[1];

            let random = Math.floor(Math.random() * 22);

            cardsCutSelected = ["cut", tarotCards[random].id, tarotCards[0].id];

            //console.log(cardsCutSelected)

            const originalClass = Array.from(card.classList).find((cls) =>
                cls.startsWith("-translate-x-")
            );

            card.classList.add("transition-all");
            card.classList.add("!translate-x-20");
            card.classList.add("z-10");
            setTimeout(function (callback) {
                card.classList.remove("!translate-x-20");
                card.classList.remove("z-10");
                setTimeout(function () {
                    card.classList.remove("transition-all");
                }, 100);
            }, 500);

            cutBtn.classList.add("hidden");
            spreadBtn.classList.remove("hidden");
            spreadBtn.addEventListener("click", spreadDeck);
        };

        const selectCard = function (el) {
            el.addEventListener("click", function () {
                let numberArcane = el.getAttribute("id").split("-").pop();
                let found = cardsSelected.find((item) => item == numberArcane);

                if (selectIsOpen) {
                    el.classList.add("selected");
                    el.classList.add("-mt-4");
                    cardsSelected.push(parseInt(numberArcane));
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
                return;
            });
        };

        const afterSelectCard = function () {
            if (cardsSelected.length == totalCards) {
                selectIsOpen = false;

                console.log('totalCards', totalCards, 'cardsSelected', cardsSelected)

                interpretationDrawingCardBtn.classList.remove('hidden');
            } else {
                interpretationDrawingCardBtn.classList.add("hidden");
                selectIsOpen = true;
            }
            restCards = cardsSelected.length;
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                restCards > 1 ? "s" : ""
            } sur ${totalCards}`;
            return;
        };

        const launchGetDrawInterpretation = async () => {
            try{
                console.log('before execute function await', cardsSelected)
                const responseDraw = await getDrawInterpretation(cardsSelected, drawSlug);
                const responseCut = await getDrawInterpretation(cardsCutSelected, 'cut');
                const interpretationCardDraw = responseDraw.data;
                const interpretationCardCut = responseCut.data;

                const finalDraw = {
                    cut: interpretationCardCut,
                    draw: interpretationCardDraw
                }

                let drawS = interpretationCardDraw.drawSlug;
                if(drawS == 'tirage_de_la_journee') {
                    drawDay(finalDraw);
                }else if(drawS == 'tirage_de_la_semaine') {
                    drawWeeck(finalDraw);
                }else if(drawS == 'tirage_en_croix') {
                    drawCross(finalDraw);
                }
                return;

            } catch (err) {
                console.error("Erreur lors de l'interprétation du tirage :", err);
            }
        }

        const getDrawInterpretation = async (drawCards, drawSlug) => {
            try {
                let url = 'http://ultimate.test/mon-espace/previsions/tarot/interpretation'
                return axios({
                    method: 'get',
                    url: url,
                    params: {
                        drawCards: drawCards,
                        drawSlug: drawSlug
                    }
                  });
            } catch (err) {
                console.error(
                    "Erreur lors de la requête au serveur :",
                    err.message
                );
                throw err;
            }
        };

        // TIRAGES
        interpretationDrawingCardBtn.addEventListener("click", () => {
            launchGetDrawInterpretation(cardsSelected);
        });

        const duplicateCardDraw = () => {
            let tarotCardsEl = document.querySelectorAll(".tarot-card");

            console.log(tarotCardsEl);

            //tarotCardsEl = all elementCard selected

            tarotCardsEl.forEach((card) => {
                card.style.transform = `translateX(0%)`;
                setTimeout(() => {
                    card.classList.remove('-mt-4')
                    card.classList.add('left-[50%]');
                    card.style.transform = `translateX(-50%)`;
                }, 500);
                
            })

            return tarotCardsEl;
        }

        const drawCross = function(finalDraw) {
            duplicateCardDraw();
            console.log('duplicatedCards');
            console.log('draw', finalDraw);
        }

        const drawWeeck = function(finalDraw) {
            duplicateCardDraw();
            console.log('draw', finalDraw);
        }

        const drawDay = function(finalDraw) {
            duplicateCardDraw();
            console.log('draw', finalDraw);
        }

        // CONSTRUCTION DU TIRAGE

        if (anchor) {
            let found = false;

            anchor = anchor.substring(1);

            drawingCards.forEach((drawing) => {
                if (drawing.slug == anchor) {
                    header.classList.remove("hidden");

                    steping(null, "DRAWING_CARD");
                    totalCards = drawing.totalSelectedCards;
                    nameOfDrawingCards = drawing.name;
                    drawSlug = drawing.slug;

                    nameOfDrawingCardsEl.innerText = nameOfDrawingCards;
                    totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                        restCards > 1 ? "s" : ""
                    } sur ${totalCards}`;
                }
            });
        }

        btnsTo.forEach((btn) => {
            btn.addEventListener("click", () => {
                steping(btn);
            });
        });

        shuffleBtn.addEventListener("click", shuffleDeck);
    }
});
