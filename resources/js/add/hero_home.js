//Imports
import "./hero_home_animation";

// La parge est chargée :
window.addEventListener('load', () => {
    //Elements
    const homeHeroElement = document.getElementById('home-hero');
    const subHeaderElement = document.getElementById('sub-header');
    const headerElement = document.getElementById('header');

    //States
    let subHeaderElementHeight = subHeaderElement.offsetHeight;
    let homeHeroElementHeight = homeHeroElement.offsetHeight;
    let headerElementHeight = headerElement.offsetHeight;
    let verticalScrollBreakPoint = homeHeroElementHeight - (subHeaderElementHeight);

    //Height of Hero Element = 100vh - (subHeaderElement.height)
    let resizingHomeHeroElement = () => {
        homeHeroElement.style.height = "calc(100vh - " + subHeaderElementHeight + "px)";
    }

    let updatePositionOfHeaderElement = () => {
        if(headerElement.classList.contains('isFixed')) {
            headerElement.style.bottom = "auto";
            headerElement.style.top = subHeaderElementHeight + "px";
        }else if(headerElement.classList.contains('isAbsolute')){
            headerElement.style.bottom = "0";
            headerElement.style.top = "auto";
        }
    }

    let initialisePositionForHeaderElement = () => {
        //console.log('Total HeroHeight : ' + verticalScrollBreakPoint)
        //console.log('Total HeroHeight - HeaderElement : ' + (verticalScrollBreakPoint - headerElementHeight))
        //console.log('Window ScrollY : ' + window.scrollY)
        updatePositionOfHeaderElement();
        if(window.scrollY >= (verticalScrollBreakPoint - headerElementHeight)) {
            headerElement.classList.add('isFixed')
            headerElement.style.bottom = "auto";
            headerElement.classList.remove('isAbsolute')
        }else {
            headerElement.classList.add('isAbsolute')
            headerElement.style.bottom = 0;
            headerElement.classList.remove('isFixed')
        }
    }

    //Update position of Header on scroll
    window.addEventListener('scroll', (e) => {
        initialisePositionForHeaderElement();
    })

    //Update Height of Hero Element on screen resizing
    window.addEventListener('resize', () => {
        resizingHomeHeroElement();
    })

    //Launch functions initialization
    resizingHomeHeroElement();
    initialisePositionForHeaderElement();
    updatePositionOfHeaderElement();

})
