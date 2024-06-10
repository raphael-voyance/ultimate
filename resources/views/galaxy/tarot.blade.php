<x-fullscreen-layout>
    @section('js')
        @vite(['resources/js/add/tarot/tarot.js'])
    @endsection

    <article class="relative -top-8">

        <section class="mb-4">
            
            <x-tarot.drawing-card/>

        </section>

    </article>

</x-fullscreen-layout>
