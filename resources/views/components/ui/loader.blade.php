@props(['overlay' => true, 'loadingText' => true, 'fixed' => true])

<div @class([
    'top-0 bottom-0 left-0 right-0 h-screen md:h-full rounded-md z-20',
    'fixed' => $fixed,
    'absolute' => !$fixed,
    'bg-base-200/60' => $overlay]) >

    @if($overlay)
    <div class="backdrop-blur-sm opacity-75 absolute top-0 bottom-0 w-full h-full"></div>
    @endif

    <div class="flex h-full">
        <div class="m-auto text-teal-400">
            {{-- Spinner --}}
            <span class="loader"></span>

            {{-- Spinner Text --}}
            @if($loadingText)
            <span class="inline-block ml-2 -translate-y-[5px]">Chargement en cours...</span>
            @endif
        </div>
    </div>

</div>
