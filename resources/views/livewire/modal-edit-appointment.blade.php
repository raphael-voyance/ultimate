<div>
    <button @click.prevent="$wire.ModalEditAppointment = true" class="btn btn-warning">
        <i class="fa-thin fa-calendar"></i> Modifier le RDV
    </button>

    @if($appointment->appointment_type != 'writing')
        <x-ui.dialog wire:model="ModalEditAppointment" title="Modifier votre rendez-vous" subtitle="Gestion de votre rendez-vous programmé le {{ $initialeDate }}" class="text-left">

            {{-- Loader --}}
            <div class="relative" wire:loading>
                <x-ui.loader :loadingText="false" :overlay="false" />
            </div>
            {{-- Fin Loader --}}

            <div class="mb-4">
                <p class="mb-2">Pour modifier le mode de consultation de votre séance, sélectionnez-le ci-après :</p>
                <select wire:model.lazy="appointmentType" class="input input-bordered block w-full" id="appointmentType">
                    <option value="tchat" @if($appointmentType == 'tchat') selected @endif>Par tchat</option>
                    <option value="phone" @if($appointmentType == 'phone') selected @endif>Par téléphone</option>
                </select>
            </div>
            <div>
                <p class="mb-2">Pour modifier le moment de votre rendez-vous, sélectionnez un jour et une heure ci-après :</p>
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
                                                        $timeSlotDay['id'] == $appointment['time_slot_day'] &&
                                                        $slotTime['id'] == $appointment['time_slot'],
                                                ])>
                                            {{ Carbon\Carbon::parse($slotTime['start_time'])->format('H\hi') }}
                                        </button>
                                    @endforeach
                                @else
                                    <p class="text-neutral-400">Aucun créneau horaire disponible pour cette journée.</p>
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
            <x-slot:actions>
                <button class="btn btn-secondary btn-sm h-12 mr-auto md:h-8 mt-4" @click.prevent="$wire.ModalEditAppointment = false">Annuler</button>
                @if ($timeSlotIsSelected || $appointmentTypeHasChanged)
                    <x-ui.primary-button class="btn-sm h-12 md:h-8 mt-4" wire:click.prevent="updateAppointment()">Modifier le rendez-vous</x-ui.primary-button>
                @endif
            </x-slot:actions>
        </x-ui.dialog>
    @else
        <x-ui.dialog wire:model="ModalEditAppointment" title="Modifier votre rendez-vous" subtitle="Modification de votre question écrite" class="text-left">
            {{-- Loader --}}
            <div class="relative" wire:loading>
                <x-ui.loader :loadingText="false" :overlay="false" />
            </div>
            {{-- Fin Loader --}}

            <div>
                <p class="mb-2">Vous pouvez modifier ou compléter votre question en la modifiant ci-après :</p>
                <textarea wire:model.lazy="writingQuestion" class="textarea resize-none textarea-bordered block w-full" id="writingQuestion" rows="5">{{ $appointment->appointment_message }}</textarea>
            </div>
            <x-slot:actions>
                <button class="btn btn-secondary btn-sm h-12 mr-auto md:h-8 mt-4" @click.prevent="$wire.ModalEditAppointment = false">Annuler</button>
                @if (!isset($f))
                    <x-ui.primary-button class="btn-sm h-12 md:h-8 mt-4" wire:click.prevent="updateAppointment()">Enregistrer votre question</x-ui.primary-button>
                @endif
            </x-slot:actions>
        </x-ui.dialog>
    @endif
</div>
