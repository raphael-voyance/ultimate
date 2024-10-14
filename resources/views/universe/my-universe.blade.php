<x-guest-layout>

    @section('css')
        @vite('resources/js/add/blog/blog.css')
        @vite('resources/js/add/blog/blog.js')
    @endsection

        <x-slot name="header">
            <h2 class="font-semibold text-xl leading-tight">
                <i class="fa-thin fa-stars -rotate-12"></i> Dans mon univers...privée
            </h2>
        </x-slot>

    <section class="blog">

        <div class="card bg-base-300 shadow-xl mx-auto mb-8">
            <div class="card-body text-center">
                <div class="flex flex-row justify-center items-center">
                    <a href="{{ route('my_universe.index') }}" class="badge badge-secondary hover:text-inherit focus:text-inherit">Accéder aux articles publics</a>
                </div>
            </div>
        </div>

        <section class="posts-list">
            @foreach ($posts as $post)
                <article class="post-item relative">
                    <div data-alt="{{ $post->title }}" class="thumbnail">
                        <div class="parallax">
                            @if(Str::contains(basename($post->image), 'pending'))
                                <img src="{{ asset('storage/site-images/' . config('siteconfig.pending', 'pending.jpg')) }}" alt="{{ $post->title }}" />
                            @else
                                <img src="{{ route('image.private', ['postSlug' => $post->slug, 'filename' => basename($post->image)]) }}" alt="Thumbnail : {{ $post->title }}">
                            @endif
                        </div>
                    </div>
        
                    <div class="post-info">
                        <h3>{{ $post->title }}</h3>
                        @if($post->excerpt)
                            <p class="post-excerpt">{{ $post->excerpt }}</p>
                        @endif
        
                        @if(!\Carbon\Carbon::parse($post->published_at)->isFuture() || (Auth::check() && Auth::user()->can('admin')))
                            <a href="{{ route('my_universe.show', $post->slug) }}" class="badge badge-primary hover:text-inherit focus:text-inherit">Lire l'article</a>
                        @endif
        
                        <div class="post-meta">
                            @if(\Carbon\Carbon::parse($post->published_at)->isFuture())
                                <p class="published_at text-red-500">Cet article n'est pas encore publié. </br>
                                    Sa date de publication estimé est le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}</p>
                            @else
                                <p class="published_at">publié le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}</p>
                            @endif
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