window.addEventListener('load', () => {
    const nav = document.getElementById('messages_navigation'); // Sélectionne la navigation

    let minNavHeight = document.getElementById('contentMessagesComponent');
    let content = minNavHeight.innerText;

    if (nav !== null) { // Vérifie si nav n'est pas null
        nav.addEventListener('click', () => {
            //setTimeout(changeHeight,3000)
            //nav.style.backgroundColor = `red`;
        });
    }

    window.addEventListener('scroll', () => {
    const scrollY = (window.scrollY) + 30; // Obtient la position de défilement verticale

    // Définis la limite à partir de laquelle tu veux rendre la navigation "sticky"
    const threshold = nav.offsetTop; // ajuste cette valeur selon tes besoins

    // Vérifie si la position de défilement dépasse la limite
    if (scrollY > threshold) {
        // Applique un style pour rendre la navigation "sticky"
        nav.style.transform = `translateY(${scrollY - threshold}px)`;
    } else {
        // Réinitialise la position si elle est en dessous de la limite
        nav.style.transform = 'translateY(0)';
    }
    });
})


