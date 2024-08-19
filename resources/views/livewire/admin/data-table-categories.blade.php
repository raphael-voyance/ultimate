<div>
    {{-- You can use any `$wire.METHOD` on `@row-click` --}}
    @php
      $categories = DB::table('categories')->orderBy('name', 'desc')->paginate(8);
    @endphp
    <x-mary-table :headers="$headers" :rows="$categories" striped with-pagination>
    
      @scope('cell_actions', $category)
      <div class="flex flex-nowrap gap-2">
          <a href="{{ route('admin.blog.category.edit', $category->id) }}" class="btn btn-sm btn-circle btn-info btn-outline"><x-mary-icon name="o-pencil-square" /></a>
          <x-mary-button data-btn-category-del="{{ route('admin.blog.category.destroy', $category->id) }}" icon="o-trash" spinner class="btn-sm btn-circle btn-error btn-outline" />
      </div>
      @endscope

      @scope('cell_description', $category)
        @if($category->description)
          {{ $category->description }}
        @else
          <span class="text-gray-500 italic">Aucune description renseignée</span>
        @endif
      @endscope
    
      
    </x-mary-table>
    
        </div>
    