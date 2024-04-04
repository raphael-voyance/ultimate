{{-- Header --}}
<x-structure.header full-width sticky>

    <x-slot:brand>

        <!-- Logo -->
        <div class="shrink-0 flex items-center logo w-20 z-10" id="logo">
            <a href="{{ route('home') }}" class="fill-accent text-accent">
                <x-application-logo />
            </a>
        </div>
    </x-slot:brand>

    <!-- Navbar -->
    <x-slot:actions>
        <!-- Drawer toggle for "main-drawer" -->
        <button id="open-main-navivation" type="button" class="md:hidden btn btn-outline btn-primary btn-circle">
            <x-icon name="o-bars-3" class="cursor-pointer" />
        </button>
        <div id="container-main-navivation"
            class="
                fixed top-0 left-0 w-full h-full flex bg-primary
                md:relative  md:w-auto md:h-auto md:bg-transparent
            ">
            <button id="close-main-navivation" type="button"
                class="md:hidden btn btn-outline btn-primary bg-primary-focus btn-circle absolute top-16 right-6">
                <i class="fa-thin fa-times text-white"></i>
            </button>
            <nav
                class="
                    m-auto flex flex-col gap-12 leading-8
                    md:flex-row
                ">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}
                    text-white hover:text-white active:text-white focus:text-white transition-all relative
                    before:w-full before:h-full before:bg-white before:bg-opacity-30 before:absolute before:-skew-y-12 before:scale-x-0 before:scale-y-0 before:transition-all ease-in-out before:origin-center
                    hover:before:scale-y-150 hover:before:scale-x-125 hover:before:skew-y-6
                    "
                    href="{{ route('home') }}"><i class="fa-thin fa-house-chimney mr-1"></i> Accueil</a>
                <a class="{{ request()->routeIs('consultations') ? 'active' : '' }}
                    text-white hover:text-white active:text-white focus:text-white transition-all relative
                    before:w-full before:h-full before:bg-white before:bg-opacity-30 before:absolute before:-skew-y-12 before:scale-x-0 before:scale-y-0 before:transition-all ease-in-out before:origin-center
                    hover:before:scale-y-150 hover:before:scale-x-125 hover:before:skew-y-6
                    "
                    href="{{ route('consultations') }}"><i class="fa-thin fa-moon-over-sun mr-1"></i> Me consulter</a>
                <a class="{{ request()->routeIs('testimonies') ? 'active' : '' }}
                    text-white hover:text-white active:text-white focus:text-white transition-all relative
                    before:w-full before:h-full before:bg-white before:bg-opacity-30 before:absolute before:-skew-y-12 before:scale-x-0 before:scale-y-0 before:transition-all ease-in-out before:origin-center
                    hover:before:scale-y-150 hover:before:scale-x-125 hover:before:skew-y-6
                    "
                    href="{{ route('testimonies') }}"><i class="fa-thin fa-solar-system mr-1"></i> Témoignages</a>
                <a class="{{ request()->routeIs('my_universe') ? 'active' : '' }}
                    text-white hover:text-white active:text-white focus:text-white transition-all relative
                    before:w-full before:h-full before:bg-white before:bg-opacity-30 before:absolute before:-skew-y-12 before:scale-x-0 before:scale-y-0 before:transition-all ease-in-out before:origin-center
                    hover:before:scale-y-150 hover:before:scale-x-125 hover:before:skew-y-6
                    "
                    href="{{ route('my_universe') }}"><i class="fa-thin fa-moon-stars mr-1"></i> Mon univers</a>
            </nav>
        </div>


    </x-slot:actions>
</x-structure.header>
