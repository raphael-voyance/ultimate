<x-admin-layout>

    @section('js')
        @vite('resources/js/add/universe/timeslots.js')
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i
                    class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span class="block mb-2  sm:mb-1"> Gestion des créneaux horaires : </span>
            </div>
        </h2>
    </x-slot>

    <section>

        <div class="collapse collapse-arrow bg-base-200 mb-4">
            <input type="radio" name="addTS" checked="checked" class="w-full" />
            <div class="collapse-title text-xl font-medium">Ajouter un créneau horaire</div>
            <div class="collapse-content">
                <section x-data="{
                    date: '',
                }">
                    <div class="mb-8">
                        <div class="mb-8">
                            <x-mary-datetime class="mb-2" label="le :" x-model="date" />
                            <input type="hidden" id="date" name="date" x-model="date" />
                            <label for="timeStart">de :</label>
                            <input type="time" id="timeStart" name="timeStart" class="input input-sm" value="10:00" />
                            <label for="timeEnd">à :</label>
                            <input type="time" id="timeEnd" name="timeEnd" class="input input-sm" value="12:00" />
                        </div>
                        <button id="add_timeslot" class="btn border-gray-400 bordered btn-sm"><i class="fa-thin fa-calendar-plus"></i> Ajouter un créneau
                            horaire</button>
                    </div>
                </section>
            </div>
        </div>
        <div class="collapse collapse-arrow bg-base-200">
            <input type="radio" name="addTS" class="w-full" />
            <div class="collapse-title text-xl font-medium">Ajouter plusieurs créneaux horaires à la volée</div>
            <div class="collapse-content">
                <section x-data="{
                    mtof: true,
                    we: false,
                    mtofOrWe: 'mtof',
                    startModel: 'tomorrow',
                    startTomorrow: true,
                    startTo: false,
                    dateStart: '',
                
                    switchDays() {
                        // Toggle both states
                        this.mtof = !this.mtof;
                        this.we = !this.we;
                
                        if (this.mtof) {
                            this.mtofOrWe = 'mtof';
                        } else {
                            this.mtofOrWe = 'we';
                        }
                    },
                
                    switchStart() {
                        // Toggle both states
                        this.startTomorrow = !this.startTomorrow;
                        this.startTo = !this.startTo;
                
                        this.startModel = this.startTomorrow ? 'tomorrow' : 'date';
                    }
                }">
                    <div class="mb-8">
                        <div class="mb-2">
                            Créer des créneaux horaires de <input type="time" id="time" name="time"
                                class="input input-sm" value="01:00" /> espacés de <input type="time" id="interval"
                                name="interval" class="input input-sm" value="00:30" />
                        </div>
                        <div class="mb-6">
                            Entre : <input type="time" id="start_time" name="start_time" class="input input-sm" value="10:00" />
                            et <input type="time" id="end_time" name="end_time" class="input input-sm" value="20:00" />
                        </div>
            
                        <hr class="my-4" />
            
                        <div class="mb-4">
                            <div>
                                <x-mary-checkbox class="mb-2" label="à partir de demain" x-model="startTomorrow"
                                    x-on:click="switchStart()" />
            
                                <x-mary-checkbox class="mb-2" label="à partir de :" x-model="startTo"
                                    x-on:click="switchStart()" />
            
                                <input type="hidden" id="startModel" name="startModel" x-model="startModel" />
            
                                <template x-if="startTo">
                                    <div>
                                        <x-mary-datetime x-model="dateStart" />
                                        <input type="hidden" id="dateStart" name="dateStart" x-model="dateStart" />
                                    </div>
                                </template>
            
                            </div>
                            <div>
                                <x-mary-checkbox class="mb-2" label="lundi à vendredi" x-model="mtof" x-on:click="switchDays()" />
                                <x-mary-checkbox label="week-end" x-model="we" x-on:click="switchDays()" />
                                <label for="weeks">Nombre de semaine à générer : </label>
                                <input class="input input-primary w-14 ml-2" id="weeks" name="weeks" type="number"
                                    value="1" />
                                <input type="hidden" id="mtofOrWe" name="mtofOrWe" x-model="mtofOrWe" />
                            </div>
            
                            {{-- <template x-if="betweenDate">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-mary-datetime label="du" x-model="dateStart" />
                                        <input type="hidden" id="dateStart" name="dateStart" x-model="dateStart" />
                                    </div>
                                    <div>
                                        <x-mary-datetime label="au" x-model="dateEnd" />
                                        <input type="hidden" id="dateEnd" name="dateEnd" x-model="dateEnd" />
                                    </div>
                                </div>
                            </template> --}}
                        </div>
            
                        <button id="create_timeslots" class="btn border-gray-400 bordered  btn-sm"><i class="fa-thin fa-calendar-circle-plus"></i> Créer
                            les créneaux horaires</button>
                    </div>
                </section>
            </div>
        </div>
            
        @livewire('admin.data-table-time-slots')
    </section>

    
    


</x-admin-layout>
