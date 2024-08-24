// import axios from "axios";
import { createAlert } from "../../Alert/alert.js";
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
import ToggleBlock from 'editorjs-toggle-block';

// PAGES //

window.addEventListener('load', () => {
    let dataPostContent = {};
    let bodyElement = document.getElementById('editor-view');
    
    if(bodyElement) {
        const postId = bodyElement.getAttribute('data-post-id');
        (async function(id) {
            try {
                let url = window.location.origin + '/mon-univers/get-data-editor/' + postId;
                const response = await axios.get(url, {
                    params: {
                        postId: postId
                    }
                });
                dataPostContent = response.data;
                initializeEditor(dataPostContent);
            } catch (err) {
                console.error("Erreur lors de la requête au serveur :", err.message);
                throw err;
            }
        })(postId);
    }
    


    window.addEventListener('scroll', function () {
        if (window.innerWidth >= 768) { // Vérifie si la largeur de la fenêtre est de 768px ou plus
            const parallaxEls = document.querySelectorAll('.parallax img');
            if(parallaxEls.length > 0) {
                let offset = window.scrollY;
                parallaxEls.forEach((el) => {
                    el.style.transform = 'translate(-50%, -50%) scale(1.5) translateY(' + offset * 0.5 + 'px)';
                });
            }
        }
    });

    function initializeEditor(data) {
        // console.log('initializeEditor(data)', data);
        let contentData = data.length ? JSON.parse(data) : {};

        const editor = new EditorJS({
            holder: 'editor-view',
            readOnly: true,
            placeholder: 'Tout est bon à dire du moment que c\'est fait avec le coeur',
            tools: {
                header: Header,
                list: List,
                checklist: CheckList,
                quote: Quote,
                warning: Warning,
                marker: Marker,
                delimiter: Delimiter,
                linkTool: {
                    class: LinkTool,
                    config: {
                      endpoint: '/mon-univers/fetchUrl', // Your backend endpoint for url data fetching,
                    }
                },
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
                toggle: {
                    class: ToggleBlock,
                    inlineToolbar: true,
                },
            },
    
            data: JSON.parse(contentData),

            onReady: () => {
                const quoteCaptionElements = document.querySelectorAll('.cdx-quote__caption');
                if (quoteCaptionElements.length > 0) {
                    // Masque l'auteur d'une citation si il n'est pas renseigné
                    quoteCaptionElements.forEach((el) => {
                        if(el.innerText == '') {
                            el.style.display = 'none'
                        }
                    })
                    
                }
            },
    
        });
    }
});