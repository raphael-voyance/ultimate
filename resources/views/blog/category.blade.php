<x-guest-layout>

    @section('css')
        @vite('resources/js/add/blog/blog.css')
    @endsection

        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight mb-2">
                <i class="fa-thin fa-stars -rotate-12"></i> Dans mon univers...
            </h2>
            <h4 class="font-semibold text-base leading-tight">
                <i class="fa-thin fa-solid fa-solar-system"></i> Galaxie : {{ $category->name }}
            </h4>
        </x-slot>

    <section class="blog">
        <section class="posts-list">
            @foreach ($posts as $post)
            
                <article class="post-item relative">
        
                    <div data-alt="{{ $post->title }}" class="thumbnail">
                        @if(Str::contains(basename($post->image), 'pending'))
                                    <img src="{{ asset('imgs/pending.jpg') }}" alt="{{ $post->title }}" />
                                @else
                                    <img src="{{ route('image.post.thumbnail', ['filename' => basename($post->image)]) }}" alt="{{ $post->title }}" />
                                @endif
                    </div>

                    <div class="post-info">
                        <h3>{{ $post->title }}</h3>
                        @if($post->excerpt)
                            <p class="post-exerpt">{{ $post->excerpt }}</p>
                        @endif

                        <a href="{{ route('my_universe.show', $post->slug) }}" class="badge badge-primary hover:text-inherit focus:text-inherit">Lire l'article</a>

                        <div class="post-meta">
                            <p class="published_at">publié le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}</p>
                        </div>
                        @if(count($post->categories) >= 1)
                        <span class="-mb-3 text-sm">{{ count($post->categories) > 1 ? 'Catégories : ' : 'Catégorie : ' }}</span>
                        <div class="post-categories">
                            @foreach ($post->categories as $category)
                            <a href="{{ route('my_universe.show.category', $category->slug) }}" class="badge badge-accent hover:text-inherit focus:text-inherit">{{ $category->name }}</a> 
                            @endforeach
                        </div>
                        @endif
                        
                        @can('admin')
                            <a href="{{ route('admin.blog.post.edit', $post->id) }}" class="absolute z-10 right-3 top-3 badge badge-secondary hover:text-inherit focus:text-inherit">Modifier l'article</a> 
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