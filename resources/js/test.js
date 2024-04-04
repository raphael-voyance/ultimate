
document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            toggle() {
                this.open = ! this.open
            }
        }))
    })

    // HTML en lien
    // <div x-data="dropdown">
    //         <button @click="toggle">.ll..</button>

    //         <div x-show="open" x-cloack>..lkkùklmkmlkmlklklmk.</div>
    //     </div>

