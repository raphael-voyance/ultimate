import { Moon } from "lunarphase-js";

window.addEventListener("load", () => {
    let $lunarPhaseEl = document.getElementById("lunar_phase_text");
    let $lunarPhaseEmojiEl = document.getElementById("lunar_phase_emoji");
    let $isWaningEl = document.getElementById("lunar_is_waning");
    let $isWaxingEl = document.getElementById("lunar_is_waxing");
    let $lunarAgeEl = document.getElementById("lunar_age");

    if ($lunarPhaseEl != null) {
        $lunarPhaseEl.innerText = " Phase de la lune : " + translateLunarPhase();
    }
    if ($lunarPhaseEmojiEl != null) {
        $lunarPhaseEmojiEl.innerText =
            " Emoji de la lune : " + Moon.lunarPhaseEmoji();
    }
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
