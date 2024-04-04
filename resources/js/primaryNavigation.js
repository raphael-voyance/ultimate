// La parge est chargée :
window.addEventListener('load', () => {
    //Elements
    const navigationContainer = document.getElementById("container-main-navivation");
    const openMainNavivation = document.getElementById("open-main-navivation");
    const closeMainNavivation = document.getElementById("close-main-navivation");
    const stickyHeaderElement = document.getElementById("sticky-header");
    const subHeaderElement = document.getElementById('sub-header');
    const logoElement = document.getElementById('logo');

    //States
    let navigationIsOpen = false;
    let subHeaderElementHeight = subHeaderElement.offsetHeight;
    let openMainNavivationOffsetHeight = openMainNavivation.offsetHeight;
    let logoElementOffsetHeight = openMainNavivation.offsetHeight;

    if(stickyHeaderElement) {
        stickyHeaderElement.style.top = subHeaderElementHeight + "px";
    }

    //Get width for document.body
    let getwSize = () => {
        return document.body.offsetWidth;
    };

    //Hide Navigation container on devices <= 767px (mobiles) or show Navigation container on devices > 767px
    let updateVisibilityNavigationForDevicesSized = () => {
        if(getwSize() <= 767) {
            navigationContainer.classList.add('hidden')
            // console.log('Document Size is <= to 767 : ' + getwSize() + 'px');
        }
        else {
            if(navigationContainer.classList.contains('hidden')) {
                navigationContainer.classList.remove('hidden')
            }
            // console.log('Document Size is > to 767 : ' + getwSize() + 'px');
        }
    }

    let updateVisibilityNavigation = () => {
        navigationIsOpen = !navigationIsOpen

        console.log('Navigation is Open : ' + navigationIsOpen);

    };

    //Launch function for determining visibility of Navigation updateVisibilityNavigationForDevicesSized()
    updateVisibilityNavigationForDevicesSized();

    //Update the navigation visibility on screen resizing
    window.addEventListener('resize', () => {
        updateVisibilityNavigationForDevicesSized();
    })

    //Event for open and close navigation
    openMainNavivation.addEventListener('click', (e) => {
        e.preventDefault;
        updateVisibilityNavigation();
        navigationContainer.classList.toggle("hidden");
        closeMainNavivation.style.top = (openMainNavivationOffsetHeight  + 22) + 'px'
        logoElement.style.position = 'fixed';
        logoElement.style.top = (logoElementOffsetHeight + 8) + 'px';
    })
    closeMainNavivation.addEventListener('click', (e) => {
        e.preventDefault;
        updateVisibilityNavigation();
        navigationContainer.classList.toggle("hidden");
        logoElement.style.position = 'relative';
        logoElement.style.top = 'auto';
    })
})
