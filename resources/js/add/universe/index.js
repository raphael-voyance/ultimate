import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const btnSaveBdd = document.getElementById('btn-save-bdd');

    btnSaveBdd.addEventListener('click', function(e) {
        e.preventDefault();

        createAlert('Vous allez lancer le processus de sauvegarde de la base de données, en êtes-vous sûr(e) ?', 'default', function(confirmation) {

            loader.show('card-save-bdd');

            axios.post('/admin/run-backup')
                .then(response => {
                    loader.hide();
                    if(response.data.success) {
                        console.log('Sauvegarde exécutée avec succés.');
                        Toast.success(response.data.message);
                    } else {
                        console.error('Backup failed', response.data.message);
                        Toast.danger(response.data.message);
                    }
                })
                .catch(error => {
                    loader.hide();
                    console.error('Error initiating backup', error);
                    Toast.danger('An error occurred while initiating the backup');
                });

        });
    })
});