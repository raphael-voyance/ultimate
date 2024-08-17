import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const dataBtnDownloadFile = document.querySelectorAll('[data-btn-download-file]');
    const dataBtnRemoveFile = document.querySelectorAll('[data-btn-remove-file]');

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
                createAlert('Vous êtes sur le point de supprimer un tirage, êtes-vous sûr(e) ?', 'default', function(confirmation) {
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
    
});