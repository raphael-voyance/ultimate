<div class="flex flex-col relative"
    x-data="{ open: false }"
    x-on:click.away="open = false; $wire.resetIndex();"
    x-on:keydown.escape="open = false; $wire.resetIndex();">
    <input type="text"
        class="focus:outline-none focus:border-green-400 border-2 w-56 rounded md:mr-5 py-1 px-2"
        x-on:click.prevent="open = true"
        wire:model="query"
        wire:keydown.prevent.arrow-down="incrementIndex()"
        wire:keydown.prevent.arrow-up="decrementIndex()"
        wire:keydown.prevent.enter="searchQuery()"
        wire:keydown.backspace="resetIndex()"
    >

    @if (strlen($query) >= 2)
        <div class="z-10 bg-white border border-gray-400 rounded w-56 px-2 py-1 mt-10 flex flex-col absolute" x-show="open">
        @if (count($messages) >= 1)
            @foreach ($messages as $index => $message)
                <a href="#" class="{{ ($index === $selectedIndex) ? 'text-green-400' : '' }} my-2">{{ $message['content'] }}</a>
            @endforeach
        @else
        <span>0 résultat pour "{{ $query }}"</span>
        @endif
        </div>
    @endif
