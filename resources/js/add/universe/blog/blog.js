import { createAlert } from "../../../Alert/alert.js";
import EditorJS from '@editorjs/editorjs';

import { createComponent } from "../../../Blogging/components.js";

// PAGES //

window.addEventListener('load', () => {
    const blogIndex = document.getElementById('blog-index');
    const blogCreate = document.getElementById('blog-create');
    const blogEdit = document.getElementById('blog-edit');
    
    if (blogIndex) {
        let copyButtons = document.querySelectorAll('[data-copy-link]');
        let btnsPostDel = document.querySelectorAll('[data-btn-post-del]');
        
        if (copyButtons.length > 0) {
            copyButtons.forEach((el) => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    copyBtn(el);
                });
            });
        }

        

        if(btnsPostDel) {
            //console.log(btnsDrawDel)

            btnsPostDel.forEach((btn) => {

                btn.addEventListener('click', (e) => {
                    const cancelRoute = btn.getAttribute('data-btn-post-del');

                    //console.log(cancelRoute)

                    e.preventDefault();
                    createAlert('Vous êtes sur le point de supprimer un article, êtes-vous sûr(e) ?', 'default', function(confirmation) {
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
                                Toast.danger('Il y a eu une erreur dans le processus de suppression de l\'article, merci de réessayer après avoir rafraichi votre navigateur.');
                            });
                
                        } else {
                            // Code à exécuter si l'utilisateur annule
                            console.log("Suppression annulée !");
                        }
                    });
                });
            });

        }
    }

    if (blogCreate || blogEdit) {
        const editor = new EditorJS('post-editor');
    }

    function copyBtn(copyBtn) {
        const copyText = copyBtn.getAttribute('data-copy-link');

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(copyText)
                .then(() => {
                    alert('Le texte a bien été copié dans le presse-papiers : ' + copyText);
                })
                .catch(err => {
                    console.error('Erreur lors de la copie du texte : ', err);
                });
        } else {
            console.error('L\'API Clipboard n\'est pas supportée par ce navigateur.');
            alert('Votre navigateur ne supporte pas l\'API Clipboard.');
        }
    }
});