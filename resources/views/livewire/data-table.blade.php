<div>
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
<x-mary-table :headers="$headers" :rows="$draws" striped >

  @scope('cell_interpretations', $draw)
  <div class="flex flex-nowrap gap-2">
    <x-mary-icon name="o-check" />
    <x-mary-icon name="o-x-mark" />
    {{ dump(print_r($draw->interpretations)) }}
  </div>
  @endscope

  @scope('cell_actions', $draw)
  <div class="flex flex-nowrap gap-2">
      <x-mary-button icon="o-pencil-square" spinner class="btn-sm btn-circle btn-info btn-outline" />
      <x-mary-button icon="o-trash" spinner class="btn-sm btn-circle btn-error btn-outline" />
  </div>
  @endscope

  {{-- Special `actions` slot --}}
  {{-- @scope('actions', $user)
        <x-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm" />
      @endscope --}}

  
</x-mary-table>

    </div>
