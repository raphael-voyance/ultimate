<div id="sub-header" class="flex flex-row items-center justify-between sm:justify-end text-white z-20 sticky top-0 bg-secondary">
    <div>
        @livewire('appointment-modal')
    </div>

    <div>
        <a class="outline-none block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white hover:opacity-75 active:opacity-75 focus:opacity-75 transition-all" href="{{ route('contact') }}"><i class="fa-thin fa-circle-nodes"></i> Me contacter</a>
    </div>
    @guest
    <div>
        <x-ui.dropdown :inlineDropdown="true" toggle-text="Se connecter" mobile-icon="fa-thin fa-user" class="min-w-[67px] sm:w-[138px]">
                <a href="{{ route('login') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    {{ __('Register') }}
                </a>
        </x-ui.dropdown>
    </div>
    @endguest
    @auth
    <!-- Settings Dropdown -->
    <div>
        <x-ui.dropdown class="text-white" :inlineDropdown="true" toggle-text="{{ Auth::user()->fullName() }}" mobile-icon="fa-thin fa-user" class="min-w-[67px] sm:min-w-[201px]">

                @can('admin')
                <a href="{{ route('admin.index') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Administration
                </a>
                <a href="{{ route('admin.messaging') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Messagerie
                </a>
                @endcan
                @can('consultant')
                <a href="{{ route('my_space.index') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Mon espace personnel
                </a>
                <a href="{{ route('my_space.appointments.index') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Mes rendez-vous
                </a>
                <a href="{{ route('my_space.predictions') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Prédictions
                </a>
                <a href="{{ route('my_space.profile.edit') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md">
                    <i class="fa-thin fa-broom-ball"></i> Mon profil
                </a>
                @endcan
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-white hover:text-white active:text-white focus:text-white bg-secondary hover:bg-[#3b76a0] active:bg-[#3b76a0] focus:bg-[#3b76a0] last:rounded-bl-md"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fa-thin fa-broom-ball"></i>  {{ __('Logout') }}
                    </a>
                </form>

        </x-ui.dropdown>
    </div>
    @endauth

</div>
