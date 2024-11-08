<div>
  <header class="flex flex-col items-center gap-2 md:flex-row justify-center md:justify-between mb-4 mt-6">
    <div>
      <h3>Créneaux horaires existants</h3>
    </div>
    <div>
      @if($timeslotForDeleted)
        <button wire:click="deletePastsTimeslots()" class="btn btn-sm"><i class="fa-thin fa-calendar-circle-minus"></i> Supprimer les créneaux horaires passés</button>
      @endif
    </div>
  </header>
  
  <x-mary-table :headers="$headers" :rows="$rows" striped :cell-decoration="$cell_decoration" >
      {{-- Colonne pour la date du time slot day --}}
      @scope('cell_day', $row)
          {{ $row['day'] }}
      @endscope

        {{-- Colonne pour l'heure de début --}}
        @scope('cell_start_time', $row)
            {{ $row['start_time'] }}
        @endscope

      {{-- Colonne pour l'heure de fin --}}
      @scope('cell_end_time', $row)
          {{ $row['end_time'] }}
      @endscope

      {{-- Colonne pour les actions --}}
      @scope('cell_actions', $row)
          <div class="flex gap-2">
              <button class="btn btn-sm"><x-mary-icon name="o-pencil" /></button>
              <button class="btn btn-sm"><x-mary-icon name="o-trash" /></button>
          </div>
      @endscope
  </x-mary-table>


  {{-- Navigation pour la pagination --}}
  <div class="mt-4">
    @if($rows->onFirstPage())
        <button class="btn btn-sm" disabled>Précédent</button>
    @else
        <button class="btn btn-sm" wire:click="gotoPage({{ $rows->currentPage() - 1 }})">Précédent</button>
    @endif

    @if($rows->hasMorePages())
        <button class="btn btn-sm" wire:click="gotoPage({{ $rows->currentPage() + 1 }})">Suivant</button>
    @else
        <button class="btn btn-sm" disabled>Suivant</button>
    @endif
</div>

</div>