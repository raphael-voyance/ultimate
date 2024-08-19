import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const dataBtnDownloadFile = document.querySelectorAll('[data-btn-download-file]');
    const dataBtnRemoveFile = document.querySelectorAll('[data-btn-remove-file]');
    const uploaderImgElements = document.querySelectorAll('[data-uploader-img]');

    if(dataBtnDownloadFile.length >= 1) {
        dataBtnDownloadFile.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let url = this.getAttribute('data-btn-download-file');
                console.log(url)
                axios({
                    method: 'get',
                    url: url,
                    responseType: 'blob'
                  })
                  .then(function (response) {
                      // Créez un URL d'objet pour le Blob
                      const url = window.URL.createObjectURL(new Blob([response.data]));
                      // Créez un élément <a> temporaire pour le téléchargement
                      const link = document.createElement('a');
                      link.href = url;
                      // Définir le nom du fichier à télécharger
                      link.setAttribute('download', response.headers['content-disposition'] ? 
                                         response.headers['content-disposition'].split('filename=')[1] : 'file');
                      document.body.appendChild(link);
                      link.click();
                      // Nettoyez l'URL de l'objet
                      window.URL.revokeObjectURL(url);
                      document.body.removeChild(link);
                  })
                  .catch(function (error) {
                      console.error('Erreur lors du téléchargement:', error);
                  });          
            })
        });
    }

    if(dataBtnRemoveFile.length >= 1) {
        dataBtnRemoveFile.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let url = this.getAttribute('data-btn-remove-file');
                createAlert('Vous êtes sur le point de supprimer un fichier, êtes-vous sûr(e) ?', 'default', function(confirmation) {
                    if (confirmation) {
                    axios.get(url)
                    .then(function (response) {
                        location.reload();
                    })
                    .catch(function (error) {
                        Toast.error('Erreur lors de la suppression');
                        console.error('Erreur lors de la suppression:', error);
                    });
            
                    } else {
                        // Code à exécuter si l'utilisateur annule
                        console.log("Suppression annulée !");
                    }
                })
            })
        });
    }

    if(uploaderImgElements.length >= 1) {
        uploaderImgElements.forEach((uploader) => {
            const inputFileElement = uploader.querySelector('[data-input-file]');
            const imgsPreviewElement = uploader.querySelector('[data-img-preview]');
            const saveButtonElement = uploader.querySelector('[data-save-button]');
            const infoImgElement = uploader.querySelector('[data-info-img]');

            // Initialement masquer le bouton
            saveButtonElement.style.display = 'none';

            inputFileElement.addEventListener('change', function(event) {
                var file = event.target.files[0];
                if (file) {

                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imgsPreviewElement.src = e.target.result;
                    }
                    
                    reader.readAsDataURL(file);

                    // Afficher le bouton lorsqu'un fichier est sélectionné
                    saveButtonElement.style.display = 'block';
                    saveButtonElement.style.margin = 'auto';
                    saveButtonElement.style.marginTop = '15px';

                    infoImgElement.style.display = 'none';
                } else {
                    // Masquer le bouton si aucun fichier n'est sélectionné
                    saveButtonElement.style.display = 'none';
                    infoImgElement.style.display = 'block';
                }
            });
        });
    }
    
});