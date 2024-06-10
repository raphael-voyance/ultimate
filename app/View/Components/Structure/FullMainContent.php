<?php

namespace App\View\Components\Structure;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FullMainContent extends Component
{
    public function __construct(

        // Slots
        public mixed $content = null,
        public mixed $footer = null,
        public ?bool $fullWidth = false,
        public ?bool $withNav = false,
    ) {

    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
                 <main {{ $attributes->class([
                        "flex mx-auto min-h-[calc(100vh-255px)]",
                        "w-full"
                    ])->merge(['class' => ''])}}>

                    <div {{ $content->attributes->class(["flex flex-col max-w-full mx-auto w-full my-8"]) }}>
                        {{ $content }}
                    </div>

                </main>
                HTML;
    }
}
