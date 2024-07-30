<x-guest-layout>

    @section('css')
        @vite('resources/css/add/blog_style.css')
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
            
            <div class="the-post">
                <p>{{ $post->content }}</p>
            </div>
            
        </section>

    </article>

    
    

</x-guest-layout>
