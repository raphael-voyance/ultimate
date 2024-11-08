<x-admin-layout>

    @section(('js'))
        
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Gestion des créneaux horaires : </span>
            </div>
        </h2>
    </x-slot>

    <section x-data="{
        betweenDate: true,
        days: false,
        mtof: true,
        we: false,
    
        switchModes() {
            // Toggle both states
            this.betweenDate = !this.betweenDate;
            this.days = !this.days;
        },

        switchDays() {
            // Toggle both states
            this.mtof = !this.mtof;
            this.we = !this.we;
        }
    }">
        <div class="mb-8">
            <div class="mb-2">
                Créer des créneaux horaires de <input type="time" wire:model="time" class="input input-sm" value="01:00" /> espacés de <input type="time" wire:model="interval" class="input input-sm" value="00:30" />
            </div>
            <div class="mb-6">
                Entre : <input type="time" wire:model="start_time" class="input input-sm" value="10:00" /> et <input type="time" wire:model="end_time" class="input input-sm" value="20:00" />
            </div>

            <hr class="my-4" />
            
            <div class="mb-4">
                <div class="grid grid-cols-2 mb-4">
                    <x-mary-checkbox label="Entre deux dates" x-model="betweenDate" x-on:click="switchModes()" />
                    <x-mary-checkbox label="Jour de la semaine" x-model="days" x-on:click="switchModes()" />
                </div>
                
                <template x-if="days">
                    <div>
                        <x-mary-checkbox class="mb-2" label="lundi à vendredi" wire:model="mtof" x-model="mtof" x-on:click="switchDays()" />
                        <x-mary-checkbox label="week-end" wire:model="we" x-model="we" x-on:click="switchDays()" />
                        <label for="weeks">Nombre de semaine à générer : </label>
                        <input class="input input-primary w-14 ml-2" id="weeks" name="weeks" type="number" wire:model="weeks" value="4" />
                    </div>
                </template>
    
                <template x-if="betweenDate">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-mary-datetime label="du" wire:model="dateStart" />
                        </div>
                        <div>
                            <x-mary-datetime label="au" wire:model="endStart" />
                        </div>
                    </div>
                </template>
            </div>
    
            <button id="create_timeslots" class="btn btn-sm"><i class="fa-thin fa-calendar-circle-plus"></i> Créer les créneaux horaires</button>
        </div>
    
        <hr class="my-4" />

        @livewire('admin.data-table-time-slots')

    </section>
    

</x-admin-layout>