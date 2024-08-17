import axios from 'axios';
import { loader } from "../../helpers/utils.js";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const btnSaveBackup = document.getElementById('btn-save-backup');

    if(btnSaveBackup) {
        btnSaveBackup.addEventListener('click', function(e) {
            e.preventDefault();
    
            createAlert('Vous allez lancer le processus de sauvegarde du site, en êtes-vous sûr(e) ?', 'default', function(confirmation) {
                if(confirmation) {
                    loader.show('element-save-backup-container');
    
                    axios.post('/admin/run-backup')
                        .then(response => {
                            loader.hide();
                            if(response.data.success) {
                                console.log('Sauvegarde exécutée avec succés.');
                                Toast.success(response.data.message);
                                location.reload();
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
                }else {
                    console.log("Processus de sauvegarde annulée !");
                }
            });
        })
    }
    
});