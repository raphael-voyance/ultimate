window.addEventListener('load', () => {
    const overlay_element = document.getElementById('overlay_loadingpage');

    if (overlay_element) {
        removeOverlay();
    }

    function removeOverlay() {
        overlay_element.classList.add('opacity-0');
        overlay_element.classList.remove('opacity-100');

        // Ajouter un événement de fin de transition au lieu d'utiliser un deuxième `setTimeout`
        overlay_element.addEventListener('transitionend', () => {
            overlay_element.classList.add('hidden');
        }, { once: true }); // `once: true` permet de retirer automatiquement l'événement après qu'il a été déclenché
    }
});