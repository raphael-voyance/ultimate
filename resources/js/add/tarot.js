import gsap from "gsap";

window.addEventListener("load", () => {
    // VARIABLES
    const tarotCardsContainer = document.getElementById('tarot-cards');
    let tarotCards = JSON.parse(tarotCardsContainer.getAttribute('data-cards'))
    let isMobile;
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
        isMobile = true;
    else
        isMobile = false;

    let screenSize = window.innerWidth;
    console.log(screenSize)

    // FONCTIONS GLOBALES
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

            selectCard(li);
        });
    }

    const etaleDeck = function() {
        
        let tarotCardsEl = document.querySelectorAll('.tarot-card')
        
        
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

    const selectCard = function(el) {

        let cardsSelected = [];

        el.addEventListener('click', function() {

            if(el.classList.contains('selected')) {
                el.classList.remove('selected')
                el.classList.remove('-mt-4')
            }else {
                el.classList.add('selected')
                el.classList.add('-mt-4')
                cardsSelected.push(el)
            }

            
            console.log(cardsSelected)
        })

        
    }
    
    // CONSTRUCTION DU TIRAGE

    createDeck(tarotCards, tarotCardsContainer)
        
    document.getElementById('etale-btn').addEventListener('click', etaleDeck);
    document.getElementById('shuffle-btn').addEventListener('click', schuffleDeck);
        
    })