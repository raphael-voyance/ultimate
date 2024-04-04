<div
    x-data="{
        hoverVisible: false,
        hoverPosition: '{{ $hoverPosition }}',
    }"
    x-init="$refs.content.addEventListener('mouseenter', () => { hoverVisible = true; }); $refs.content.addEventListener('mouseleave', () => { hoverVisible = false; });"
    class="relative">

    <div x-ref="hover" x-show="hoverVisible" :class="{ 'top-0 left-0 -mt-0.5 -translate-y-full' : hoverPosition == 'top', 'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full' : hoverPosition == 'left', 'bottom-0 left-0 -mb-0.5 translate-y-full' : hoverPosition == 'bottom', 'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full' : hoverPosition == 'right' }" class="z-10 absolute w-auto text-sm" x-cloak>
        <div x-show="hoverVisible" x-transition class="relative px-2 py-1 text-slate-500 bg-slate-200 rounded-md bg-opacity-90">
            <div class="flex-shrink-0 block text-xs whitespace-nowrap">
                {{ $hover }}
            </div>
        </div>
    </div>

    <div x-ref="content" class="cursor-pointer">{{ $content }}</div>

</div>
