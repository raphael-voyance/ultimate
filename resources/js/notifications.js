import axios from "axios";
import { formatDateTime } from "./helpers/utils";

document.addEventListener('alpine:init', () => {
    Alpine.data('notificationComponent', () => ({
        notifications: [],
        open: false,
        count: 0,
        async init() {
            try {
                const response = await axios.get("/mon-espace/notifications/get");
                this.notifications = response.data || [];

                this.count = this.notifications.length;

                const countEl = this.$refs.count;
                if (this.count > 0) {
                    countEl.classList.remove('opacity-0');
                }else if(this.count < 1) {
                    countEl.remove();
                }
            } catch (error) {
                console.error("Erreur lors du chargement des notifications :", error);
            }
        },
        toggle() {
            this.open = !this.open;
            this.$refs.notificationsBlock.classList.toggle('translate-x-full');
            this.$refs.notificationsBlock.classList.toggle('invisible');
            this.$refs.notificationsBlock.classList.toggle('opacity-0');
        },
        markAsRead(notification) {
            const element = this.$el.parentElement.parentElement;
            axios.post(`/mon-espace/notification/mark-as-read`, {
                notificationId: notification.id
            })
                .then(() => {
                    element.classList.add('translate-x-full', 'transition-all', 'ease-in-out');
                    element.addEventListener('transitionend', () => {
                        this.notifications = this.notifications.filter(n => n.id !== notification.id);
                    });
                    Toast.success("Notification marquée comme lue !");
                    this.count--;
                    console.log(this.count);
                })
                .catch(error => {
                    console.error("Erreur lors de la mise à jour de la notification :", error);
                });
        },
        formatDateTime(dateTime) {
            return formatDateTime(dateTime);
        }
    }));
})