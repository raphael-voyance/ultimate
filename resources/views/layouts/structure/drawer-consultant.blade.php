<div>
    <div class="fixed bottom-2 left-2">
        <label for="drawer-consultant" class="btn btn-primary capitalize">Menu Consultant</label>
    </div>


    <x-ui.drawer id="drawer-consultant"
        class="p-4 w-full absolute top-0 bottom-[-110px] md:relative md:top-auto md:bottom-auto md:w-2/3 z-50" left>

        <div class="fixed top-2 right-2">
            <label for="drawer-consultant" class="btn btn-ghost capitalize rounded-full">
                <i class="fa-thin fa-times fa-xl"></i>
            </label>
        </div>

        <div class="flex flex-col h-screen max-h-full">
            <div class="m-auto">
                <section>
                    <header class="p-4">
                        <h5 class="text-xl">Menu consultant</h5>
                        <p class="text-sm text-gray-500">Naviguez partout sur votre espace via ce menu de navigation !
                        </p>
                    </header>

                    <ul
                        class="grid grid-flow-row grid-cols-3 items-center content-center justify-items-center justify-center gap-4">

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('my_space.index')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('my_space.index')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-solid fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('my_space.index'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('my_space.index')
                                ])
                                :href="route('my_space.index')" label="Tableau de bord" :active="request()->routeIs('my_space.index')" />
                        </li>

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('my_space.previsions')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('my_space.previsions')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-solid fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('my_space.previsions'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('my_space.previsions')
                                ])
                                :href="route('my_space.previsions')" label="Prévisions" :active="request()->routeIs('my_space.previsions')" />
                        </li>

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('my_space.appointments.index')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('my_space.appointments.index')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-solid fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('my_space.appointments.index'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('my_space.appointments.index')
                                ])
                                :href="route('my_space.appointments.index')" label="Mes rendez-vous" :active="request()->routeIs('my_space.appointments.index')" />
                        </li>

                        <li
                            class="overflow-hidden group border border-secondary/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-secondary/50 @if(request()->routeIs('my_space.profile.edit')) border-primary/40 shadow-primary/50 @endif">
                            <div class="mb-2 @if(request()->routeIs('my_space.profile.edit')) opacity-0 @endif group-hover:opacity-0">
                                <i class="fa-solid fa-broom-ball text-3xl"></i>
                            </div>
                            <x-ui.link
                                @class([
                                    'm-auto text-xs',
                                    'group-hover:py-[50px] group-hover:-translate-y-4 group-hover:text-gray-200 group-hover:scale-110' => !request()->routeIs('my_space.profile.edit'),
                                    'py-1 -translate-y-4 scale-110' => request()->routeIs('my_space.profile.edit')
                                ])
                                :href="route('my_space.profile.edit')" label="Mon profil" :active="request()->routeIs('my_space.profile.edit')" />
                        </li>

                        <li
                            class="overflow-hidden relative group border border-error/40 rounded-md w-28 text-center px-2 py-6 h-32 flex flex-col justify-center shadow-md shadow-error/50">
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

            </div>
        </div>
    </x-ui.drawer>

</div>



</div>
