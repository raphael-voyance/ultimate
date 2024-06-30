import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {


//Page index
let btnsDrawDel = document.querySelectorAll('[data-btn-draw-del]');

if(btnsDrawDel.length) {
    //console.log(btnsDrawDel)

    btnsDrawDel.forEach((btn) => {

        btn.addEventListener('click', (e) => {
            const cancelRoute = btn.getAttribute('data-btn-draw-del');

            //console.log(cancelRoute)

            e.preventDefault();
            createAlert('Vous êtes sur le point de supprimer un tirage, êtes-vous sûr(e) ?', 'default', function(confirmation) {
                if (confirmation) {
                    console.log(confirmation)
                    axios.delete(cancelRoute)
                    .then(function (response) {
                        if(response.data.status == 'success') {
                            window.location = response.data.redirectRoute;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        Toast.danger('Il y a eu une erreur dans le processus de suppression du tirage, merci de réessayer après avoir rafraichi votre navigateur.');
                    });
        
                } else {
                    // Code à exécuter si l'utilisateur annule
                    console.log("Suppression annulée !");
                }
            });
        });
    });

}

//Page edit & create
let btnsSubmitPositionKeyword = document.querySelectorAll('[data-submit-position]');
let keywordsContainer = document.getElementById('keywordsContainer');

// Function to add event listeners to submit buttons
function addSubmitButtonListeners() {
    btnsSubmitPositionKeyword.forEach((btn) => {
        const submitRoute = keywordsContainer.getAttribute('data-submit-save-position');
        const positionObj = JSON.parse(btn.getAttribute('data-submit-position'));

        btn.addEventListener('click', function() {
            let inputKeyword = document.getElementById('position-' + positionObj.position + '-keyword');
            let inputIcone = document.getElementById('position-' + positionObj.position + '-icone');

            console.log(inputKeyword, inputIcone)

            // <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus" 
                // type="text" 
                // name="position-1-icone" 
                // placeholder="fa-thin fa-dragon" 
                // id="position-1-icone" 
                // spellcheck="false" 
                // data-ms-editor="true">

            // <input class="input input-primary w-full peer focus:border-none focus:ring-primary-focus " 
                // id="position-1-icone" 
                // type="text" 
                // name="position-1-icone" 
            // value="fa-thin fa-sun" 
            // label="Icône" 
                // placeholder="fa-thin fa-dragon" 
                // spellcheck="false" 
                // data-ms-editor="true">


            positionObj.keywords = inputKeyword.value;
            positionObj.icone = inputIcone.value;

            console.log('drawId:', parseInt(positionObj.drawId),
                'icone:', positionObj.icone,
                'keywords:', positionObj.keywords,
                'position:', parseInt(positionObj.position))

            axios.post(submitRoute, {
                drawId: parseInt(positionObj.drawId),
                icone: positionObj.icone,
                keywords: positionObj.keywords,
                position: parseInt(positionObj.position)
              })
                .then(function (response) {
                    if (response.data.success) {
                        console.log(response)
                        //window.location = response.data.redirectRoute;
                        Toast.success(response.data.success);
                    }
                })
                .catch(function (error) {
                    Toast.danger(error.response.data.message);
                });
        });
    });
}

// Initial call to add event listeners to submit buttons
if (btnsSubmitPositionKeyword.length) {
    addSubmitButtonListeners();
}

if (keywordsContainer) {
    let numberOfFieldsInput = document.getElementById('totalSelectedCards');
    let hasSumCardsCheckbox = document.getElementById('hasSumCards');
    let keywordTemplate = document.getElementById('keywordTemplate').content;

    function updateNumberOfFields() {
        let hasSumCards = hasSumCardsCheckbox.checked;
        return hasSumCards ? parseInt(numberOfFieldsInput.value) + 1 : parseInt(numberOfFieldsInput.value);
    }

    function getDrawIdFromUrl() {
        const url = window.location.href;
        const regex = /\/draw\/edit\/(\d+)/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    function createFields(numberOfFieldsInputToCreate) {
        for (let i = keywordsContainer.children.length; i < numberOfFieldsInputToCreate; i++) {
            // Clone the template
            const clone = document.importNode(keywordTemplate, true);

            // Update the index and position number
            const index = keywordsContainer.children.length + 1;
            clone.querySelectorAll('.position-number').forEach(span => {
                span.textContent = index;
            });
            clone.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace('__index__', index);

                input.setAttribute('id', input.name.replace('__index__', index));
            });
            clone.querySelectorAll('button').forEach(btn => {
                let drawId = getDrawIdFromUrl();
                let data = { 'position' : index, 'drawId': drawId };
                btn.setAttribute('data-submit-position', JSON.stringify(data));
            });

            // Append the clone to the container
            keywordsContainer.appendChild(clone);
        }
        // Update submit buttons list and add event listeners
        btnsSubmitPositionKeyword = document.querySelectorAll('[data-submit-position]');
        addSubmitButtonListeners();
    }

    function removeExcessFields(numberOfFieldsInputToCreate) {
        while (keywordsContainer.children.length > numberOfFieldsInputToCreate) {
            keywordsContainer.removeChild(keywordsContainer.lastElementChild);
        }
    }

    function updateFields() {
        let numberOfFieldsInputToCreate = updateNumberOfFields();
        let keywordsFields = document.querySelectorAll('.keyword-field');

        if (numberOfFieldsInputToCreate <= keywordsFields.length) {
            removeExcessFields(numberOfFieldsInputToCreate);
        } else {
            createFields(numberOfFieldsInputToCreate);
        }
    }

    numberOfFieldsInput.addEventListener('change', function() {
        updateFields();
    });

    hasSumCardsCheckbox.addEventListener('change', function() {
        updateFields();
    });

    // Initial call to determine the visibility of the button and set up fields
    updateFields();
}





    // const addFieldsButton = document.getElementById('addFieldsButton');
    // const numberOfFieldsInput = document.getElementById('numberOfFields');
    // const keywordsContainer = document.getElementById('keywordsContainer');
    // const keywordTemplate = document.getElementById('keywordTemplate').content;

    // addFieldsButton.addEventListener('click', function () {
    //     const numberOfFields = parseInt(numberOfFieldsInput.value);
        
    //     if (isNaN(numberOfFields) || numberOfFields <= 0) {
    //         alert('Veuillez entrer un nombre valide de champs.');
    //         return;
    //     }

    //     for (let i = 0; i < numberOfFields; i++) {
    //         // Clone the template
    //         const clone = document.importNode(keywordTemplate, true);
            
    //         // Update the index and position number
    //         const index = keywordsContainer.children.length + 1;
    //         clone.querySelectorAll('.position-number').forEach(span => {
    //             span.textContent = index;
    //         });
    //         clone.querySelectorAll('input').forEach(input => {
    //             input.name = input.name.replace('__index__', index);
    //         });

    //         // Append the clone to the container
    //         keywordsContainer.appendChild(clone);
    //     }
    // });




});