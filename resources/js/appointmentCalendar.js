document.addEventListener('livewire:init', () => {

    // // Je pourrai certainement supprimer ce fichier qui ne me sert à rien, initialement créé pour gérer la modale de prise de RDV
    // // Listener
    // Livewire.on('change-state-appointment-modal', (props) => {
    //     localStorage.setItem("appointmentModal", props.appointmentModalIsVisible);
    //     console.log(localStorage.getItem("appointmentModal"));
    // });

    // // Local storage
    // let appointmentModal = JSON.parse(localStorage.getItem("appointmentModal"));
    // if(appointmentModal == true) {
    //     console.log('je suis chargé');

    //     let component = Livewire.all()
    //     console.log(component)
    // }
})
