import axios from "axios";
import { createAlert } from "../Alert/alert.js";

window.addEventListener('load', () => {
    const cancelBtn = document.getElementById("cancel_request");
    const cancelRoute = document.getElementById("payment_delete_route").value;

    const editBtn = document.getElementById("edit_request");

    cancelBtn.addEventListener('click', function(e) {
        e.preventDefault();
        createAlert('Vous êtes sur le point d\'annuler votre demande, êtes-vous sûr(e) ?', 'default', function(confirmation) {
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

});