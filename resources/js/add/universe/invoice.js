import axios from "axios";
import { createAlert } from "../../Alert/alert.js";

window.addEventListener('load', () => {
    const cancelBtn = document.getElementById("cancel_request");

    const downloadBtn = document.getElementById("download_invoice");

    const refundRequestBtn = document.getElementById("refund_request");

    const passedInvoiceToFreeBtn = document.getElementById("passed_invoice_to_free");

    if(passedInvoiceToFreeBtn) {
        const freeRoute = document.getElementById("passed_invoice_to_free_route").value;
        passedInvoiceToFreeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            createAlert('Vous êtes sur le point de passer la facture à "Gratuite", êtes-vous sûr ?', 'default', function(confirmation) {
                if (confirmation) {
                    axios.get(freeRoute)
                      .then(function (response) {
                        if(response.data.status == 'success') {
                            window.location = window.location.href;
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                        Toast.danger('Il y a eu une erreur dans le processus de la demande, merci de réessayer après avoir rafraichi votre navigateur.');
                      });
        
                } else {
                    // Code à exécuter si l'utilisateur annule
                    console.log("Opération annulé !");
                }
            });
            
            
        });
    } 

    if(refundRequestBtn) {
        const refundRoute = document.getElementById("payment_refund_route").value;
        refundRequestBtn.addEventListener('click', function(e) {
            e.preventDefault();
            createAlert('Vous êtes sur le point de rembourser la facture, êtes-vous sûr ?', 'default', function(confirmation) {
                if (confirmation) {
                    axios.get(refundRoute)
                      .then(function (response) {
                        if(response.data.status == 'success') {
                            window.location = window.location.href;
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                        Toast.danger('Il y a eu une erreur dans le processus de remboursement de la demande, merci de réessayer après avoir rafraichi votre navigateur.');
                      });
        
                } else {
                    // Code à exécuter si l'utilisateur annule
                    console.log("Remboursement annulé !");
                }
            });
            
            
        });
    } 

    if(downloadBtn) {
        const invoiceRef = downloadBtn.getAttribute('data-invoice-ref');

        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/invoice/download/' + invoiceRef;
        });
    }

    if(cancelBtn) {
        const cancelRoute = document.getElementById("payment_delete_route").value;
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

});