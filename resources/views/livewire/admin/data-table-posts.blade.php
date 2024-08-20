<div>

  
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
@php
  $posts = DB::table('posts')->orderBy('title', 'desc')->paginate(8);
@endphp
<x-mary-table :headers="$headers" :rows="$posts" striped with-pagination>

  @scope('cell_excerpt', $post)
  @if($post->excerpt)
          {{ $post->excerpt }}
        @else
          <span class="text-gray-500 italic">Aucune description renseignée</span>
        @endif
  @endscope

  @scope('cell_status', $post)
  @switch($post->status)
    @case('PUBLISH')
      Publié
    @break
    @case('DRAFT')
      Brouillon
    @break
    @case('PRIVATE')
      Privé
    @break
    @case('TRASH')
      Corbeille
    @break
      
  @endswitch
  @endscope

  @scope('cell_actions', $post)
  <div class="flex flex-nowrap gap-2">
      <a href="{{ route('admin.blog.post.edit', $post->id) }}" class="btn btn-sm btn-circle btn-warning btn-outline"><x-mary-icon name="o-pencil-square" /></a>

      <a href="{{ route('my_universe.show', $post->slug) }}" class="btn btn-sm btn-circle btn-info btn-outline"><i class="fa-light fa-eye"></i></a>

      <a href="#" data-copy-link="{{ route('my_universe.show', $post->slug) }}" class="btn btn-sm btn-circle btn-info btn-outline"><i class="fa-light fa-copy"></i></a>

      <a href="{{ route('admin.blog.post.duplicate', $post->id) }}" class="btn btn-sm btn-circle btn-info btn-outline"><i class="fa-light fa-clone"></i></a>

      <x-mary-button data-btn-post-del="{{ route('admin.blog.post.destroy', $post->id) }}" icon="o-trash" spinner class="btn-sm btn-circle btn-error btn-outline" />
  </div>
  @endscope

  @scope('cell_thumbnail', $post)
  <div class="flex flex-nowrap gap-2">
    <div class="avatar">
                            
      <div class="w-20 rounded-full">
          @if(Str::contains(basename($post->image), 'pending'))
              <!-- Affichage spécifique si le nom de l'image contient "pending" -->
              <img id="thumbnail-preview" src="{{ asset('storage/site-images/' . config('siteconfig.pending', 'pending.jpg')) }}" alt="Pending Thumbnail" />
          @elseif($post->status == 'PRIVATE')
              <img id="thumbnail-preview" src="{{ route('image.private', ['filename' => basename($post->image)]) }}" alt="Thumbnail">
          @else
              <img id="thumbnail-preview" src="{{ route('image.post.thumbnail', ['filename' => basename($post->image)]) }}" alt="Thumbnail" />
          @endif
      </div>
  </div>
  </div>
  @endscope

  
</x-mary-table>

    </div>
