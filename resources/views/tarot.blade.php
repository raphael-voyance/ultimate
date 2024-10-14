<x-full-screen-layout>
    @section('js')
        @vite(['resources/js/add/tarot/tarot.js'])
    @endsection

    <article class="relative -top-8">

        <section class="mb-4">
            
            @if (isset($draw))
                <x-tarot.drawing-card :draw="$draw"/>
            @else
                <x-tarot.drawing-card/>
            @endif
            
        </section>

    </article>

</x-full-screen-layout>
