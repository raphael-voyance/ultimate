<?php

namespace App\View\Components\Structure;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public function __construct(
        public ?bool $sticky = false,
        public ?bool $fullWidth = false,

        // Slots
        public mixed $brand = null,
        public mixed $actions = null
    ) {
        //
    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
                @if($sticky && !request()->routeIs('home'))
                    <div id="sticky-header" class="sticky z-[29]">
                @endif

                    <header id="header" {{ $attributes->merge(['class' => 'min-h-[96px] bg-base-100/75 shadow-md z-10']) }}>
                        <div class="absolute w-full h-full backdrop-blur-sm"></div>
                        <div class="min-h-[96px] mx-auto z-30 pl-6 pr-10 py-5 flex items-center relative @if(!$fullWidth) max-w-screen-2xl @endif">
                            <div class="flex items-center" }}>
                                {{ $brand }}
                            </div>
                            <div class="flex w-full ml-auto gap-4 items-center justify-end lg:gap-8">
                                {{ $actions }}
                            </div>
                        </div>
                    </header>

                @if($sticky)
                    </div>
                @endif
                HTML;
    }
}
