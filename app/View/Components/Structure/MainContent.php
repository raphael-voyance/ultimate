<?php

namespace App\View\Components\Structure;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class MainContent extends Component
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
                        "max-w-screen-2xl" => !$fullWidth
                    ])->merge(['class' => ''])}}>

                    <div {{ $content->attributes->class(["flex flex-col max-w-7xl mx-auto w-full my-8 p-5 lg:p-10"]) }}>
                        {{ $content }}
                    </div>

                </main>
                HTML;
    }
}
