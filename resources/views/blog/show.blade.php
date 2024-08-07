<x-guest-layout>

    @section('css')
        @vite('resources/js/add/blog/blog.css')
    @endsection
    @section('js')
        @vite('resources/js/add/blog/blog.js')
    @endsection

    <article class="blog">
        <header class="post-header">
            <h2 class="font-semibold text-xl leading-tight">
                {{ $post->title }}
            </h2>
        </header>
        

        <section class="post-content">
            <div class="thumbnail">
                <img src="{{ $post->image }}" />
            </div>
            
            <div data-post-id="{{ $post->id }}" class="the-post" id="editor-view"></div>
            
        </section>

    </article>

    
    

</x-guest-layout>
