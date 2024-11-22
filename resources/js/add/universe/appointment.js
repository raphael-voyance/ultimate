import axios from "axios";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const cancelBtn = document.getElementById("cancel_request");

    const confirmRequestBtn = document.getElementById("confirm_request");

    if(cancelBtn) {
        const cancelRoute = document.getElementById("appointment_delete_route").value;
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            createAlert('Vous êtes sur le point d\'annuler la demande, êtes-vous sûr ?', 'default', function(confirmation) {
                if (confirmation) {
                    axios.delete(cancelRoute)
                      .then(function (response) {
                        if(response.data.status == 'success') {
                            window.location = response.data.redirectRoute;
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                        Toast.danger('Il y a eu une erreur dans le processus de suppression de votre demande, merci de réessayer après avoir rafraichi votre navigateur.');
                      });
        
                } else {
                    // Code à exécuter si l'utilisateur annule
                    console.log("Annulation annulée !");
                }
            });
            
            
        });
    }
    
    if(confirmRequestBtn) {
        const approvedRoute = document.getElementById("approved_route").value;
        confirmRequestBtn.addEventListener('click', function(e) {
            e.preventDefault();
            createAlert('Vous êtes sur le point de confirmer le rendez-vous, êtes-vous sûr ?', 'default', function(confirmation) {
                if (confirmation) {
                    axios.get(approvedRoute)
                      .then(function (response) {
                        if(response.data.status == 'success') {
                            window.location = window.location.href;
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                        Toast.danger('Il y a eu une erreur dans le processus d\'approbation de la demande, merci de réessayer après avoir rafraichi votre navigateur.');
                      });
        
                } else {
                    // Code à exécuter si l'utilisateur annule
                    console.log("Approbation annulé !");
                }
            });
            
            
        });
    }
});