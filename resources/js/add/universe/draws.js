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

if(btnsSubmitPositionKeyword.length) {
    // console.log(btnsSubmitPositionKeyword)
    btnsSubmitPositionKeyword.forEach((btn) => {
        const submitRoute = btn.getAttribute('data-submit-save-position');
        const positionObj = JSON.parse(btn.getAttribute('data-submit-position'));
        console.log(positionObj)
        btn.addEventListener('click', function() {
            let inputKeyword = document.getElementById('position-'+ positionObj.position +'-keyword');
            let inputIcone = document.getElementById('position-'+ positionObj.position +'-icone');

            positionObj.keywords = inputKeyword.value;
            positionObj.icone = inputIcone.value;

            console.log(positionObj);
            axios.post(submitRoute, {
                drawId: positionObj.drawId,
                icone: positionObj.icone,
                keywords: positionObj.keywords,
                position: positionObj.position
              })
                .then(function (response) {
                    if(response.data.status == 'success') {
                        window.location = response.data.redirectRoute;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    Toast.danger('Il y a eu une erreur dans le processus de suppression de votre demande, merci de réessayer après avoir rafraichi votre navigateur.');
                });
            
        });
    })
}



let btnsCreatePositionKeywordFields = document.getElementById('btn_create_position_keyword_field');

if(btnsCreatePositionKeywordFields) {
    btnsCreatePositionKeywordFields.addEventListener('click', function() {
        const numberOfFieldsInput = document.getElementById('totalSelectedCards');
        const hasSumCardsCheckbox = document.getElementById('hasSumCards');

        const hasSumCards = hasSumCardsCheckbox.checked;
        const numberOfFieldsInputToCreate = hasSumCards ? parseInt(numberOfFieldsInput.value) +1 : parseInt(numberOfFieldsInput.value);

        const keywordsContainer = document.getElementById('keywordsContainer');
        const keywordTemplate = document.getElementById('keywordTemplate').content;

        //btnsCreatePositionKeywordFields.remove();

        for (let i = 0; i < numberOfFieldsInputToCreate; i++) {
            // Clone the template
            const clone = document.importNode(keywordTemplate, true);
            
            // Update the index and position number
            const index = keywordsContainer.children.length + 1;
            clone.querySelectorAll('.position-number').forEach(span => {
                span.textContent = index;
            });
            clone.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace('__index__', index);
            });

            // Append the clone to the container
            keywordsContainer.appendChild(clone);
        }


        
    });
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