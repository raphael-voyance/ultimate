import { loader, formatDateString } from "../../helpers/utils.js";
import axios from "axios";

window.addEventListener("load", () => {
    let $numerologyDetailsEl = document.getElementById("numerology_details");
    let $numerologyDetailsHeaderEl = document.getElementById("numerology_details_content_header");
    let $numerologyDetailsHeaderContainerFormEl = document.createElement('div');

    let $childrens = $numerologyDetailsHeaderEl.children;
    
    let $numerologyContentEl = document.getElementById("numerology_details_content");
    let $lifePathEls = document.querySelectorAll(".life_path");
    let $annualPathEls = document.querySelectorAll(".annual_path");
    let $sumPathEls = document.querySelectorAll(".sum_path");
    let $birthdateEls = document.querySelectorAll(".birthdate_path");
    let $containerLifePath = document.getElementById('container_life_path');
    let $containerAnnualPath = document.getElementById('container_annual_path');
    let $containerSumPath = document.getElementById('container_sum_path');

    let $createFormBirthdateBtnEl = document.createElement("button");

    let $containerArcaneLifePathEls = document.querySelectorAll(".container_arcane_life_path");
    let $arcaneLifePathImgEl = document.createElement("img");
    let $arcaneLifePathDescEl = document.createElement("p");
    let $arcaneLifePathNameEl = document.createElement("h4");
    let $arcaneLifePathNumberEl = document.createElement("span");

    let $containerArcaneAnnualPathEls = document.querySelectorAll(".container_arcane_annual_path");
    let $arcaneAnnualPathDescEl = document.createElement("p");
    let $arcaneAnnualPathImgEl = document.createElement("img");
    let $arcaneAnnualPathNameEl = document.createElement("h4");
    let $arcaneAnnualPathNumberEl = document.createElement("span");

    let $containerArcaneSumPathEls = document.querySelectorAll(".container_arcane_sum_path");
    let $arcaneSumPathDescEl = document.createElement("p");
    let $arcaneSumPathImgEl = document.createElement("img");
    let $arcaneSumPathNameEl = document.createElement("h4");
    let $arcaneSumPathNumberEl = document.createElement("span");

    let $birthDate;
    let $lifePath;
    let $annualPath;
    let $sumPath;
    let $lifePathInterpretation;
    let $annualPathInterpretation;
    let $sumPathInterpretation;
    let $arcaneLifePath;
    let $arcaneAnnualPath;
    let $arcaneSumPath;
    let createFormBirthdateIsOpen = false;
    let $imgArcaneLifePath;
    let $nameArcaneLifePath;
    let $imgArcaneAnnualPath;
    let $nameArcaneAnnualPath;
    let $imgArcaneSumPath;
    let $nameArcaneSumPath;
    let $interpretationArcaneLifePath;
    let $interpretationArcaneAnnualPath;
    let $interpretationArcaneSumPath;

    if ($lifePathEls || $annualPathEls) {
        loader.show($numerologyDetailsEl.getAttribute("id"), null, ['mt-4']);
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

                $numerologyContentEl.style.display = "block";

                $birthDate = response.data.numerology.birthdate;
                $createFormBirthdateBtnEl.style.minHeight = "48px";
                $createFormBirthdateBtnEl.classList = 'btn btn-outline';
                $createFormBirthdateBtnEl.innerText = 'Modifier votre date de naissance';
                
                console.log($childrens)

                if ($childrens.length >= 2) {
                    $numerologyDetailsHeaderEl.insertBefore($createFormBirthdateBtnEl, $childrens[1]);
                } else {
                    $numerologyDetailsHeaderEl.appendChild($createFormBirthdateBtnEl);
                }
                $numerologyDetailsHeaderEl.prepend($numerologyDetailsHeaderContainerFormEl);

                $createFormBirthdateBtnEl.addEventListener('click', () => {
                    let $FormBirthdateEl = document.querySelector('[data="FormBirthdate"]')
                    if(!createFormBirthdateIsOpen) {
                        createFormBirthdateIsOpen = true;
                        $createFormBirthdateBtnEl.style.display = "none";
                        createFormBirthDate(submitForm, $birthDate, $birthDate);
                    }else {
                        createFormBirthdateIsOpen = false;
                        $FormBirthdateEl.remove();
                    }
                })

                $lifePath = response.data.numerology.lifePath;
                $lifePathInterpretation = response.data.numerology.interpretationLifePath;
                $annualPath = response.data.numerology.annualPath;
                $annualPathInterpretation = response.data.numerology.interpretationAnnualPath;
                $sumPath = response.data.numerology.sumPath;
                $sumPathInterpretation = response.data.numerology.interpretationSumPath;

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

                $containerLifePath.innerText = $lifePathInterpretation;
                $containerAnnualPath.innerText = $annualPathInterpretation;
                $containerSumPath.innerText = $sumPathInterpretation;

                $arcaneLifePath = response.data.tarology.arcaneLifePath;
                $interpretationArcaneLifePath = response.data.tarology.interpretationArcaneLifePath;
                $imgArcaneLifePath = response.data.tarology.imgArcaneLifePath;
                $nameArcaneLifePath = response.data.tarology.nameArcaneLifePath;
                $arcaneAnnualPath = response.data.tarology.arcaneAnnualPath;
                $interpretationArcaneAnnualPath = response.data.tarology.interpretationArcaneAnnualPath;
                $imgArcaneAnnualPath = response.data.tarology.imgArcaneAnnualPath;
                $nameArcaneAnnualPath = response.data.tarology.nameArcaneAnnualPath;

                $arcaneSumPath = response.data.tarology.arcaneSumPath;
                $interpretationArcaneSumPath = response.data.tarology.interpretationArcaneSumPath;
                $imgArcaneSumPath = response.data.tarology.imgArcaneSumPath;
                $nameArcaneSumPath = response.data.tarology.nameArcaneSumPath;

                $arcaneLifePathDescEl.innerText = $interpretationArcaneLifePath;
                $arcaneLifePathDescEl.classList = 'text-sm text-center';
                $arcaneLifePathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneLifePathImgEl.setAttribute('src', $imgArcaneLifePath);
                $arcaneLifePathImgEl.setAttribute('alt', $nameArcaneLifePath);
                $arcaneLifePathImgEl.setAttribute('title', $nameArcaneLifePath);
                $arcaneLifePathNumberEl.innerText = convertNumberArcaneToRomanFormat($arcaneLifePath) + ' - ';
                $arcaneLifePathNameEl.innerText = $nameArcaneLifePath;
                $arcaneLifePathNameEl.classList = 'text-sm my-3 text-center';

                $arcaneLifePathNameEl.prepend($arcaneLifePathNumberEl);

                $containerArcaneLifePathEls.forEach(function($containerArcaneLifePathEl){
                    $containerArcaneLifePathEl.appendChild($arcaneLifePathImgEl)
                    $containerArcaneLifePathEl.appendChild($arcaneLifePathNameEl)
                    $containerArcaneLifePathEl.appendChild($arcaneLifePathDescEl)
                });
                
                $arcaneAnnualPathDescEl.innerText = $interpretationArcaneAnnualPath;
                $arcaneAnnualPathDescEl.classList = 'text-sm text-center';
                $arcaneAnnualPathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneAnnualPathImgEl.setAttribute('src', $imgArcaneAnnualPath);
                $arcaneAnnualPathImgEl.setAttribute('alt', $nameArcaneAnnualPath);
                $arcaneAnnualPathImgEl.setAttribute('title', $nameArcaneAnnualPath);
                $arcaneAnnualPathNumberEl.innerText = convertNumberArcaneToRomanFormat($arcaneAnnualPath) + ' - ';
                $arcaneAnnualPathNameEl.innerText = $nameArcaneAnnualPath;
                $arcaneAnnualPathNameEl.classList = 'text-sm my-3 text-center';

                $arcaneAnnualPathNameEl.prepend($arcaneAnnualPathNumberEl);

                $containerArcaneAnnualPathEls.forEach(function($containerArcaneAnnualPathEl){
                    $containerArcaneAnnualPathEl.appendChild($arcaneAnnualPathImgEl)
                    $containerArcaneAnnualPathEl.appendChild($arcaneAnnualPathNameEl)
                    $containerArcaneAnnualPathEl.appendChild($arcaneAnnualPathDescEl)
                });

                $arcaneSumPathDescEl.innerText = $interpretationArcaneSumPath;
                $arcaneSumPathDescEl.classList = 'text-sm text-center';
                $arcaneSumPathImgEl.classList = 'max-w-[110px] m-auto';
                $arcaneSumPathImgEl.setAttribute('src', $imgArcaneSumPath);
                $arcaneSumPathImgEl.setAttribute('alt', $nameArcaneSumPath);
                $arcaneSumPathImgEl.setAttribute('title', $nameArcaneSumPath);
                $arcaneSumPathNumberEl.innerText = convertNumberArcaneToRomanFormat($arcaneSumPath) + ' - ';
                $arcaneSumPathNameEl.innerText = $nameArcaneSumPath;
                $arcaneSumPathNameEl.classList = 'text-sm my-3 text-center';

                $arcaneSumPathNameEl.prepend($arcaneSumPathNumberEl);

                $containerArcaneSumPathEls.forEach(function($containerArcaneSumPathEl){
                    $containerArcaneSumPathEl.appendChild($arcaneSumPathImgEl)
                    $containerArcaneSumPathEl.appendChild($arcaneSumPathNameEl)
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

    function convertNumberArcaneToRomanFormat($number) {
        $number = parseInt($number);
        
        switch($number) {
            case 1:
                return $number = 'I';
            case 2:
                return $number = 'II';
            case 3:
                return $number = 'III';
            case 4:
                return $number = 'VI';
            case 5:
                return $number = 'V';
            case 6:
                return $number = 'VI';
            case 7:
                return $number = 'VII';
            case 8:
                return $number = 'VIII';
            case 9:
                return $number = 'IX';
            case 10:
                return $number = 'X';
            case 11:
                return $number = 'XI';
            case 12:
                return $number = 'XII';
            case 13:
                return $number = 'XIII';
            case 14:
                return $number = 'XIV';
            case 15:
                return $number = 'XV';
            case 16:
                return $number = 'XVI';
            case 17:
                return $number = 'XVII';
            case 18:
                return $number = 'XVIII';
            case 19:
                return $number = 'XIX';
            case 20:
                return $number = 'XX';
            case 21:
                return $number = 'XXI';
            case 22:
                return $number = '0';
            default:
                return $number;
        }
    }

    function createFormBirthDate($submitFn, $DateValue, $defaultDate) {
        const $formContainer = document.createElement("form");
        const $inputContainer = document.createElement("div");
        const $input = document.createElement("input");
        const $btn = document.createElement("button");
        const $cancelBtn = document.createElement("button");
        const $icon = document.createElement("div");

        $formContainer.classList = "max-w-xs flex flex-row gap-2 items-center";
        $formContainer.setAttribute('data', 'FormBirthdate');
        createFormBirthdateIsOpen = true;
        
        $input.classList =
            "input input-primary pl-12 w-full peer focus:border-none focus:ring-primary-focus";
        $input.setAttribute('type', 'text');
        $input.setAttribute('value', $defaultDate ? $defaultDate : "");
        $input.setAttribute('id', 'input-date');
        $input.setAttribute('placeholder', '31/12/1985');
        $input.addEventListener('input', formatDateString);

        if($DateValue) { $input.value = $DateValue; }

        $btn.innerText = "OK";
        $btn.classList = "btn btn-sm btn-circle btn-primary";

        $cancelBtn.innerText = "X";
        $cancelBtn.classList = "btn btn-sm btn-circle";

        $inputContainer.classList = "relative";

        $icon.style.position = "absolute";
        $icon.style.top = "0";
        $icon.style.left = "10px";
        $icon.style.lineHeight = "2.8rem";
        $icon.style.height = "2rem";
        $icon.style.width = "2rem";

        $icon.innerHTML = `<svg class="inline w-7 h-7 stroke-slate-400/60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"></path>
      </svg>`;

        $inputContainer.appendChild($input);
        $inputContainer.appendChild($icon);
        $formContainer.appendChild($inputContainer);
        $formContainer.appendChild($btn);
        $formContainer.appendChild($cancelBtn);

        console.log($childrens)
        if ($childrens.length >= 2) {
            $numerologyDetailsHeaderEl.insertBefore($formContainer, $childrens[2]);
        } else {
            $numerologyDetailsHeaderContainerFormEl.prepend($formContainer);
        }

        $btn.addEventListener("click", (e) => {
            e.preventDefault();
            if($DateValue && $input.value == $DateValue) {
                $createFormBirthdateBtnEl.style.display = "block";
                createFormBirthdateIsOpen = false;
                $formContainer.remove();
                return;
            }
            $submitFn($input.value);
        });

        $cancelBtn.addEventListener("click", (e) => {
            e.preventDefault();
            $createFormBirthdateBtnEl.style.display = "block";
            createFormBirthdateIsOpen = false;
            $formContainer.remove();
            return;
        });

    }

    function submitForm(birthdate) {

        loader.show('numerology_details_content_header');

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
                loader.hide();
                console.log(error);
            });
    }

});
