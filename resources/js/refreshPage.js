document.addEventListener('livewire:init', () => {
    Livewire.on('refreshPage', () => {
        location.reload();
    });
})
