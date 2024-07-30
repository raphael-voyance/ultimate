<div>

  
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
@php
  $posts = App\Models\Post::paginate(8);
@endphp
<x-mary-table :headers="$headers" :rows="$posts" striped with-pagination>

  @scope('cell_title', $post)
  <div class="group">
    <div class="transition-all translate-y-2 group-hover:translate-y-0">
      {{ $post->title }}
    </div>
    
    <div class="transition-all py-2 h-0 opacity-0 -translate-y-4 group-hover:h-auto group-hover:translate-y-0 group-hover:opacity-85">
      <a class="badge cursor-pointer hover:badge-outline" target="_blank" href="{{ route('my_universe.show', $post->slug) }}">Voir l'article</a> <span class="badge cursor-pointer hover:badge-outline" data-copy-link="{{ route('my_universe.show', $post->slug) }}">Copier le lien</span>
    </div>
    
  </div>
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
      <a href="#" class="btn btn-sm btn-circle btn-info btn-outline"><x-mary-icon name="o-pencil-square" /></a>
      <x-mary-button data-btn-draw-del="#" icon="o-trash" spinner class="btn-sm btn-circle btn-error btn-outline" />
  </div>
  @endscope

  
</x-mary-table>

    </div>
