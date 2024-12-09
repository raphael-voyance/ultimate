<x-admin-layout>
    @section('js')
        @vite(['resources/js/add/universe/appointment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i
                    class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Créer un rendez-vous : </span>
            </div>
        </h2>
    </x-slot>
    
    <div x-data="{
        appointment: null,
        timeSlotDayId: null,
        timeSlotId: null,
        timeSlotDayForHuman: null,
        timeSlotForHuman: null,
        type: 'phone',
        invoice_status: 'PENDING',
        user_id: null,
        handleEvent(event) {
            this.appointment = event.detail[0].appointment;
            this.timeSlotDayId = this.appointment.time_slot_day;
            this.timeSlotId = this.appointment.time_slot;
            this.timeSlotDayForHuman = this.appointment.time_slot_day_for_human;
            this.timeSlotForHuman = this.appointment.time_slot_for_human;
        },
        handleUserSelection($event) {
            user_id = $event.target.value;
            $refs.placeholder_option.setAttribute('disabled', 'disabled');
        },
        submitAppointment() {

            axios.post(window.location.origin + '/admin/appointments/store', {
                time_slot_day: this.timeSlotDayId,
                time_slot: this.timeSlotId,
                time_slot_for_human: this.timeSlotForHuman,
                time_slot_day_for_human: this.timeSlotDayForHuman,
                type: this.type,
                invoice_status: this.invoice_status,
                user_id: this.user_id,
            }).then(function(response) {
                window.location.href = response.data.redirect;
            }).catch(function(error) {
                console.log(error);
            });
        }
    }" @timeslot-is-selected="handleEvent($event)">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>
                <div class="py-6 px-4 rounded bg-base-300/75">
                    <div class="mb-4">
                        <h4 class="mb-2">Mode de consultation :</h4> 
                        <select class="select select-bordered select-primary w-full" id="appointment_type" name="appointment_type" x-model="type">
                            @foreach ($services as $s)
                            <option value="{{ $s->slug }}">{{ $s->name }} - {{ $s->amount }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <h4 class="mb-2">Honoraire :</h4>
                        <select class="select select-bordered select-primary w-full" id="invoice_status" name="invoice_status" x-model="invoice_status">
                            <option value="PENDING">Payante</option>
                            <option value="FREE">Gratuite</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- Fin 1ère colonne --}}

            {{-- Début 2ème colonne --}}
            <div>
                <div class="py-6 px-4 mb-4 rounded bg-base-300/75">
                    <div class="mb-4">
                        <h4 class="mb-2">Consultant : </h4>
                        <select class="select select-bordered select-primary w-full" id="user_id" name="user_id" x-model="user_id" @change="handleUserSelection($event)">
                            <option x-ref="placeholder_option" selected>Sélectionnez un utilisateur...</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->fullName() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        @livewire('admin.modal-create-user')
                    </div>

                    <template x-if="type != 'writing' && user_id">
                        <div class="mb-4">
                        @livewire('admin.select-timeslot-appointment')
                        </div>
                    </template>
                    
                    <template x-if="user_id && (appointment || type == 'writing')">
                        <x-ui.primary-button x-on:click="submitAppointment()" class="btn-sm h-12 md:h-8 mt-4" x-text="type == 'writing' ? 'Créer la demande' : 'Créer le rendez-vous'"></x-ui.primary-button>
                    </template>
                </div>
            </div>
            {{-- Fin 2ème colonne --}}
        </div>
    </div>
</x-admin-layout>
