<div>

    <div class="fixed bottom-2 right-2">
        <label for="drawer-admin" class="btn btn-warning capitalize">Universe</label>
    </div>

    <x-ui.drawer id="drawer-admin"
        class="p-4 w-full absolute top-0 bottom-[-110px] md:relative md:top-auto md:bottom-auto md:w-2/3 z-50" right>
        <div class="fixed top-2 right-2">
            <label for="drawer-admin" class="btn btn-ghost btn-circle capitalize">
                <i class="fa-thin fa-times fa-xl"></i>
            </label>
        </div>

        <div class="flex flex-col h-screen max-h-full">
            <div class="m-auto">
                <section>
                    <header class="p-4">
                        <h5 class="text-xl">Menu administrateur</h5>
                        <p class="text-sm text-gray-500">Naviguez partout sur votre espace d'administration via ce menu
                            de navigation !</p>
                    </header>

                    <ul
                        class="grid grid-flow-row grid-cols-3 items-center content-center justify-items-center justify-center gap-4">

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('admin.index')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('admin.index')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-thin fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('admin.index'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('admin.index')
                                ])
                                :href="route('admin.index')" label="Administration" :active="request()->routeIs('admin.index')" />
                        </li>

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('admin.messaging')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('admin.messaging')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-thin fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('admin.messaging'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('admin.messaging')
                                ])
                                :href="route('admin.messaging')" label="Messagerie" :active="request()->routeIs('admin.messaging')" />
                        </li>

                        <li
                            class="relative overflow-hidden  group border border-error/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-error/50">
                            <div class="mb-2 group-hover:opacity-0">
                                <i class="fa-thin fa-broom-ball text-3xl"></i>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="group m-auto group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110 transition-all duration-150 ease-in-out">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    class="px-1 pt-1 text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out
                                    group-hover:py-[50px]"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    Se déconnecter
                                </a>
                            </form>
                        </li>
                    </ul>
                </section>
                <section>
                    <header class="p-4">
                        <h5 class="text-xl">Thème du site</h5>
                    </header>
                    <select data-choose-theme>
                        <option value="">Default</option>
                        <option value="dark">Dark</option>
                    </select>
                </section>

            </div>
        </div>



    </x-ui.drawer>
</div>
