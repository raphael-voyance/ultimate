<div>

    {{-- Loader --}}
    <div class="relative" wire:loading>
        <x-ui.loader :loadingText="false" :overlay="false" />
    </div>
    {{-- Fin Loader --}}

    <p class="mb-2">Sélectionnez le jour et l'heure du RDV ci-après :</p>

    <div>
        @foreach ($timeSlotDays as $timeSlotDay)
            <div class="group day bg-base-300 mb-4 py-4 px-6 hover:shadow-lg hover:ring-2 hover:ring-neutral-900/25 transition-all">
                <div class="relative inline-block mb-5 pb-3 text-neutral-200 after:absolute after:bottom-0 after:left-0 after:h-1 after:w-[60%] after:origin-leftz after:rounded-sm after:bg-neutral-100/75 after:transition-all group-hover:after:w-full">
                    {{ $timeSlotDay['dayFormatte'] }}
                </div>



                <div class="hours grid grid-cols-3 gap-3">
                    @if (collect($timeSlotDay['time_slots'])->isNotEmpty())

                    @foreach ($timeSlotDay['time_slots'] as $slotTime)
                        


                    <button wire:click.prevent="selectTimeSlot({{ $timeSlotDay['id'] }}, {{ $slotTime['id'] }})"
                                    @class([
                                        'hour btn btn-primary btn-sm',
                                        'hidden' => !$slotTime['pivot']['available'],
                                        'btn-active ring-primary/50 ring-offset-4 ring-offset-base-300 ring-2 cursor-default' =>
                                            !empty($appointment) &&
                                            $timeSlotDay['id'] == $appointment['time_slot_day'] &&
                                            $slotTime['id'] == $appointment['time_slot'],
                                    ])>
                                    
                                {{ Carbon\Carbon::parse($slotTime['start_time'])->format('H\hi') }}
                            </button>
                            
                    @endforeach

                    @endif
                </div>
            </div>
        @endforeach

        <div class="grid grid-cols-2 gap-2">
            @if ($offsetTimeSlot >= 5)
                <button wire:click.prevent="prevTimeSlots()"
                        class="block mx-auto w-64 max-w-full btn btn-sm btn-primary btn-outline col-start-1 col-end-2">Créneaux précédents</button>
            @endif
            @if ($offsetTimeSlot <= $totalOffsetTimeSlot - 1)
                <button wire:click.prevent="nextTimeSlots()"
                        class="block mx-auto w-64 max-w-full btn btn-sm btn-primary btn-outline col-start-2 col-end-3">Créneaux suivants</button>
            @endif
        </div>
        
    </div>
</div>
