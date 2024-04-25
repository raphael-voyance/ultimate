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
    show: ($appendToId = null, callback = null) => {
        // Créer un élément de chargement
        const $loaderContainer = document.createElement('div');
        $loaderContainer.classList.add('loader_container');
        const $loader = document.createElement('span');
        $loader.classList.add('loader');
        $loaderContainer.appendChild($loader);
        
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





export {
    wrapElements, loader
};
