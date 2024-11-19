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
    {{-- Colonne pour la checkbox selection --}}
    @scope('cell_selection', $row)
    @if($row['available'])
    <input 
        id="selected-row-{{ $row['selection']['time_slot_day_id'] }}-{{ $row['selection']['time_slot_id'] }}" 
        type="checkbox" 
        class="checkbox checkbox-sm checkbox-primary" 
        wire:change="toggleSelection({{ $row['selection']['time_slot_day_id'] }}, {{ $row['selection']['time_slot_id'] }}, $event.target.checked)"
    />
    @endif
    @endscope

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
      @if($row['available'])
          <div class="flex gap-2">
              <x-mary-button icon="o-trash" spinner wire:click="deleteTimeSlot({{ $row['selection']['time_slot_day_id'] }}, {{ $row['selection']['time_slot_id'] }})" spinner class="btn btn-sm"></x-mary-button>
          </div>
      @endif
      @endscope
  </x-mary-table>

  <div class="flex flex-col md:flex-row flex-wrap justify-center items-center md:justify-between gap-4 mt-4">
    
    <div>
      @if (count($selected) > 0)
      <x-mary-button wire:click="deleteSelectedTimeSlot()" spinner class="btn btn-sm float-left h-auto">
        <i class='fa-thin fa-calendar-circle-minus'></i> Supprimer le(s) créneau(x) horaire(s) sélectionné(s)
      </x-mary-button>
      @endif
    </div>
      
    <div>
      {{-- Navigation pour la pagination --}}
      <div>
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
  </div>

</div>