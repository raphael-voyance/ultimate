import gsap from "gsap";
import axios from "axios";
import "./tarot.css";

document.addEventListener("DOMContentLoaded", () => {
    // VARIABLES
    const drawingCardsPage = document.getElementById("drawing-cards");
    if (drawingCardsPage) {
        let anchor = window.location.hash;

        const header = document.getElementById("header-drawing-cards");
        const footer = document.getElementById("footer-drawing-cards");
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
        const cardMap = document.getElementById('card_map');

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

        let isMobile;
        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
        )
            isMobile = true;
        else isMobile = false;

        let screenSize = window.innerWidth;

        let cardWidth;
        let cardHeight;
        if(isMobile) {
            cardWidth = 63.08;
            cardHeight = 120;
        }else {
            cardWidth = 114;
            cardHeight = 216.83;
        }

        let hasDeck = false;
        let totalCards;
        let restCards = 0;
        let nameOfDrawingCards;
        let drawSlug;
        let selectIsOpen = false;
        let cardsSelected = [];
        let cardsCutSelected = [];

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
                footer.classList.remove("hidden");
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
                        "md:btn-sm",
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

                changeGameBtnsContainer.classList.add("p-4", "bg-base-100", "relative", "-top-20");
                changeGameBlocTitle.classList.add(
                    "text-xl",
                    "mb-3",
                    "inline-block"
                );
                changeGameBtnsUl.classList.add("flex", "gap-4", "flex-wrap");

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

            $tarotCards.forEach((card, i) => {
                let li = document.createElement("li");
                let frontCardEl = document.createElement("div");
                let backCardEl = document.createElement("div");

                li.setAttribute(
                    "id",
                    "tarot-card-" + card.slug + "-" + card.id
                );

                li.setAttribute("data-number", card.numberArcane);

                li.classList.add('tarot-card');
                frontCardEl.classList.add('front-card');
                backCardEl.classList.add('back-card');

                li.style.width = cardWidth + "px";
                li.style.height = cardHeight + "px";

                $container.style.width = cardWidth + "px";
                $container.style.height = cardHeight + "px";

                frontCardEl.innerHTML = `<img class="w-full h-full object-contain" src="${card.imgPath}"/>`;
                backCardEl.innerHTML = '<img class="w-full h-full object-contain" src= ' + window.location.origin + ' /imgs/tarot/back-card.png"/>';

                li.appendChild(backCardEl);
                li.appendChild(frontCardEl);

                $container.appendChild(li);

                selectCard(li);
            });

        };

        const spreadDeck = function () {

            totalCardsForDrawingCardsEl.classList.remove('hidden');
            
            const cards = tarotCardsContainer.getElementsByClassName('tarot-card');
            const cardCount = cards.length;
            const angleStep = 360 / cardCount;
            const radius = isMobile ? 100 : 180;

            for (let i = 0; i < cardCount; i++) {
                const angle = i * angleStep;
                const x = radius * Math.cos(angle * (Math.PI / 180));
                const y = radius * Math.sin(angle * (Math.PI / 180));
                    
                cards[i].style.transform = `translate(${x}px, ${y}px) rotate(${angle + i*2 }deg)`;

                cards[i].addEventListener('mouseenter', () => {
                    cards[i].style.transform = `translate(${x}px, ${y}px) rotate(${angle + i*2 }deg) scale(1.10)`;
                });
                cards[i].addEventListener('mouseleave', () => {
                    cards[i].style.transform = `translate(${x}px, ${y}px) rotate(${angle + i*2 }deg) scale(1)`;
                });
            }

            tarotCardsContainer.classList.toggle('spread');

            selectIsOpen = true;
            spreadBtn.classList.add("hidden");
            totalCardsForDrawingCardsEl.parentElement.classList.remove("hidden");
            return;

        };

        const shuffleDeck = function () {
            tarotCardsContainer.innerHTML = "";

            restCards = 0;

            tarotCards = gsap.utils.shuffle(tarotCards);

            createDeck(tarotCards, tarotCardsContainer);
            cardsSelected = [];
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                restCards > 1 ? "s" : ""
            } sur ${totalCards}`;

            let tarotCardsEl = document.querySelectorAll(".tarot-card");

            tarotCardsEl.forEach((card, i) => {
                gsap.to(card, {
                    duration: 0.8,
                    x: () => gsap.utils.random(-260, 260),
                    y: () => gsap.utils.random(-160, 160),
                    rotation: () => gsap.utils.random(-120, 120),
                    stagger: 0,
                    ease: "power1-inOut",
                    onComplete: () => {
                        gsap.to(tarotCardsEl, {
                            duration: 0.8,
                            y: 0,
                            x: 0,
                            rotation: 0,
                            stagger: 0,
                            ease: "power1.inOut",
                        });
    
                        shuffleBtn.classList.add("hidden");
                        cutBtn.classList.remove("hidden");
                        cutBtn.addEventListener("click", cutDeck);
                    },
                });
            })
            
        };

        const cutDeck = function () {
            let cards = tarotCardsContainer.children;
            let card = cards[1];

            let random = Math.floor(Math.random() * 22);

            if(tarotCards[random].id == tarotCards[0].id) {
                random = Math.floor(Math.random() * 22);
            }

            cardsCutSelected = ["cut", tarotCards[random].id, tarotCards[0].id];

            const originalClass = Array.from(card.classList).find((cls) =>
                cls.startsWith("-translate-x-")
            );

            card.classList.add("transition-all");
            card.classList.add("!translate-x-[105%]");
            card.classList.add("z-10");
            setTimeout(function (callback) {
                card.classList.remove("!translate-x-[105%]");
                card.classList.remove("z-10");
                setTimeout(function () {
                    card.classList.remove("transition-all");
                }, 100);
            }, 500);

            cutBtn.classList.add("hidden");
            spreadBtn.classList.remove("hidden");
            spreadBtn.addEventListener("click", spreadDeck);
        };

        const closeDeck = function () {
            let tarotCardsEl = document.querySelectorAll(".tarot-card");

            tarotCardsEl.forEach((card) => {
                gsap.to(card, {
                    duration: 1, 
                    x: () => 0, 
                    y: () => 0,
                    rotation: () => 0,
                    stagger: 0.2, 
                    ease: "power1.inOut",
                });
            });
        }

        const selectCard = function (el) {
            el.addEventListener("click", function () {
                let numberArcane = el.getAttribute("id").split("-").pop();
                let found = cardsSelected.find((item) => item == numberArcane);

                if (selectIsOpen) {
                    el.classList.add("selected", "ring-2", "ring-primary");
                    cardsSelected.push(parseInt(numberArcane));
                }

                if (
                    el.classList.contains("selected") &&
                    found == numberArcane
                ) {
                    el.classList.remove("selected", "ring-2", "ring-primary");
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
                interpretationDrawingCardBtn.classList.remove('hidden');
            } else {
                interpretationDrawingCardBtn.classList.add("hidden");
            }
            restCards = cardsSelected.length;
            totalCardsForDrawingCardsEl.innerText = `Vous avez sélectionné ${restCards} carte${
                restCards > 1 ? "s" : ""
            } sur ${totalCards}`;
            return;
        };

        const launchGetDrawInterpretation = async () => {
            try{
                const responseDraw = await getDrawInterpretation(cardsSelected, drawSlug);
                const responseCut = await getDrawInterpretation(cardsCutSelected, 'cut');
                const interpretationCardDraw = responseDraw.data;
                const interpretationCardCut = responseCut.data;

                //console.log(interpretationCardDraw)

                const finalDraw = {
                    cut: interpretationCardCut,
                    draw: interpretationCardDraw
                }

                interpretationDrawingCardBtn.classList.add('hidden');

                closeDeck();

                //console.log(finalDraw, interpretationCardDraw.drawSlug);

                let drawS = interpretationCardDraw.drawSlug;
                if(drawS == 'tirage-de-la-journee') {
                    drawDay(finalDraw);
                }else if(drawS == 'tirage-de-l-annee') {
                    drawYear(finalDraw);
                }else if(drawS == 'tirage-en-croix') {
                    drawCross(finalDraw);
                }else {
                    drawSpread(finalDraw);
                }
                //console.log('dd', drawS)
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
            totalCardsForDrawingCardsEl.style.display = 'none';
            //console.log(cardsSelected)
            launchGetDrawInterpretation(cardsSelected);
        });

        //CUT
        const getDrawCut = function(cut) {
            // CUT
            const finalDrawCutCards = cut.draw;
            // console.log('finalDraw.cut : ', finalDrawCut)
            // console.log('finalDrawCutCards > finalDraw.cut.draw : ', finalDrawCutCards)

            const blockTemplateCut = document.getElementById('draw-interpretation-block-cut').content;
            const cardTemplateCut = document.getElementById('cut-interpretation-card').content;
            let blockCloneCut = document.importNode(blockTemplateCut, true);
            let blockContainerCut = blockCloneCut.querySelector('.tarot-cards-container');
            let blockInterprationCut = blockContainerCut.querySelector('.block-interpretation');

            let containerCards = document.createElement('div');

            console.log(blockInterprationCut)

            Object.entries(finalDrawCutCards).forEach(([k, c]) => {
                if(!c.name) return;

                let cardClone = document.importNode(cardTemplateCut, true);
                let interpretationBlock = document.createElement('div');
                let interpretationBlockCardTitle = document.createElement('h4');
                let interpretationBlockCardName = document.createElement('span');
                let interpretationBlockCardNumber = document.createElement('span');
                let interpretationBlockCardText = document.createElement('p');

                cardClone.querySelector('.card-img').setAttribute('src', c.path);

                cardClone.querySelector('.tarot-card').style.width = cardWidth + "px";
                cardClone.querySelector('.tarot-card').style.height = cardHeight + "px";

                interpretationBlockCardNumber.innerText = c.nbArcane + ' - ';
                interpretationBlockCardName.innerText = c.name;
                interpretationBlockCardTitle.appendChild(interpretationBlockCardNumber);
                interpretationBlockCardTitle.appendChild(interpretationBlockCardName);
                interpretationBlockCardText.innerText = c.interpretation;

                interpretationBlock.appendChild(interpretationBlockCardTitle);
                interpretationBlock.appendChild(interpretationBlockCardText);

                blockInterprationCut.appendChild(interpretationBlock);
                containerCards.appendChild(cardClone);

            });

            containerCards.classList.add('block-cards-cut');

            blockContainerCut.appendChild(containerCards);
            cardMap.firstElementChild.appendChild(blockContainerCut);
        }

        //DRAW CROSS
        const drawCross = function(finalDraw) {

            console.log('process draw', finalDraw)
            
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-cross');

                        // CUT
                        getDrawCut(finalDraw.cut);

                        // DRAW
                        const theFinalDraw = finalDraw.draw;
                        const theFinalDrawCards = theFinalDraw.draw;

                        const blockTemplateDraw = document.getElementById('draw-interpretation-block-draw-cross').content;
                        const cardTemplateDraw = document.getElementById('draw-interpretation-card-draw-cross').content;
                        let blockCloneDraw = document.importNode(blockTemplateDraw, true);
                        let blockContainerDraw = blockCloneDraw.querySelector('.tarot-cards-container');

                        let blockInterpration = blockContainerDraw.querySelector('.block-interpretation');
                        let containerCards = document.createElement('div');

                        let drawPositionsInterpretations = [];

                        if (theFinalDrawCards.drawPositions) {
                            try {
                                drawPositionsInterpretations = JSON.parse(JSON.parse(theFinalDrawCards.drawPositions));
                            } catch (error) {
                                console.error("Error parsing JSON: ", error);
                            }
                        }
                        console.log(drawPositionsInterpretations)

                        Object.entries(theFinalDrawCards).forEach(([k, c]) => {
                            if(!c.name) return;

                            let cardClone = document.importNode(cardTemplateDraw, true);
                            let interpretationBlock = document.createElement('div');
                            let interpretationBlockCardTitle = document.createElement('h4');
                            let interpretationBlockCardName = document.createElement('span');
                            let interpretationBlockCardNumber = document.createElement('span');
                            let interpretationBlockCardText = document.createElement('p');

                            cardClone.querySelector('.card-img').setAttribute('src', c.path);

                            cardClone.querySelector('.tarot-card').style.width = cardWidth + "px";
                            cardClone.querySelector('.tarot-card').style.height = cardHeight + "px";

                            interpretationBlockCardNumber.innerText = c.nbArcane + ' - ';
                            interpretationBlockCardName.innerText = c.name;
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardNumber);
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardName);
                            interpretationBlockCardText.innerText = c.interpretation;

                            let domaineContainerEl = document.createElement('div'); 
                            let domaineIconEl = document.createElement('span'); 
                            let domaineTextEl = document.createElement('span');
                            let domainePositionEl = document.createElement('span');

                            domaineContainerEl.classList.add('domaine');
                            domaineIconEl.classList.add('draw-domaine-icone');
                            domaineTextEl.classList.add('draw-domaine-text');
                            domainePositionEl.classList.add('draw-domaine-position');

                            // Trouver les données de position correspondantes
                            const positionData = drawPositionsInterpretations.find(pos => pos.position === parseInt(k) + 1);

                            if (positionData) {
                                domainePositionEl.innerHTML = parseInt(k) + 1;
                                domaineIconEl.innerHTML = `<i class="${positionData.icone}"></i>`;
                                domaineTextEl.innerText = positionData.keywords;

                                domaineContainerEl.appendChild(domainePositionEl);
                                domaineContainerEl.appendChild(domaineTextEl);
                                domaineContainerEl.appendChild(domaineIconEl);



                                interpretationBlock.appendChild(domaineContainerEl);
                            }

                            interpretationBlock.appendChild(interpretationBlockCardTitle);
                            interpretationBlock.appendChild(interpretationBlockCardText);

                            blockInterpration.appendChild(interpretationBlock);
                            containerCards.appendChild(cardClone);

                        });

                        containerCards.style.minHeight = cardHeight * 3 + "px";
                        containerCards.classList.add('block-cards-draw');
                        blockContainerDraw.appendChild(containerCards);
                        cardMap.firstElementChild.appendChild(blockContainerDraw);

                    }, 500)
                }
            });

        };

        //DRAW spread
        const drawSpread = function(finalDraw) {

            console.log('process draw', finalDraw)
            
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-spread');

                        // CUT
                        getDrawCut(finalDraw.cut);

                        // DRAW
                        const theFinalDraw = finalDraw.draw;
                        const theFinalDrawCards = theFinalDraw.draw;

                        const blockTemplateDraw = document.getElementById('draw-interpretation-block-draw-spread').content;
                        const cardTemplateDraw = document.getElementById('draw-interpretation-card-draw-spread').content;
                        let blockCloneDraw = document.importNode(blockTemplateDraw, true);
                        let blockContainerDraw = blockCloneDraw.querySelector('.tarot-cards-container');

                        let blockInterpration = blockContainerDraw.querySelector('.block-interpretation');
                        let containerCards = document.createElement('div');




                        let drawPositionsInterpretations = [];

                        if (theFinalDrawCards.drawPositions) {
                            try {
                                drawPositionsInterpretations = JSON.parse(JSON.parse(theFinalDrawCards.drawPositions));
                            } catch (error) {
                                console.error("Error parsing JSON: ", error);
                            }
                        }



                        
                        console.log(drawPositionsInterpretations)






                        Object.entries(theFinalDrawCards).forEach(([k, c]) => {
                            if(!c.name) return;

                            let cardClone = document.importNode(cardTemplateDraw, true);
                            let interpretationBlock = document.createElement('div');
                            let interpretationBlockCardTitle = document.createElement('h4');
                            let interpretationBlockCardName = document.createElement('span');
                            let interpretationBlockCardNumber = document.createElement('span');
                            let interpretationBlockCardText = document.createElement('p');

                            cardClone.querySelector('.card-img').setAttribute('src', c.path);

                            cardClone.querySelector('.tarot-card').style.width = cardWidth + "px";
                            cardClone.querySelector('.tarot-card').style.height = cardHeight + "px";

                            interpretationBlockCardNumber.innerText = c.nbArcane + ' - ';
                            interpretationBlockCardName.innerText = c.name;
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardNumber);
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardName);
                            interpretationBlockCardText.innerText = c.interpretation;




                            let domaineContainerEl = document.createElement('div'); 
                            let domaineIconEl = document.createElement('span'); 
                            let domaineTextEl = document.createElement('span');
                            let domainePositionEl = document.createElement('span');

                            domaineContainerEl.classList.add('domaine');
                            domaineIconEl.classList.add('draw-domaine-icone');
                            domaineTextEl.classList.add('draw-domaine-text');
                            domainePositionEl.classList.add('draw-domaine-position');




                            // Trouver les données de position correspondantes
                            const positionData = drawPositionsInterpretations.find(pos => pos.position === parseInt(k) + 1);

                            if (positionData) {
                                domainePositionEl.innerHTML = parseInt(k) + 1;
                                domaineIconEl.innerHTML = `<i class="${positionData.icone}"></i>`;
                                domaineTextEl.innerText = positionData.keywords;

                                domaineContainerEl.appendChild(domainePositionEl);
                                domaineContainerEl.appendChild(domaineTextEl);
                                domaineContainerEl.appendChild(domaineIconEl);



                                interpretationBlock.appendChild(domaineContainerEl);
                            }







                            interpretationBlock.appendChild(interpretationBlockCardTitle);
                            interpretationBlock.appendChild(interpretationBlockCardText);

                            blockInterpration.appendChild(interpretationBlock);
                            containerCards.appendChild(cardClone);

                        });

                        containerCards.style.minHeight = cardHeight * 3 + "px";
                        containerCards.classList.add('block-cards-draw');
                        blockContainerDraw.appendChild(containerCards);
                        cardMap.firstElementChild.appendChild(blockContainerDraw);

                    }, 500)
                }
            });

        };

        //DRAW year
        const drawYear = function(finalDraw) {
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-year');

                        // CUT
                        getDrawCut(finalDraw.cut);

                        // DRAW
                        const theFinalDraw = finalDraw.draw;
                        const theFinalDrawCards = theFinalDraw.draw;

                        const blockTemplateDraw = document.getElementById('draw-interpretation-block-draw-year').content;
                        const cardTemplateDraw = document.getElementById('draw-interpretation-card-draw-year').content;
                        let blockCloneDraw = document.importNode(blockTemplateDraw, true);
                        let blockContainerDraw = blockCloneDraw.querySelector('.tarot-cards-container');

                        const drawPositionsInterpretations = JSON.parse(JSON.parse(theFinalDrawCards.drawPositions));

                        Object.entries(theFinalDrawCards).forEach(([k, c]) => {
                            if(!c.name) return;

                            let cardClone = document.importNode(cardTemplateDraw, true);

                            cardClone.querySelector('.block-card-year .card-img').setAttribute('src', c.path);

                            cardClone.querySelector('.card-nb').innerText = c.nbArcane + ' - ';
                            cardClone.querySelector('.card-name').innerText = c.name;
                            cardClone.querySelector('.card-interpretation-text').innerText = c.interpretation;

                            // Trouver les données de position correspondantes
                            const positionData = drawPositionsInterpretations.find(pos => pos.position === parseInt(k) + 1);

                            if (positionData) {
                                cardClone.querySelector('.draw-domaine-icone').innerHTML = `<i class="${positionData.icone}"></i>`;
                                cardClone.querySelector('.draw-domaine-text').innerText = positionData.keywords;
                            } else {
                                cardClone.querySelector('.draw-domaine-icone').innerHTML = '<i class="fa-thin fa-t-rex"></i>';
                                cardClone.querySelector('.draw-domaine-text').innerText = 'Général';
                            }

                            blockContainerDraw.appendChild(cardClone);

                        });
                        
                        cardMap.firstElementChild.appendChild(blockContainerDraw);


                    }, 500)
                }
            });
        }

        //DRAW DAY
        const drawDay = function(finalDraw) {
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-day');

                        // CUT
                        getDrawCut(finalDraw.cut);

                        // DRAW
                        const theFinalDraw = finalDraw.draw;
                        const theFinalDrawCards = theFinalDraw.draw;

                        const blockTemplateDraw = document.getElementById('draw-interpretation-block-draw-day').content;
                        const cardTemplateDraw = document.getElementById('draw-interpretation-card-draw-day').content;
                        let blockCloneDraw = document.importNode(blockTemplateDraw, true);
                        let blockContainerDraw = blockCloneDraw.querySelector('.tarot-cards-container');

                        let blockInterpration = blockContainerDraw.querySelector('.block-interpretation');
                        let containerCards = document.createElement('div');

                        let drawPositionsInterpretations = [];

                        if (theFinalDrawCards.drawPositions) {
                            try {
                                drawPositionsInterpretations = JSON.parse(JSON.parse(theFinalDrawCards.drawPositions));
                            } catch (error) {
                                console.error("Error parsing JSON: ", error);
                            }
                        }

                        console.log(drawPositionsInterpretations)

                        Object.entries(theFinalDrawCards).forEach(([k, c]) => {
                            if(!c.name) return;

                            let cardClone = document.importNode(cardTemplateDraw, true);
                            let interpretationBlock = document.createElement('div');
                            let interpretationBlockCardTitle = document.createElement('h4');
                            let interpretationBlockCardName = document.createElement('span');
                            let interpretationBlockCardNumber = document.createElement('span');
                            let interpretationBlockCardText = document.createElement('p');

                            cardClone.querySelector('.card-img').setAttribute('src', c.path);

                            cardClone.querySelector('.tarot-card').style.width = cardWidth + "px";
                            cardClone.querySelector('.tarot-card').style.height = cardHeight + "px";

                            interpretationBlockCardNumber.innerText = c.nbArcane + ' - ';
                            interpretationBlockCardName.innerText = c.name;
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardNumber);
                            interpretationBlockCardTitle.appendChild(interpretationBlockCardName);
                            interpretationBlockCardText.innerText = c.interpretation;

                            let domaineContainerEl = document.createElement('div'); 
                            let domaineIconEl = document.createElement('span'); 
                            let domaineTextEl = document.createElement('span');
                            let domainePositionEl = document.createElement('span');

                            domaineContainerEl.classList.add('domaine');
                            domaineIconEl.classList.add('draw-domaine-icone');
                            domaineTextEl.classList.add('draw-domaine-text');
                            domainePositionEl.classList.add('draw-domaine-position');

                            // Trouver les données de position correspondantes
                            const positionData = drawPositionsInterpretations.find(pos => pos.position === parseInt(k) + 1);

                            if (positionData) {
                                domainePositionEl.innerHTML = parseInt(k) + 1;
                                domaineIconEl.innerHTML = `<i class="${positionData.icone}"></i>`;
                                domaineTextEl.innerText = positionData.keywords;

                                domaineContainerEl.appendChild(domainePositionEl);
                                domaineContainerEl.appendChild(domaineTextEl);
                                domaineContainerEl.appendChild(domaineIconEl);



                                interpretationBlock.appendChild(domaineContainerEl);
                            }

                            interpretationBlock.appendChild(interpretationBlockCardTitle);
                            interpretationBlock.appendChild(interpretationBlockCardText);

                            blockInterpration.appendChild(interpretationBlock);
                            containerCards.appendChild(cardClone);

                        });

                        containerCards.classList.add('block-cards-draw');
                        blockContainerDraw.appendChild(containerCards);
                        cardMap.firstElementChild.appendChild(blockContainerDraw);

                    }, 500)
                }
            });
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
