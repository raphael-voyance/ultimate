<x-guest-layout>

    @section('css')
        @vite('resources/js/add/blog/blog.css')
    @endsection
    @section('js')
        @vite('resources/js/add/blog/blog.js')
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            <i class="fa-thin fa-moon-stars mr-1 -rotate-12"></i> {{ $post->title }}
        </h2>
    </x-slot>

    <article class="blog">
        <section class="post-content">

            {{-- Sinon la date de publication de l'article n'est pas passée --}}
            @if(\Carbon\Carbon::parse($post->published_at)->isFuture())
            {{-- @if(\Carbon\Carbon::parse($post->published_at)->isFuture()) --}}
            <section>
                <div class="card bg-base-100 max-w-xl shadow-xl mx-auto mb-8">
                    <div class="card-body">

                        <p class="published_at text-red-500">
                            Cet article n'est pas encore publié. <br>
                            Sa date de publication estimée est le {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('l d F Y') }}
                        </p>
                      <h2 class="card-title">Voici le résumé de l'article en rédaction :</h2>
                      <p>{{ $post->excerpt }}</p>
                      <div class="card-actions justify-end">
                      </div>
                    </div>
                  </div>
            </section>

            {{-- Sinon la date de publication de l'article est passée --}}
            @elseif(!\Carbon\Carbon::parse($post->published_at)->isFuture() || Auth::check() && Auth::user()->can('admin'))

            @if(\Carbon\Carbon::parse($post->published_at)->isFuture())
            <p class="published_at text-red-500">
                Cet article n'est pas encore publié.
            </p>
            @endif


            <div class="thumbnail">
                @if(Str::contains(basename($post->image), 'pending'))
                    <!-- Affichage spécifique si le nom de l'image contient "pending" -->
                    <img src="{{ asset('imgs/pending.jpg') }}" alt="Pending Thumbnail" />
                @elseif($post->status == 'PRIVATE')
                    <img src="{{ route('image.private', ['filename' => basename($post->image)]) }}" alt="Thumbnail">
                @else
                    <img src="{{ route('image.post.thumbnail', ['filename' => basename($post->image)]) }}" alt="Thumbnail" />
                @endif
            </div>
            
            <div data-post-id="{{ $post->id }}" class="the-post" id="editor-view"></div>
            @endif
        </section>

    </article>

    
    

</x-guest-layout>
