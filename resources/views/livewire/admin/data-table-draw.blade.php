<div>

  
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
<x-mary-table :headers="$headers" :rows="$draws" striped >

  @scope('cell_interpretations', $draw)
  <div class="flex flex-nowrap gap-2">
    @if($draw->interpretationIsCompleted)
    <x-mary-icon name="o-check" />
    @else
    <x-mary-icon name="o-x-mark" />
    @endif
  </div>
  @endscope

  @scope('cell_actions', $draw)
  <div class="flex flex-nowrap gap-2">
      <a href="{{ route('admin.draw.edit', $draw->id) }}" class="btn btn-sm btn-circle btn-info btn-outline"><x-mary-icon name="o-pencil-square" /></a>
      <x-mary-button data-btn-draw-del="{{ route('admin.draw.destroy', $draw->id) }}" icon="o-trash" spinner class="btn-sm btn-circle btn-error btn-outline" />
  </div>
  @endscope

  @scope('cell_active', $draw)
    @if($draw->active == 1)
    Oui
    @else
    Non
    @endif
  @endscope

  {{-- Special `actions` slot --}}
  {{-- @scope('actions', $user)
        <x-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm" />
      @endscope --}}

  
</x-mary-table>

    </div>
