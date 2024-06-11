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
                backCardEl.innerHTML = `<img class="w-full h-full object-contain" src="http://ultimate.test/imgs/tarot/back-card.png"/>`;

                li.appendChild(backCardEl);
                li.appendChild(frontCardEl);

                $container.appendChild(li);

                selectCard(li);
            });

        };

        const spreadDeck = function () {
            
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
                    duration: 1.3,
                    x: () => gsap.utils.random(-60, 60),
                    y: () => gsap.utils.random(-60, 60),
                    rotation: () => gsap.utils.random(-120, 120),
                    stagger: .08,
                    ease: "power1-inOut",
                    onComplete: () => {
                        gsap.to(tarotCardsEl, {
                            duration: 0.8,
                            y: 0,
                            x: 0,
                            rotation: 0,
                            stagger: 0.1,
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

                const finalDraw = {
                    cut: interpretationCardCut,
                    draw: interpretationCardDraw
                }

                interpretationDrawingCardBtn.classList.add('hidden');

                closeDeck();

                let drawS = interpretationCardDraw.drawSlug;
                if(drawS == 'tirage_de_la_journee') {
                    drawDay(finalDraw);
                }else if(drawS == 'tirage_de_la_semaine') {
                    drawWeek(finalDraw);
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

        const duplicateCardDraw = (draw) => {
            let tarotCardsEl = document.querySelectorAll(".tarot-card");
            let duplicatedCardsEl = {};

            const containerDrawEl = document.createElement('ul');
            containerDrawEl.classList.add('tarot-cards-container', 'tarot-cards-container-draw');
            containerDrawEl.style.width = cardWidth + "px";
            containerDrawEl.style.height = cardHeight + "px";

            const containerCutEl = document.createElement('ul');
            containerCutEl.classList.add('tarot-cards-container', 'tarot-cards-container-cut');
            containerCutEl.style.width = cardWidth + "px";
            containerCutEl.style.height = cardHeight + "px";

            // Duplication des cartes du tirage en fonction de l'attribut data-number
            draw.draw.cards.forEach((c) => {
                let cardToDuplicate = Array.from(tarotCardsEl).find((item) => item.dataset.number == c);
                if (cardToDuplicate) {
                    let clone = cardToDuplicate.cloneNode(true);
                    clone.classList = '';
                    clone.style = '';

                    clone.classList.add('tarot-card');

                    clone.style.width = cardWidth + "px";
                    clone.style.height = cardHeight + "px";

                    containerDrawEl.appendChild(clone);
                    
                }
            });

            // Duplication des cartes de la coupe en fonction de l'attribut data-number
            draw.cut.cards.forEach((c) => {
                let cardToDuplicate = Array.from(tarotCardsEl).find((item) => item.dataset.number == c);
                if (cardToDuplicate) {

                    let clone = cardToDuplicate.cloneNode(true);
                    clone.classList = '';
                    clone.style = '';

                    clone.classList.add('tarot-card');

                    clone.style.width = cardWidth + "px";
                    clone.style.height = cardHeight + "px";

                    containerCutEl.appendChild(clone);
                }
            });

            duplicatedCardsEl.cut = containerCutEl;
            duplicatedCardsEl.draw = containerDrawEl;

            return duplicatedCardsEl;

        };

        const drawCross = function(finalDraw) {
            const drawCardsAllEl = duplicateCardDraw(finalDraw);

            const cutCardsEl = drawCardsAllEl.cut;
            const drawCardsEl = drawCardsAllEl.draw;
            
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-cross');

                        console.log('final draw : ', finalDraw)

                        const interpretationCutEl = document.createElement('div');
                        const interpretationCut = finalDraw.cut;
                        const drawCut = interpretationCut.draw;

                        console.log('finalDraw.cut : ', interpretationCut)
                        console.log('finalDraw.cut.draw : ', drawCut)

                        

                        Object.entries(drawCut).forEach(([k, c]) => {
                            let cardName = c.name;
                            let cardPath = c.path;
                            let cardNb = c.nbArcane;
                            let cardInterpretation = c.interpretation;

                            let cardNameEl = document.createElement('h4');
                            let cardImgEl = document.createElement('img');
                            let cardNbEl = document.createElement('span');
                            let cardInterpretationEl = document.createElement('p');

                            cardNameEl.innerText = cardName;
                            cardImgEl.setAttribute('src', cardPath);
                            cardNbEl.innerText = cardNb + ' - ';
                            cardInterpretationEl.innerText = cardInterpretation;
                            
                            interpretationCutEl.appendChild(cardImgEl);
                            interpretationCutEl.appendChild(cardNbEl);
                            interpretationCutEl.appendChild(cardNameEl);
                            interpretationCutEl.appendChild(cardInterpretationEl);

                            console.log('frfffff', interpretationCutEl)
                            cardMap.firstElementChild.appendChild(interpretationCutEl);

                        });


                        cardMap.firstElementChild.appendChild(cutCardsEl);



                        cardMap.firstElementChild.appendChild(drawCardsEl);

                        

                        requestAnimationFrame(() => {
                            let dc = document.querySelectorAll(".draw-cross .tarot-cards-container.tarot-cards-container-draw li");
                            let dcc = document.querySelector(".draw-cross .tarot-cards-container.tarot-cards-container-draw");

                            dcc.style.transform = 'translateX(-100%)';
                            dcc.style.minHeight = `${cardHeight * 3}px`;
                            dcc.style.marginTop = '3em';
                            dc.forEach((el, i) => {
                                if(i == 0) {
                                    el.style.transform = `translateY(100%)`;
                                }
                                if(i == 1) {
                                    el.style.transform = `translateX(200%) translateY(100%)`;
                                }
                                if(i == 2) {
                                    el.style.transform = `translateX(100%)`;
                                }
                                if(i == 3) {
                                    el.style.transform = `translateX(100%) translateY(200%)`;
                                }
                                if(i == 4) {
                                    el.style.transform = `translateX(100%) translateY(100%)`;
                                }
                            })

                        });

                    }, 500)
                }
            });

        }

        const drawWeek = function(finalDraw) {
            console.log('drawWeek', finalDraw);

            const drawCardsAllEl = duplicateCardDraw(finalDraw);

            const cutCardsEl = drawCardsAllEl.cut;
            const drawCardsEl = drawCardsAllEl.draw;
            
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-week');
                        cardMap.firstElementChild.appendChild(cutCardsEl);
                        cardMap.firstElementChild.appendChild(drawCardsEl);

                        requestAnimationFrame(() => {
                            let dc = document.querySelectorAll(".draw-week .tarot-cards-container.tarot-cards-container-draw li");
                            let dcc = document.querySelector(".draw-week .tarot-cards-container.tarot-cards-container-draw");
                            console.log(dc);

                            dcc.style.marginLeft = '1.5em';
                            dc.forEach((el, i) => {
                                el.style.transform = `translateX(${100 * i}%)`;
                            })

                        });

                    }, 500)
                }
            });
        }

        const drawDay = function(finalDraw) {
            console.log('drawday', finalDraw);
            const drawCardsAllEl = duplicateCardDraw(finalDraw);

            const cutCardsEl = drawCardsAllEl.cut;
            const drawCardsEl = drawCardsAllEl.draw;
            
            gsap.to(tarotCardsContainer, {
                duration: 1,
                scale: .8,
                opacity: 0,
                ease: "power1.out",
                onComplete: () => {
                    setTimeout(() => {
                        tarotCardsContainer.remove();
                        cardMap.classList.add('draw-day');
                        cardMap.firstElementChild.appendChild(cutCardsEl);
                        cardMap.firstElementChild.appendChild(drawCardsEl);
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
