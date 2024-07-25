import { Moon } from "lunarphase-js";
import luneCroissante from './moonImgs/lune-croissante.svg';
import luneDecroissante from './moonImgs/lune-decroissante.svg';
import luneGibCroissante from './moonImgs/lune-gibbeuse-croissante.svg';
import luneGibDecroissante from './moonImgs/lune-gibbeuse-decroissante.svg';
import premierQuartier from './moonImgs/premier-quartier.svg';
import dernierquartier from './moonImgs/dernier-quartier.svg';
import pleineLune from './moonImgs/pleine-lune.svg';
import nouvelleLune from './moonImgs/nouvelle-lune.svg';

window.addEventListener("load", () => {
    
    let $lunarImgEl = document.getElementById('lunar_img');
    let $lunarImgTitle = document.getElementById('lunar_img_title');

    if ($lunarImgEl != null) {
        lunarPhaseImg($lunarImgEl, $lunarImgTitle, translateLunarPhase());
    }

    // let $lunarPhaseEmojiEl = document.getElementById("lunar_phase_emoji");
    // let $lunarPhaseEl = document.getElementById("lunar_phase_text");
    let $isWaningEl = document.getElementById("lunar_is_waning");
    let $isWaxingEl = document.getElementById("lunar_is_waxing");
    let $lunarAgeEl = document.getElementById("lunar_age");
    
    
    // if ($lunarPhaseEl != null) {
    //     $lunarPhaseEl.innerText = " Phase de la lune : " + translateLunarPhase();
    //     lunarPhaseImg();
    // }
    // if ($lunarPhaseEmojiEl != null) {
    //     $lunarPhaseEmojiEl.innerText =
    //         " Emoji de la lune : " + Moon.lunarPhaseEmoji();
    // }
    if ($isWaningEl != null) {
        $isWaningEl.innerText = " Lune décroissante : " + Moon.isWaning();
    }
    if ($isWaxingEl != null) {
        $isWaxingEl.innerText = " Lune croissante : " + Moon.isWaxing();
    }
    if ($lunarAgeEl != null) {
        $lunarAgeEl.innerText =
            " Age en jour de la lune depuis la dernière nouvelle lune : " +
            Moon.lunarAge();
    }

    function lunarPhaseImg(el, titleImgEl, phase) {
        const $expr = Moon.lunarPhase();
        // const $expr = 'Waning Gibbous';
        // const $expr = 'Last Quarter';
        // const $expr = 'Waning Crescent';
        // const $expr = 'New';
        // const $expr = 'Waxing Gibbous';
        // const $expr = 'First Quarter';
        // const $expr = 'Waxing Crescent';
        // const $expr = 'Full';
        let moonImgEl = el;
        let imgMoonTitle = titleImgEl;

        //console.log($expr)
        switch ($expr) {
            case 'Waxing Crescent':
                moonImgEl.setAttribute('src', luneCroissante);
                break;
            case 'First Quarter':
                moonImgEl.setAttribute('src', premierQuartier);
                break;
            case 'Waxing Gibbous':
                moonImgEl.setAttribute('src', luneGibCroissante);
                break;
            case 'Full':
                moonImgEl.setAttribute('src', pleineLune);
                break;
            case 'Waning Gibbous':
                moonImgEl.setAttribute('src', luneGibDecroissante);
                break;
            case 'Last Quarter':
                moonImgEl.setAttribute('src', dernierquartier);
                break;
            case 'Waning Crescent':
                moonImgEl.setAttribute('src', luneDecroissante);
                break;
            case 'New':
                moonImgEl.setAttribute('src', nouvelleLune);
                break;

            default:
                console.log(`Sorry, we are out of $expr.`);
        }

        moonImgEl.setAttribute('alt', phase);
        moonImgEl.setAttribute('title', phase);

        imgMoonTitle.innerText = phase;

    }

    function translateLunarPhase() {
        const $expr = Moon.lunarPhase();
        console.log($expr)
        switch ($expr) {
            case 'Waxing Crescent':
                return 'Lune croissante';
                break;
            case 'First Quarter':
                return 'Premier quartier';
                break;
            case 'Waxing Gibbous':
                return 'Lune gibbeuse croissante';
                break;
            case 'Full':
                return 'Pleine lune';
                break;
            case 'Waning Gibbous':
                return 'Lune gibbeuse décroissante';
                break;
            case 'Last Quarter':
                return 'Dernier quartier';
                break;
            case 'Waning Crescent':
                return 'Lune décroissante';
                break;
            case 'New':
                return 'Nouvelle lune';
                break;

            default:
                console.log(`Sorry, we are out of $expr.`);
        }
    }

    function lunarMode() {
        if(Moon.isWaning() == false) {
            return 'Lune Croissante'
        }else {
            return 'Lune déroissante'
        }
    }

    console.log(lunarMode());

    // Get Season
    let $seasonEl = document.getElementById("season_text");

    function getSeason() {
        // Récupérer la date actuelle
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1; 

        // Déterminer la saison en fonction de la date
        if (
            (currentMonth === 3 && currentDate.getDate() >= 21) ||
            (currentMonth > 3 && currentMonth < 6) ||
            (currentMonth === 6 && currentDate.getDate() < 21)
        ) {
            return "Printemps";
        } else if (
            (currentMonth === 6 && currentDate.getDate() >= 21) ||
            (currentMonth > 6 && currentMonth < 9) ||
            (currentMonth === 9 && currentDate.getDate() < 21)
        ) {
            return "Été";
        } else if (
            (currentMonth === 9 && currentDate.getDate() >= 21) ||
            (currentMonth > 9 && currentMonth < 12) ||
            (currentMonth === 12 && currentDate.getDate() < 21)
        ) {
            return "Automne";
        } else {
            return "Hiver";
        }
    }

    if ($seasonEl != null) {
        $seasonEl.innerText =
            " Saison actuelle : " +
            getSeason();
    }

});
