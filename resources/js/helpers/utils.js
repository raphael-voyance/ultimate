const wrapElements = (elems, wrapType, wrapClass) => {
    elems.forEach(word => {
        const wrapEl = document.createElement(wrapType);
        wrapEl.classList = wrapClass;

        // Get a reference to the parent
        const parent = word.parentNode;

        // Insert the wrapper before the word in the DOM tree
        parent.insertBefore(wrapEl, word);

        // Move the word inside the wrapper
        wrapEl.appendChild(word);
    });
};

const loader = {
    show: ($appendToId = null, callback = null, addClass = []) => {
        // Créer un élément de chargement
        const $loaderContainer = document.createElement('div');
        $loaderContainer.classList.add('loader_container', 'absolute', 'top-1/2', 'left-1/2', '-translate-x-1/2');
        const $loader = document.createElement('span');
        $loader.classList.add('loader');
        $loaderContainer.classList.add('text-center')
        $loaderContainer.appendChild($loader);

        if(addClass.length >= 1) {
            addClass.forEach(cl => {
                $loader.classList.add(cl);
            })
        }
        
        // Ajouter l'élément de chargement au document
        if($appendToId != null) {
            let $appendToEl = document.getElementById($appendToId);
            $appendToEl.appendChild($loaderContainer);
        }else {
            document.body.appendChild($loaderContainer);
        }

        if (callback && typeof callback === 'function') {
            callback();
        }
    },

    hide: (callback = null) => {
        // Créer un élément de chargement
        const $loaderContainers = document.getElementsByClassName('loader_container');

        if($loaderContainers.length >= 1) {
            for(let i = 0; i < $loaderContainers.length; i++) {
                const $loaderContainer = $loaderContainers[i];
                $loaderContainer.remove()
            }
        }
        

        if (callback && typeof callback === 'function') {
            callback();
        }
    }
}

function formatDateString(event) {
    const input = event.target;
    const value = input.value.replace(/\D/g, ''); // Remove non-digit characters
    const day = value.slice(0, 2);
    const month = value.slice(2, 4);
    const year = value.slice(4, 8);
    let formattedValue = '';
    
    if (day) {
        formattedValue += day;
        if (day.length === 2 && value.length > 1) {
            formattedValue += '/';
        }
    }
    
    if (month) {
        formattedValue += month;
        if (month.length === 2 && value.length > 3) {
            formattedValue += '/';
        }
    }
    
    if (year) {
        formattedValue += year;
    }
    
    input.value = formattedValue;
}





export {
    wrapElements, loader, formatDateString
};
