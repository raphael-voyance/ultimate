import axios from "axios";
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
import ImageTool from '@editorjs/image';

// import { createComponent } from "../../../Blogging/components.js";

// PAGES //

window.addEventListener('load', () => {
    const blogIndex = document.getElementById('blog-index');
    const blogCreate = document.getElementById('blog-create');
    const blogEdit = document.getElementById('blog-edit');
    let dataPostContent = {}; // Initialisation des données
    
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
        //console.log('blogCreate || blogEdit')
    }

    if (blogEdit) {
        const postId = blogEdit.getAttribute('data-post-id');

        (async function(id) {
            try {
                let url = window.location.origin + '/admin/blog/post/get-data-editor/' + postId;
                const response = await axios.get(url, {
                    params: {
                        postId: postId
                    }
                });
                dataPostContent = response.data; // Assignez les données récupérées à la variable data
                initializeEditor(dataPostContent, postId); // Initialisez l'éditeur avec les données récupérées
            } catch (err) {
                console.error("Erreur lors de la requête au serveur :", err.message);
                throw err;
            }
        })(postId);
    }

    if(blogCreate) {
        console.log('blogCreate')
        initializeEditor(dataPostContent);
    }

    function initializeEditor(data, id) {
        console.log('initializeEditor(data)', data);
        let contentData = data.length ? JSON.parse(data) : {};
    
        let titleElement = document.getElementById('title');
        let excerptElement = document.getElementById('excerpt');
        let slugElement = document.getElementById('slug');
        let content;
    
        const btnSubmitPost = document.getElementById('btn-submit-post');
        const editor = new EditorJS({
            holder: 'editor',
            readOnly: false,
            placeholder: 'Tout est bon à dire du moment que c\'est fait avec le coeur',
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
                table: Table,
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: 'http://localhost:8008/uploadFile', // Your backend file uploader endpoint
                            byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                        }
                    }
                },
            },
    
            data: contentData,
    
            i18n: {
                messages: {
                    ui: {
                        'Search': "Rechercher",
                        'popover': {
                            'Filter': 'Filtrer',
                            "Convert to": "Convertir en",
                        },
                        "blockTunes": {
                            "toggler": {
                                "Click to tune": "Cliquer pour valider",
                                "or drag to move": "ou le faire glisser pour le déplacer"
                            },
                        },
                        "inlineToolbar": {
                            "converter": {
                                "Convert to": "Convertir en",
                            }
                        },
                        "toolbar": {
                            "toolbox": {
                                "Add": "Ajouter"
                            }
                        }
                    },
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
                    tools: {
                        "warning": {
                            "Title": "Titre",
                            "Message": "Message",
                        },
                        "link": {
                            "Add a link": "Ajouter un lien"
                        },
                        "stub": {
                            'The block can not be displayed correctly.': 'Le block ne peut pas s\'afficher correctement.'
                        }
                    },
                    blockTunes: {
                        "delete": {
                            "Delete": "Supprimer",
                            "Click to delete": "Confirmer",
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
    
        if (btnSubmitPost) {
            btnSubmitPost.addEventListener('click', function(e) {
                e.preventDefault();
    
                editor.save().then((outputData) => {
                    let title = titleElement.value;
                    let excerpt = excerptElement.value;
                    let slug = slugElement.value;
                    content = outputData;
    
                    console.log(title, excerpt, slug, content);
    
                    if (blogCreate) {
                        let url = window.location.origin + '/admin/blog/post/store';
                        axios.post(url, {
                            content: content,
                            title: title,
                            excerpt: excerpt,
                            slug: slug
                        })
                        .then(function (response) {
                            if(response.data.status == 'success') {
                                window.location = response.data.redirectRoute;
                            }
                        })
                        .catch(function (error) {
                            Toast.danger(error.response.data.message);
                        });
                    }
                    if (blogEdit) {
                        let url = window.location.origin + '/admin/blog/post/update/' + id;
                        axios.post(url, {
                            content: outputData,
                            title: title,
                            excerpt: excerpt,
                            slug: slug
                        })
                        .then(function (response) {
                            if(response.data.status == 'success') {
                                window.location = response.data.redirectRoute;
                            }
                        })
                        .catch(function (error) {
                            Toast.danger(error.response.data.message);
                        });
                    }
                }).catch((error) => {
                    console.log('Saving failed: ', error);
                });
            });
        }
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