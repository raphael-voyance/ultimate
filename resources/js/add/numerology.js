import { loader } from "../helpers/utils.js";
import { French } from "flatpickr/dist/l10n/fr.js";
import flatpickr from "flatpickr";
import axios from "axios";

window.addEventListener("load", () => {
    let $numerologyDetailsEl = document.getElementById("numerology_details");
    let $numerologyContentEl = document.getElementById("numerology_details_content");
    let $lifePathEls = document.querySelectorAll(".life_path");
    let $annualPathEls = document.querySelectorAll(".annual_path");
    let $sumPathEls = document.querySelectorAll(".sum_path");
    let $birthdateEls = document.querySelectorAll(".birthdate_path");

    let $createFormBirthdateBtnEl = document.createElement("button");

    let $arcaneLifePathImgEl = document.createElement("img");
    let $arcaneLifePathDescEl = document.createElement("p");
    let $arcaneAnnualPathDescEl = document.createElement("p");
    let $arcaneAnnualPathImgEl = document.createElement("img");
    let $arcaneSumPathDescEl = document.createElement("p");
    let $arcaneSumPathImgEl = document.createElement("img");
    let $containerArcaneLifePathEls = document.querySelectorAll(".container_arcane_life_path");
    let $containerArcaneAnnualPathEls = document.querySelectorAll(".container_arcane_annual_path");
    let $containerArcaneSumPathEls = document.querySelectorAll(".container_arcane_sum_path");

    let $birthDate;
    let $lifePath;
    let $annualPath;
    let $sumPath;
    let $arcaneLifePathImg;
    let $arcaneAnnualPathImg;
    let $arcaneSumPathImg;
    let createFormBirthdateIsOpen = false;

    if ($lifePathEls || $annualPathEls) {
        loader.show($numerologyDetailsEl.getAttribute("id"));
        $numerologyContentEl.style.display = "none"

        axios
            .get("/mon-espace/get-previsions")
            .then(function (response) {
                // handle success
                
                if (!response.data.numerology) {
                    $numerologyDetailsEl.innerText =
                        "Pour calculer votre chemin de vie, merci de saisir votre date de naissance.";
                    createFormBirthDate(submitForm);
                    return false;
                }

                console.log(response.data)

                $numerologyContentEl.style.display = "block"

                $birthDate = response.data.numerology.birthdate;
                $createFormBirthdateBtnEl.innerText = 'Modifier votre date de naissance';

                $numerologyDetailsEl.appendChild($createFormBirthdateBtnEl);

                $createFormBirthdateBtnEl.addEventListener('click', () => {
                    let $FormBirthdateEl = document.querySelector('[data="FormBirthdate"]')
                    if(!createFormBirthdateIsOpen) {
                        createFormBirthDate(submitForm, $birthDate);
                    }else {
                        createFormBirthdateIsOpen = false;
                        $FormBirthdateEl.remove()
                    }
                })

                $lifePath = response.data.numerology.lifePath;
                $annualPath = response.data.numerology.annualPath;
                $sumPath = response.data.numerology.sumPath;

                $birthdateEls.forEach(function($birthdateEl) {
                    $birthdateEl.innerText = $birthDate;
                });
                $lifePathEls.forEach(function($lifePathEl) {
                    $lifePathEl.innerText = $lifePath;
                });
                $annualPathEls.forEach(function($annualPathEl) {
                    $annualPathEl.innerText = $annualPath;
                });
                $sumPathEls.forEach(function($sumPathEl) {
                    $sumPathEl.innerText = $sumPath;
                });

                $arcaneAnnualPathImg = response.data.tarology.arcaneAnnualPath;
                $arcaneLifePathImg = response.data.tarology.arcaneLifePath;
                $arcaneSumPathImg = response.data.tarology.arcaneSumPath;

                $arcaneLifePathDescEl.innerText = $arcaneLifePathImg.description;
                $arcaneLifePathDescEl.classList = 'text-sm mt-3 text-center';
                $arcaneLifePathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneLifePathImgEl.setAttribute('src', $arcaneLifePathImg.imgPath);
                $arcaneLifePathImgEl.setAttribute('alt', $arcaneLifePathImg.name);
                $arcaneLifePathImgEl.setAttribute('title', $arcaneLifePathImg.name);
                $containerArcaneLifePathEls.forEach(function($containerArcaneLifePathEl){
                    $containerArcaneLifePathEl.appendChild($arcaneLifePathImgEl)
                    $containerArcaneLifePathEl.appendChild($arcaneLifePathDescEl)
                });

                $arcaneAnnualPathDescEl.innerText = $arcaneAnnualPathImg.description;
                $arcaneAnnualPathDescEl.classList = 'text-sm mt-3 text-center';
                $arcaneAnnualPathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneAnnualPathImgEl.setAttribute('src', $arcaneAnnualPathImg.imgPath);
                $arcaneAnnualPathImgEl.setAttribute('alt', $arcaneAnnualPathImg.name);
                $arcaneAnnualPathImgEl.setAttribute('title', $arcaneAnnualPathImg.name);
                $containerArcaneAnnualPathEls.forEach(function($containerArcaneAnnualPathEl){
                    $containerArcaneAnnualPathEl.appendChild($arcaneAnnualPathImgEl)
                    $containerArcaneAnnualPathEl.appendChild($arcaneAnnualPathDescEl)
                });

                $arcaneSumPathDescEl.innerText = $arcaneSumPathImg.description;
                $arcaneSumPathDescEl.classList = 'text-sm mt-3 text-center';
                $arcaneSumPathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneSumPathImgEl.setAttribute('src', $arcaneSumPathImg.imgPath);
                $arcaneSumPathImgEl.setAttribute('alt', $arcaneSumPathImg.name);
                $arcaneSumPathImgEl.setAttribute('title', $arcaneSumPathImg.name);
                $containerArcaneSumPathEls.forEach(function($containerArcaneSumPathEl){
                    $containerArcaneSumPathEl.appendChild($arcaneSumPathImgEl)
                    $containerArcaneSumPathEl.appendChild($arcaneSumPathDescEl)
                });

            })
            .catch(function (error) {
                // handle error
                console.log("Error");
            })
            .finally(function () {
                loader.hide();
            });
    }

    function createFormBirthDate($submitFn, $DateValue) {
        const $formContainer = document.createElement("form");
        const $inputContainer = document.createElement("div");
        const $input = document.createElement("input");
        const $btn = document.createElement("button");
        const $icon = document.createElement("div");

        $formContainer.classList = "max-w-xs flex flex-row gap-2";
        $formContainer.setAttribute('data', 'FormBirthdate');
        createFormBirthdateIsOpen = true;

        flatpickr($input, {
            locale: French,
            dateFormat: "d/m/Y",
        });
        $input.classList =
            "input input-primary pl-12 w-full peer focus:border-none focus:ring-primary-focus";

        if($DateValue) { $input.value = $DateValue; }

        $btn.addEventListener("click", (e) => {
            e.preventDefault();
        });
        $btn.innerText = "OK";
        $btn.classList = "btn btn-circle btn-primary";

        $inputContainer.classList = "relative";

        $icon.style.position = "absolute";
        $icon.style.top = "0";
        $icon.style.left = "10px";
        $icon.style.lineHeight = "2.8rem";
        $icon.style.height = "3rem";
        $icon.style.width = "3rem";

        $icon.innerHTML = `<svg class="inline w-7 h-7 stroke-slate-400/60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"></path>
      </svg>`;

        $inputContainer.appendChild($input);
        $inputContainer.appendChild($icon);
        $formContainer.appendChild($inputContainer);
        $formContainer.appendChild($btn);
        $numerologyDetailsEl.appendChild($formContainer);

        $btn.addEventListener("click", (e) => {
            e.preventDefault();
            $submitFn($input.value);
        });
    }

    function submitForm(birthdate) {

        axios
            .post("/mon-espace/post-birthdate", {
                birthdate: birthdate,
            })
            .then(function (response) {

                if (!response.data.numerology) {
                    $numerologyDetailsEl.innerText =
                        "Pour calculer votre chemin de vie, merci de saisir votre date de naissance.";
                    createFormBirthDate(submitForm);
                    return false;
                }

                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    }

});
