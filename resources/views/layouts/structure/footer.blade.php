@props(['fullWidth' => false])

<footer id="footer"
    {{
        $attributes->class([
            "mx-auto w-full",
            "max-w-screen-2xl" => !$fullWidth
        ])
    }}
>
<div class="p-6">
    Footer Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus eos dolorum nemo minus minima adipisci reprehenderit labore quam voluptatum in ratione perspiciatis ipsa accusantium blanditiis dolore, necessitatibus quia aliquam praesentium!
</div>

@if(auth()->check())
    <div x-data="notificationComponent" class="fixed right-4 bottom-4 z-10">
        <div x-on:click="toggle" class="relative bg-primary w-12 h-12 flex justify-center items-center text-white rounded-full transition-all opacity-0 cursor-pointer hover:ring-2 hover:ring-offset-base-100 hover:ring-white hover:ring-offset-4" x-ref="count">
            <i class="fa-light fa-xl" :class="open ? 'fa-times' : 'fa-bell-ring'"></i>
            <div class="absolute -top-1 -right-1 badge badge-accent badge-md text-xs" x-text="notifications.length"></div>
        </div>
        <div x-ref="notificationsBlock" class="absolute min-w-[100vw] md:min-w-[550px] translate-x-full invisible opacity-0 transition-all bottom-14 -right-4 bg-primary rounded-md">
            <template x-for="notification in notifications" :key="notification.id">
                <div class="border-b-2 border-white text-white last-of-type:border-b-0 py-1 px-2 flex flex-nowrap flex-row gap-2 justify-evenly items-center">
                    <span class="p-2" x-text="notification.data.message"></span>
                    <div class="flex flex-nowrap flex-row gap-2 justify-evenly items-center">
                        <button x-on:click="markAsRead(notification)" class="btn btn-xs text-white btn-accent">D'accord</button>
                    </div>
                </div>
            </template>
            <a href="{{ route('my_space.notifications.index') }}" class="border-white text-white active:text-white focus:text-white hover:text-white border-b-0 border-t-2 rounded-t-none mt-2 active:focus:scale-100 flex flex-nowrap flex-row gap-2 justify-evenly items-center btn btn-accent">
                Voir toutes les notifications
            </a>
        </div>
    </div>
@endif

</footer>
