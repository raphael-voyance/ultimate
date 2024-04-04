window.addEventListener('load', () => {
    const overlay_element = document.getElementById('overlay_loadingpage');

    if(overlay_element) {
        let myTimeout = setTimeout(removeOverlay, 100);

        function removeOverlay() {
            overlay_element.classList.add('opacity-0')
            overlay_element.classList.remove('opacity-100')
            setTimeout(function() {
                overlay_element.classList.add('hidden');
            }, 200);
        }
    }


})

window.addEventListener('DOMContentLoaded', () => {
    //console.log('En cours de chargement...')
})
