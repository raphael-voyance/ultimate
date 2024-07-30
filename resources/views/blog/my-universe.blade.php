<x-guest-layout>

    @section('css')
        @vite('resources/css/add/blog_style.css')
    @endsection

        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                Mon univers
            </h2>
        </x-slot>

    <section class="blog">
        <section class="posts-list">
            @foreach ($posts as $post)
            
                <article class="post-item">
        
                    <div data-alt="{{ $post->title }}" class="thumbnail">
                        <img alt="Image de l'article : {{ $post->title }}" src="{{ $post->image }}" />
                    </div>

                    <div class="post-info">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->excerpt(15) }}</p>
                        <a href="{{ route('my_universe.show', $post->slug) }}">Lire l'article</a>

                        <div class="post-meta">
                            <p>Le 15 janvier 1991</p>
                        </div>
                        <div class="post-categories">
                            <a href="#" class="badge badge-accent hover:text-inherit">Catégorie 1</a> <a href="#" class="badge badge-accent hover:text-inherit">Catégorie 2</a>
                        </div>
                    </div>
                </article>
                
            
            
            @endforeach
        </section>

        <div class="mt-4">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>

    </section>
    

</x-guest-layout>
