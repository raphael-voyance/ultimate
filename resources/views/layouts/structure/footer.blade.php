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
        <div x-on:click="toggle" class="relative bg-primary w-12 h-12 flex justify-center items-center text-white rounded-full cursor-pointer transition-all hover:ring-2 hover:ring-offset-base-100 hover:ring-white hover:ring-offset-4">
            <i class="fa-light fa-xl" :class="open ? 'fa-times' : 'fa-bell-ring'"></i>
            <div class="absolute -top-1 -right-1 badge badge-accent badge-md text-xs">1</div>
        </div>
        <div x-ref="notificationsBlock" class="absolute min-w-[100vw] md:min-w-[550px] translate-x-full invisible opacity-0 transition-all bottom-14 -right-4 bg-primary rounded-md">
            <template x-for="notification in notifications" :key="notification.id">
                <div class="border-b-2 border-white text-white last-of-type:border-b-0 py-1 px-2 flex flex-nowrap flex-row gap-2 justify-evenly items-center">
                    <span class="p-2" x-text="notification.data.message"></span>
                    <div class="flex flex-nowrap flex-row gap-2 justify-evenly items-center">
                        <button class="btn btn-xs text-white btn-accent">D'accord</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
@endif

</footer>
