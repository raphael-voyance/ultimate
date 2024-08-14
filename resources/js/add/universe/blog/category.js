import axios from "axios";
import { createAlert } from "../../../Alert/alert.js";

// import { createComponent } from "../../../Blogging/components.js";

// PAGES //

window.addEventListener('load', () => {
    const createCategoryPage = document.getElementById('create-category');

    const addCategorieSubmitBtn = document.getElementById('btn-submit-category');
    if(addCategorieSubmitBtn) {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        const descriptionInput = document.getElementById('description');
        // Soumettre le formulaire
        addCategorieSubmitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const url = addCategorieSubmitBtn.getAttribute('data-submit-url');
            const name = nameInput.value;
            const slug = slugInput.value;
            const description = descriptionInput.value;

                axios.post(url, {
                            name: name,
                            slug: slug,
                            description: description
                        })
                        .then(function (response) {
                            if(response.data.status == 'success') {
                                Toast.success(response.data.message);
                                if(createCategoryPage) {
                                    window.location = response.data.redirectRoute;
                                }
                            }
                        })
                        .catch(function (error) {
                            Toast.danger(error.response.data.message);
                        });
        })
    }

    
    const btnsCategoryDel = document.querySelectorAll('[data-btn-category-del]');
    if(btnsCategoryDel) {

        btnsCategoryDel.forEach((btn) => {

            btn.addEventListener('click', (e) => {
                const cancelRoute = btn.getAttribute('data-btn-category-del');

                e.preventDefault();
                createAlert('Vous êtes sur le point de supprimer une catégorie, êtes-vous sûr(e) ?', 'default', function(confirmation) {
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
                            Toast.danger('Il y a eu une erreur dans le processus de suppression de la catégorie, merci de réessayer après avoir rafraichi votre navigateur.');
                        });
            
                    } else {
                        // Code à exécuter si l'utilisateur annule
                        console.log("Suppression annulée !");
                    }
                });
            });
        });

    }
    

});