<x-admin-layout>

    @section('js')
        @vite(['resources/js/add/universe/appointment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Créer un rendez-vous
        </h2>
    </x-slot>
    
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>

                <div class="py-6 px-4 rounded bg-base-300/75">

                    <div class="mb-2">
                        <h4 class="mb-2">Mode de consultation :</h4> 
                        <select class="select select-bordered select-primary w-full" id="appointment_type" name="appointment_type">
                            @foreach ($services as $s)
                            <option value="{{ $s->slug }}">{{ $s->name }} - {{ $s->amount }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <h4 class="mb-2">Statut de la demande :</h4>
                        <select class="select select-bordered select-primary w-full" id="appointment_status" name="appointment_status">
                            <option value="PENDING">En attente</option>
                            <option value="APPROVED">Confirmée</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <h4 class="mb-2">Honoraire :</h4>
                        <select class="select select-bordered select-primary w-full" id="invoice_status" name="invoice_status">
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
                        <select class="select select-bordered select-primary w-full" id="user_id" name="user_id">
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->fullName() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-xs btn-primary"><i class="fal fa-user-plus"></i> Créer un consultant</button>
                    </div>

                    <div class="mb-4">
                        <h4 class="mb-2">Moment :</h4>
                        <p>Timeslot du RDV si non par écrit</p>
                        <p>Question si par écrit</p>
                    </div>
                    

                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        <footer class="text-center text-xl mt-6">

            <button class="btn btn-primary mr-4">Enregistrer</button>

        </footer>
    </div>




</x-admin-layout>
