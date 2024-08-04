import { createAlert } from "../../../Alert/alert.js";
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Quote from '@editorjs/quote';
import Warning from '@editorjs/warning';
import Marker from '@editorjs/marker';
import Delimiter from '@editorjs/delimiter';
import Embed from '@editorjs/embed';
import Table from '@editorjs/table';
import CheckList from '@editorjs/checklist';
import LinkTool from '@editorjs/link';

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
        
        const editor = new EditorJS({

            tools: {
                header: Header,
                list: List,
                checklist: CheckList,
                quote: Quote,
                warning: Warning,
                marker: Marker,
                delimiter: Delimiter,
                linkTool: LinkTool,
                embed: Embed,
                table: Table
              },

              data: {},

              /**
             * Internationalzation config
             */
            i18n: {
                /**
                 * @type {I18nDictionary}
                 */
                messages: {
                /**
                 * Other below: translation of different UI components of the editor.js core
                 */
                ui: {
                    "blockTunes": {
                    "toggler": {
                        "Click to tune": "Cliquer pour valider",
                        "or drag to move": "ou le faire glisser pour le déplacer"
                    },
                    },
                    "inlineToolbar": {
                    "converter": {
                        "Convert to": "Convertir en"
                    }
                    },
                    "toolbar": {
                    "toolbox": {
                        "Add": "Ajouter"
                    }
                    }
                },
            
                /**
                 * Section for translation Tool Names: both block and inline tools
                 */
                toolNames: {
                    "Text": "Paragraphe",
                    "Heading": "Titre",
                    "List": "Liste",
                    "Warning": "Alerte",
                    "Checklist": "Checklist",
                    "Quote": "Citation",
                    "Delimiter": "Séparation",
                    "Table": "Tableau",
                    "Link": "Lien",
                    "Marker": "Marqueur",
                    "Bold": "Gras",
                    "Italic": "Italic",
                },
            
                /**
                 * Section for passing translations to the external tools classes
                 */
                tools: {
                    /**
                     * Each subsection is the i18n dictionary that will be passed to the corresponded plugin
                     * The name of a plugin should be equal the name you specify in the 'tool' section for that plugin
                     */
                    "warning": { // <-- 'Warning' tool will accept this dictionary section
                    "Title": "Titre",
                    "Message": "Message",
                    },
            
                    /**
                     * Link is the internal Inline Tool
                     */
                    "link": {
                    "Add a link": "Ajouter un lien"
                    },
                    /**
                     * The "stub" is an internal block tool, used to fit blocks that does not have the corresponded plugin
                     */
                    "stub": {
                    'The block can not be displayed correctly.': 'Le block ne peut pas s\'afficher correctement.'
                    }
                },
            
                /**
                 * Section allows to translate Block Tunes
                 */
                blockTunes: {
                    /**
                     * Each subsection is the i18n dictionary that will be passed to the corresponded Block Tune plugin
                     * The name of a plugin should be equal the name you specify in the 'tunes' section for that plugin
                     *
                     * Also, there are few internal block tunes: "delete", "moveUp" and "moveDown"
                     */
                    "delete": {
                    "Delete": "Supprimer"
                    },
                    "moveUp": {
                    "Move up": "Monter d'un cran"
                    },
                    "moveDown": {
                    "Move down": "Descendre d'un cran"
                    }
                },
                }
            },

        });
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