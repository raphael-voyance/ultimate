window.addEventListener('load', () => {
    const notificationBtn = document.getElementById("notification_btn");
    const notificationsBlock = document.getElementById("notifications_block");

    if(notificationBtn == null || notificationsBlock == null) {
        return;
    }

    notificationBtn.addEventListener('click', function(e) {
        e.preventDefault();
        notificationsBlock.classList.toggle('translate-x-full');
        notificationsBlock.classList.toggle('invisible');
        notificationsBlock.classList.toggle('opacity-0');
    });
});