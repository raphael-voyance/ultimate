//Imports
import { wrapElements } from '../helpers/utils.js';
import { gsap } from "gsap";
import "splitting/dist/splitting.css";
import "splitting/dist/splitting-cells.css";
import Splitting from "splitting";

// La parge est en cours de chargement :
window.addEventListener('DOMContentLoaded', () => {
    // Si nécessaire en fonction du chargement finale de la page
        // Créer un effet de superposition de div couleurs clairs animer avec un blur effect, qui disparait au load complet pour laisser les animations de texte
});

// La parge est chargée :
window.addEventListener('load', () => {
    // Splitting.js
// Calling the Splitting function to split the text into individual words/characters,
const splittingOutput = Splitting();

const containerElement = document.getElementById('hero_messages');

// .content__text elements
const texts = [...document.querySelectorAll('.content__text')];

// Cache all .char elements at the beginning. Each text contains multiple words, each word contains multiple chars.
const chars = texts.map(text => {
    // Get the words for each text
    const words = text.querySelectorAll('.word');
    // For each word, get the chars
    return [...words].map(word => word.querySelectorAll('.char'));
});

// Let's define the position of the current text
let allTextPos = texts.length - 1;
let currentTextPos = 0;

// Check if there's an animation in progress
let isAnimating = false;

// Add class current to the "current" one
texts[currentTextPos].classList.add('content__text--current');

// switch between texts
const switchTexts = () => {

    if ( isAnimating ) return false;
    isAnimating = true;

    if(currentTextPos > allTextPos) {
        currentTextPos = 0
    }

    const upcomingTextPos = currentTextPos+1 > allTextPos ? 0 : currentTextPos+1;

    // All current text words
    const currentWords = splittingOutput[currentTextPos].words;

    // All upcoming text words
    const upcomingtWords = splittingOutput[upcomingTextPos].words;

    const tl = gsap.timeline({
        onComplete: () => {
            currentTextPos++;
            isAnimating = false;
        }
    });
    currentWords.forEach((_, wordIndex) => {
        const wordTimeline = gsap.timeline()
        .fromTo(chars[currentTextPos][wordIndex], {
            willChange: 'transform, opacity',
            scale: 1
        }, {
            duration: .2,
            ease: 'power1.in',
            opacity: 0,
            scale: 0,
            stagger: {
                each: 0.03,
                from: 'edges'
            },
        });
        tl.add(wordTimeline, Math.random()*.5);
    });

    tl.add(() => {
        texts[currentTextPos].classList.remove('content__text--current');
        texts[upcomingTextPos].classList.add('content__text--current');
    })
    .addLabel('previous', '>');

    upcomingtWords.forEach((_, wordIndex) => {
        const wordTimeline = gsap.timeline()
        .fromTo(chars[upcomingTextPos][wordIndex], {
            willChange: 'transform, opacity',
            opacity: 0,
            scale: 1.7
        }, {
            duration: .5,
            ease: 'power3.out',
            opacity: 1,
            scale: 1,
            stagger: {
                each: 0.03,
                from: 'edges'
            },
        })
        tl.add(wordTimeline, `previous+=${Math.random()*.5}`);
    });

};

const intervalTime = 6500; //6500
let intervalID = setInterval(switchTexts, intervalTime);

containerElement.addEventListener('mouseenter', function() {
    clearInterval(intervalID);
});

containerElement.addEventListener('mouseleave', function() {
    intervalID = setInterval(switchTexts, intervalTime);
});

})
