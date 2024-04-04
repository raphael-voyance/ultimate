@props([
    'toggle-text' => 'Toggle Dropdown',
    'mobileIcon' => '',
    'outside' => true,
    'dropdownMenu' => true,
    'inlineDropdown' => false
    ])
<div
    x-data="{
        open: false,
        inline: @js($inlineDropdown),
        dropdownMenu: @js($dropdownMenu),
        btnToggle: function() {
            this.open = !this.open;
        }
    }"
    @if($outside)
        x-on:click.outside="open = false"
    @endif
    {{ $attributes->merge(['class' => 'relative']) }}
>
    <button
        x-on:click="btnToggle"
        :class="{
            'bg-slate-200 focus:bg-slate-200': open,
            '': !open,
            'bg-none bg-transparent focus:bg-none focus:bg-transparent hover:bg-none hover:bg-transparent text-white hover:text-white active:text-white focus:text-white hover:opacity-75 active:opacity-75 focus:opacity-75': inline,
        }"
        class="block w-full px-4 py-2 text-left text-sm leading-5 text-slate-800 hover:bg-slate-100 outline-none focus:outline-none focus:bg-slate-200 transition-all duration-150 ease-in-out"
    >
    @if($mobileIcon)
    <span class="hidden sm:inline">{{ $toggleText }}</span>
    <span class="visible sm:hidden"><i class="{{ $mobileIcon }}"></i></span>
    @else
    {{ $toggleText }}
    @endif


        <span x-show="!open" class="float-right leading-5">
            <i class="fa-thin fa-chevron-right ml-2"></i>
        </span>
        <span x-show="open" class="float-right leading-5">
            <i class="fa-thin fa-chevron-down ml-2"></i>
        </span>
    </button>

    <div x-show="open" x-cloak x-transition class="min-w-[201px]" :class="{
        'absolute right-0 w-full z-20 rounded-lg': dropdownMenu
        }">
        {{ $slot }}
    </div>
</div>
