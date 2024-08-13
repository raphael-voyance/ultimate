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

// PAGES //

window.addEventListener('load', () => {
    let dataPostContent = {};
    let bodyElement = document.getElementById('editor-view');
    const postId = bodyElement.getAttribute('data-post-id');
    
    (async function(id) {
        try {
            let url = window.location.origin + '/admin/blog/post/get-data-editor/' + postId;
            const response = await axios.get(url, {
                params: {
                    postId: postId
                }
            });
            // console.log('response.data : ', response.data)
            dataPostContent = response.data;
            initializeEditor(dataPostContent);
        } catch (err) {
            console.error("Erreur lors de la requête au serveur :", err.message);
            throw err;
        }
    })(postId);

    function initializeEditor(data) {
        console.log('initializeEditor(data)', data);
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
    
            data: JSON.parse(contentData),
    
        });
    }
});