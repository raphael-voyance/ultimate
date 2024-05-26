import gsap from "gsap";

document.addEventListener('livewire:init', () => {

    // VARIABLES
    const drawingCardsPage = document.getElementById('drawing-cards');
    if(drawingCardsPage) {
        const hTitle = document.getElementById('h-title-drawing-cards');
        const tarotCardsContainer = document.getElementById('tarot-cards');
        const selectDrawingCardEl = document.getElementById('select-drawing-card-el');
        const btnNextStep = document.querySelectorAll('[data-next-step]');
        const btnFinalyStep = document.getElementById('btn-finaly-step');
        const btnStepDrawingCard = document.getElementById('btn-step-drawing-card');

        let tarotCards = JSON.parse(tarotCardsContainer.getAttribute('data-cards'));
        const drawingCards = JSON.parse(tarotCardsContainer.getAttribute('data-games'));

        let step;

        let game = 'SELECT_GAME';
        console.log(drawingCards)

        let totalCards;
        let nameOfDrawingCards;
        let selectIsOpen = false;
        let cardsSelected = [];

        let isMobile;
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
            isMobile = true;
        else
            isMobile = false;

        let screenSize = window.innerWidth;
        console.log(screenSize)
        
        // FONCTIONS GLOBALES
        const steping = function(btn) {
            const steps = ['DRAWING_CARD_INTRO', 'SELECT_GAME', 'DRAWING_CARD', 'FINALY_STEP', 'INTERPRETATION_DRAWING_CARD'];

            //Elements
            let activeStep = btn.parentElement.getAttribute('data-step');
            let activeStepEl = document.querySelector('[data-step="'+ activeStep +'"]');
            let nextStep = btn.getAttribute('data-next-step');
            let nextStepEl = document.querySelector('[data-step="'+ nextStep +'"]');
            let btnPrevStep = document.querySelectorAll('[data-prev-step]');
            let prevStep;
            let prevStepEl;

            //Get visible nextStepEl & Mask activeStepEl
            activeStepEl.classList.add('hidden');
            nextStepEl.classList.remove('hidden');

            //Create & Manipulate DrawingCardsList
            let createDrawingCardsList = function(){
                drawingCards.forEach(g => {
                
                let li = document.createElement('li');
                    
                li.setAttribute('data-total-cards', g.totalSelectedCards)

                li.classList = 'text-center cursor-pointer transition-all hover:scale-105';

                let name = g.name;
                let nameEl = document.createElement('h4');
                nameEl.textContent = name;
                let desc = g.description;
                let descEl = document.createElement('p');
                descEl.textContent = desc;

                nameEl.classList = 'bg-accent';
                descEl.classList = 'bg-secondary px-2';

                li.append(nameEl);
                li.append(descEl);
                selectDrawingCardEl.append(li);
                

                li.addEventListener('click', () => {

                    let otherLi = document.querySelectorAll('[data-total-cards]');

                    otherLi.forEach(el => {
                        el.classList.remove('scale-105')
                    })
                    li.classList.add('scale-105')
                    
                    btnStepDrawingCard.classList.remove('hidden')

                    totalCards = g.totalSelectedCards;
                    nameOfDrawingCards = nameEl;
                    
                })
            
            })
            }
            createDrawingCardsList();
            

            //Prev Step
            btnPrevStep.forEach(btn => {
                btn.addEventListener('click', () => {
                    activeStep = btn.parentElement.getAttribute('data-step');
                    activeStepEl = document.querySelector('[data-step="'+ activeStep +'"]');
                    prevStep = btn.getAttribute('data-prev-step');
                    prevStepEl = document.querySelector('[data-step="'+ prevStep +'"]');

                    selectDrawingCardEl.innerHTML = '';
                    createDrawingCardsList();

                    console.log(activeStepEl)

                    activeStepEl.classList.add('hidden');
                    prevStepEl.classList.remove('hidden');
                })
            })
            

            if(nextStep == 'DRAWING_CARD') {
                tarotCards = gsap.utils.shuffle(tarotCards)
                createDeck(tarotCards, tarotCardsContainer)
            }

        }

        const createDeck = function($tarotCards, $container) {

            let cardsContainerWidth = $container.offsetWidth;
            let cardWidth = Math.floor((cardsContainerWidth / $tarotCards.length) * 2.2)
            let cardHeight = cardWidth * 1.85

            $tarotCards.forEach(card => {
                let li = document.createElement('li')

                li.setAttribute('id', 'tarot-card-'+ card.slug + '-' + card.id)
                li.innerHTML = `<img class="w-full h-full object-contain" src="${card.imgPath}"/>`

                li.style.width = cardWidth + 'px'
                li.style.height = cardHeight + 'px'

                li.classList = 'tarot-card flex-none cursor-pointer absolute left-[50%] -translate-x-[50%]'
                $container.appendChild(li)

                selectCard(li, totalCards);
            });
        }

        const etaleDeck = function() {
            
            let tarotCardsEl = document.querySelectorAll('.tarot-card')

            selectIsOpen = true;
            
            
            for(let $i = 0; $i < tarotCardsEl.length; $i++) {
                let cardHeight = tarotCardsEl[$i].style.height;
                let cardWidth = tarotCardsEl[$i].style.width;
                
                tarotCardsEl[$i].classList.add('hover:-mt-4')
                tarotCardsEl[$i].classList.remove('-translate-x-[50%]')
                tarotCardsEl[$i].classList.remove('left-[50%]')
                tarotCardsEl[$i].classList.remove('left-auto')

                tarotCardsEl[$i].style.cssText = '';
                tarotCardsEl[$i].style.width = cardWidth
                tarotCardsEl[$i].style.height = cardHeight
                
                setTimeout(() => {
                // if($i > 0) {
                    const translateXValue = 30 * ($i);
                    tarotCardsEl[$i].classList.add('transition-all')  
                    tarotCardsEl[$i].style.transform = `translateX(${translateXValue}%)`;
                // }
            }, 100)
                
            }
            
        }

        const schuffleDeck = function() {

            tarotCardsContainer.innerHTML = "";

            selectIsOpen = false;

            tarotCards = gsap.utils.shuffle(tarotCards)

            createDeck(tarotCards, tarotCardsContainer)

            let tarotCardsEl = document.querySelectorAll('.tarot-card')

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
                    ease: "power1.inOut"
                });
            }
        });

            
            
        }

        const cutDesk = function() {

        }

        const selectCard = function(el, numberTotalCards) {

            el.addEventListener('click', function() {

                if(cardsSelected.length == numberTotalCards) {
                    console.log(cardsSelected)
                    btnFinalyStep.classList.remove('hidden')
                    return;
                }

                if(selectIsOpen) {
                    console.log(el)
                let numberArcane = el.getAttribute('id').split('-').pop();
                console.log(numberArcane)

                let found = cardsSelected.find((item) => item == numberArcane);

                console.log(found)

                if(el.classList.contains('selected') && found == numberArcane) {
                    el.classList.remove('selected')
                    el.classList.remove('-mt-4')
                    cardsSelected = cardsSelected.filter((item) => item != numberArcane);
                }else {
                    el.classList.add('selected')
                    el.classList.add('-mt-4')
                    cardsSelected.push(numberArcane)
                }

                }

            })

            
        }
        
        // CONSTRUCTION DU TIRAGE
        
        btnNextStep.forEach(btn => {
            btn.addEventListener('click', () => {
                steping(btn);
            });
        });
        
        document.getElementById('etale-btn').addEventListener('click', etaleDeck);
        document.getElementById('shuffle-btn').addEventListener('click', schuffleDeck);

    }
})