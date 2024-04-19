import "./alert.css";

const createAlert = (textContent, type = 'default', callback) => {
    let $container = document.createElement('div');
    let $elementClose = document.createElement('button');
    let $iconClose = document.createElement('i');
    let $contentElement = document.createElement('div');
    let $contentText = document.createElement('p');
    let $footerElement = document.createElement('div');
    let $btnClose = document.createElement('button');
    let $btnConfirm = document.createElement('button');

    $container.classList = 'alert-box-overflow flex';
    $contentElement.classList = 'alert-box-container border-2 bg-base-100';
    $contentText.classList = 'my-4';
    $elementClose.classList = 'alert-box-btn-close';
    $iconClose.classList = 'fal fa-times';
    $footerElement.classList = 'flex flex-row gap-2 justify-end';
    $btnClose.classList = 'btn btn-sm btn-warning';
    $btnConfirm.classList = 'btn btn-sm btn-error';

    if (type === 'success') {
        $container.classList.add('bg-green-500/20');
        $contentElement.classList.add('border-green-500/50');
    } else if (type === 'error') {
        $container.classList.add('bg-red-500/20');
        $contentElement.classList.add('border-red-500/50');
    } else if (type === 'warning') {
        $container.classList.add('bg-yellow-500/20');
        $contentElement.classList.add('border-yellow-500/50');
    } else {
        $container.classList.add('bg-base-300/60');
        $contentElement.classList.add('border-base-300/50');
    }

    $contentText.innerText = textContent;
    $btnClose.innerText = 'Annuler';
    $btnConfirm.innerText = 'Confirmer';

    $elementClose.append($iconClose);
    $footerElement.append($btnClose);
    $footerElement.append($btnConfirm);
    $contentElement.append($elementClose);
    $contentElement.append($contentText);
    $contentElement.append($footerElement);
    $container.append($contentElement);
    document.body.append($container);

    $elementClose.addEventListener('click', function() {
        $container.remove();
        if (callback) callback(false);
    });

    $btnConfirm.addEventListener('click', function() {
        $container.remove();
        if (callback) callback(true);
    });

    $btnClose.addEventListener('click', function() {
        $container.remove();
        if (callback) callback(false);
    });
};

export {
    createAlert
};
