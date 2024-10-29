<div>
    <button @click.prevent="$wire.ModalEditAppointment = true" class="btn btn-warning">
        <i class="fa-thin fa-calendar"></i> Modifier le RDV</button>


    <x-mary-modal wire:model="ModalEditAppointment" title="Modifier votre rendez-vous" subtitle="Gestion de votre rendez-vous programmé le {{ $initialeDate }}" separator class="text-left">

        {{-- Loader --}}
        <div class="relative" wire:loading>
            <x-ui.loader :loadingText="false" :overlay="false" />
        </div>
        {{-- Fin Loader --}}

        <div>Pour modifier votre rendez-vous, sélectionnez un autre moment ci-après :</div>

        <div>
            @foreach ($timeSlotDays as $timeSlotDay)
                <div
                    class="group day bg-base-300 mb-4 py-4 px-6 hover:shadow-lg hover:ring-2 hover:ring-neutral-900/25 transition-all">

                    <div
                        class="relative inline-block mb-5 pb-3 text-neutral-200
                after:absolute after:bottom-0 after:left-0 after:h-1 after:w-[60%] after:origin-leftz after:rounded-sm after:bg-neutral-100/75
                after:transition-all group-hover:after:w-full">
                        {{ $timeSlotDay['dayFormatte'] }}
                    </div>
                    <div class="hours grid grid-cols-3 gap-3">

                        @if (collect($timeSlotDay['time_slots'])->isNotEmpty())
                            @foreach ($timeSlotDay['time_slots'] as $slotTime)

                            
                                <button
                                    wire:click="selectTimeSlot({{ $timeSlotDay['id'] }}, {{ $slotTime['id'] }})"
                                    @class([
                                        'hour btn btn-primary btn-sm',
                                        'hidden' => !$slotTime['pivot']['available'],
                                        'btn-active ring-primary/50 ring-offset-4 ring-offset-base-300 ring-2 cursor-default' => $timeSlotDay['id'] == $appointment['time_slot_day'] && $slotTime['id'] == $appointment['time_slot']
                                    ])>{{ Carbon\Carbon::parse($slotTime['start_time'])->format('H\hi') }}</button>
                            @endforeach
                        @else
                            <p class="text-neutral-400">Aucun créneau horaire disponible pour cette
                                journée.</p>
                        @endif


                    </div>

                </div>
            @endforeach
        </div>

    </x-mary-modal>
</div>
