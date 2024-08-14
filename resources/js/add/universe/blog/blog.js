import axios from "axios";
import { formatDateString } from "../../../helpers/utils.js";
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
        const addCategorieBtn = document.getElementById('add-categorie');
        const addCategorieInputContainer = document.getElementById('add-categorie-input-container');
        const addCategorieInput = document.getElementById('add-categorie-input');
        const addCategorieSubmitBtn = document.getElementById('add-categorie-submit-btn');
        const addCategorieCancelBtn = document.getElementById('add-categorie-cancel-btn');
        
        const publishedAtSelectDate = document.getElementById('published_at_select_date');
        const publishedAtInput = document.getElementById('published_at_input');
        const publishedAtInputContainer = document.getElementById('published_at_input_container');
        const publishedAtInputSubmitBtn = document.getElementById('published_at_input_submit_btn');
        const publishedAtInputCancelBtn = document.getElementById('published_at_input_cancel_btn');
        const publishedAtText = document.getElementById('published_at_text');
        const publishedAtElement = document.getElementById('published_at');

        // Ajout d'une catégorie
        // Afficher le formulaire
        addCategorieBtn.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('hidden');
            addCategorieInputContainer.classList.remove('hidden');
        })

        // Soumettre le formulaire
        addCategorieSubmitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const url = addCategorieSubmitBtn.getAttribute('data-submit-url');
            const name = addCategorieInput.value;

                axios.post(url, {
                            name: name
                        })
                        .then(function (response) {
                            if(response.data.status == 'success') {
                                addElementCategory(name, response.data.categoryId);
                                Toast.success(response.data.message);
                                addCategorieInput.value = '';
                            }
                        })
                        .catch(function (error) {
                            Toast.danger(error.response.data.message);
                        });
        })

        // Créer l'élément dans la liste des catégories
        function addElementCategory(category, id) {
            const categoriesList = document.getElementById('categories-list');
            const div = document.createElement('div');
            div.innerHTML = `<div class="form-control" x-show="true">
                        <label for="${category}" class="label cursor-pointer gap-2 justify-start">
                            <input type="checkbox" id="${category}" name="${category}" value="${id}" class="checkbox checkbox-primary checkbox-sm" checked="checked">
                            <span class="label-text">${category}</span>
                        </label>
                    </div>`;

            // Ajout du nouvel élément au début de la liste
            categoriesList.prepend(div.firstElementChild);
            addCategorieBtn.classList.remove('hidden');
            addCategorieInputContainer.classList.add('hidden');
        }
        
        // Cacher le formulaire
        addCategorieCancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            addCategorieBtn.classList.remove('hidden');
            addCategorieInputContainer.classList.add('hidden');
        })

        // Ajout d'une date de publication
        publishedAtInput.addEventListener('input', formatDateString);
        
        publishedAtSelectDate.addEventListener('click', function() {
            publishedAtInputContainer.classList.remove('hidden');
        })

        publishedAtInputSubmitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            publishedAtInputContainer.classList.add('hidden');
            publishedAtElement.value = publishedAtInput.value;
            publishedAtText.innerText = 'Publier le ' + publishedAtInput.value;
        })

        publishedAtInputCancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            publishedAtInputContainer.classList.add('hidden');
        })

    }

    if (blogEdit) {
        const postId = blogEdit.getAttribute('data-post-id');
        const btnPostDel = document.querySelector('[data-btn-post-del]');

        (async function(id) {
            try {
                let url = window.location.origin + '/admin/blog/post/get-data-editor/' + postId;
                const response = await axios.get(url, {
                    params: {
                        postId: postId
                    }
                });
                dataPostContent = response.data;
                initializeEditor(dataPostContent, postId);
            } catch (err) {
                console.error("Erreur lors de la requête au serveur :", err.message);
                throw err;
            }
        })(postId);
        
        btnPostDel.addEventListener('click', function(e) {
            e.preventDefault();
            const cancelRoute = this.getAttribute('data-btn-post-del');

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

        
    }

    if(blogCreate) {
        console.log('blogCreate')
        initializeEditor(dataPostContent);
    }

    function initializeEditor(data, id) {
        let contentData = data.length ? JSON.parse(data) : {};
        let titleElement = document.getElementById('title');
        let excerptElement = document.getElementById('excerpt');
        let slugElement = document.getElementById('slug');
        let content;
        let thumbnailElement = document.getElementById('thumbnail');
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
    
            data: contentData.length ? JSON.parse(contentData) : {},
    
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
                    const title = titleElement.value;
                    const excerpt = excerptElement.value;
                    const slug = slugElement.value;
                    content = outputData;

                    const thumbnail = thumbnailElement.files[0];

                    const selectedStatus = document.querySelector('input[name="status"]:checked').value;

                    const checkboxes = document.querySelectorAll('#categories-list input[type="checkbox"]:checked');

                    const selectedCategories = Array.from(checkboxes).map(checkbox => checkbox.value);

                    const publishedAt = document.querySelector('input[name="published_at"]:checked').value;

                    const formData = new FormData();
                    formData.append('title', title);
                    formData.append('excerpt', excerpt);
                    formData.append('slug', slug);
                    formData.append('content', JSON.stringify(content));
                    formData.append('thumbnail', thumbnail);
                    formData.append('status', selectedStatus);
                    formData.append('publishedAt', publishedAt);
                    
                    selectedCategories.forEach((category, index) => {
                        formData.append(`categories[]`, category);
                    });
    
                    if (blogCreate) {
                        let url = window.location.origin + '/admin/blog/post/store';
                        axios.post(url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
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
                        axios.post(url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
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