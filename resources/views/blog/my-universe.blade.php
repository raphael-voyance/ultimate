<x-guest-layout>

    @section('css')
        @vite('resources/js/add/blog/blog.css')
    @endsection

        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                Mon univers
            </h2>
        </x-slot>

    <section class="blog">
        <section class="posts-list">
            @foreach ($posts as $post)
            
                <article class="post-item relative">
        
                    <div data-alt="{{ $post->title }}" class="thumbnail">
                        <img src="{{ route('image.post.thumbnail', ['filename' => basename($post->image)]) }}" alt="{{ $post->title }}" />
                    </div>

                    <div class="post-info">
                        <h3>{{ $post->title }}</h3>
                        @if($post->excerpt)
                            <p>{{ $post->excerpt }}</p>
                        @endif

                        <a href="{{ route('my_universe.show', $post->slug) }}">Lire l'article</a>

                        <div class="post-meta">
                            <p>le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}</p>
                        </div>
                        <div class="post-categories">
                            @foreach ($post->categories as $category)
                            <a href="#" class="badge badge-accent hover:text-inherit focus:text-inherit">{{ $category->name }}</a> 
                            @endforeach
                        </div>
                        @can('admin')
                            <a href="{{ route('admin.blog.post.edit', $post->id) }}" class="absolute right-3 top-3 badge badge-secondary hover:text-inherit focus:text-inherit">Modifier l'article</a> 
                        @endcan
                    </div>
                </article>
                
            
            
            @endforeach
        </section>

        <div class="mt-4">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>

    </section>
    

</x-guest-layout>
