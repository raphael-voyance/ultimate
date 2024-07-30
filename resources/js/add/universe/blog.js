window.addEventListener('load', () => {
    const blogIndex = document.getElementById('blog-index');
    const blogCreate = document.getElementById('blog-create');

    if (blogIndex) {
        let copyButtons = document.querySelectorAll('[data-copy-link]');
        
        if (copyButtons.length > 0) {
            copyButtons.forEach((el) => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    copyBtn(el);
                });
            });
        }
    }

    if (blogCreate) {
        // Votre code pour blogCreate
    }

    function copyBtn(copyBtn) {
        const copyText = copyBtn.getAttribute('data-copy-link');

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(copyText)
                .then(() => {
                    alert('Le texte a bien été copié dans le presse-papiers : ' + copyText);
                })
                .catch(err => {
                    console.error('Erreur lors de la copie du texte : ', err);
                });
        } else {
            console.error('L\'API Clipboard n\'est pas supportée par ce navigateur.');
            alert('Votre navigateur ne supporte pas l\'API Clipboard.');
        }
    }
});