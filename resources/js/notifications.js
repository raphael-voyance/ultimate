import axios from "axios";

document.addEventListener('alpine:init', () => {
    Alpine.data('notificationComponent', () => ({
        notifications: [],
        open: false,
        async init() {
            try {
                const response = await axios.get("/mon-espace/notifications");
                this.notifications = response.data || [];
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
    }))
})