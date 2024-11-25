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
                    <h3 class="mb-2">Récapitulatif de la demande : </h3>

                    <div class="mb-2">
                        <p>Mode de consultation :</p> 
                        <p>Par tchat</p>
                        <p>Par téléphone</p>
                        <p>Par écrit</p>
                    </div>

                    <div class="mb-2"><p>Statut de la demande :</p> 
                        <p>En attente</p>
                        <p>Confirmée</p>
                        <p>Gratuite</p>
                    </div>

                </div>

            </div>
            {{-- Fin 1ère colonne --}}

            {{-- Début 2ème colonne --}}
            <div>
                <div class="py-6 px-4 mb-4 rounded bg-base-300/75">
                    <div class="mb-2">
                        <h3 class="mb-2">Avec : </h3>
                        <select class="select select-bordered select-primary w-full" id="user_id" name="user_id">
                            <option value="1">User 1</option>
                            <option value="2">User 2</option>
                            <option value="3">User 3</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <h3>Créer un utilisateur </h3>
                    </div>

                    <div class="mb-2">
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
