<x-app-layout>

    @section('js')
        @vite(['resources/js/add/payment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Votre rendez-vous :
        </h2>
    </x-slot>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Récapitulatif de votre demande : </h3>

                    <div class="mb-2">
                        <p>Votre demande a été enregistrée le :</p> 
                        <p>{{ $appointment->created_at }}</p>
                    </div>
                        
                    @if($appointment->appointment_type != 'writing')
                    <p>Votre rendez-vous aura lieu le :</p>
                    <p> $invoice_informations->time_slot_day_for_human à
                     $invoice_informations->time_slot_for_human </p>
                    @else
                    <p>Rappel de votre question :</p>
                    <p class="p-4">" {{ $appointment->appointment_message }} "</p>
                    @endif
                        
                </div>
            </div>
            {{-- Fin 1ère colonne --}}

            {{-- Début 2ème colonne --}}
            <div>
                <div class="py-6 px-4 mb-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Contact : </h3>
                    <div>
                    Tel :
                    {{-- @if(isset(json_decode($checkRequest)->errors->phone))
                        {{ json_decode($checkRequest)->errors->phone }}
                    @endif
                    {{ isset($userContact->phone) ? $userContact->phone : '' }} --}}
                    </div>
                    <div class="break-words">
                        Email : $user->email
                    </div>
                    
                    {{-- @if ($invoice->status == 'PENDING')
                    <div class="mt-4">
                        @php
                            $cr = json_decode($checkRequest);
                            $btnText = $cr && isset($cr->phone) ? 'Ajouter votre numéro de téléphone' : 'Modifier vos coordonnées';
                        @endphp
                        @livewire('modal-user-profile-contact-form', ['btnText' => $btnText])
                    </div>
                    @endif --}}

                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        <footer class="text-center text-xl mt-6">
            <h2 class="mb-6">Actions sur votre demande :</h2>
            <form method="POST"
                action="#">
                @csrf
                <input type="hidden" id="payment_delete_route" value="#" />
                <div class="flex flex-row flex-wrap gap-4 justify-center">
                    <button id="edit_request" class="btn btn-warning">
                        Modifier ma demande
                    </button>
                    <button id="cancel_request" class="btn btn-error">
                        Annuler ma demande
                    </button>
                   
                    <template x-if="!checkRequest.hasErrors">
                        <button class="btn btn-primary" type="submit">
                            Voir ma facture
                        </button>
                    </template>

                </div>
                
            </form>
        </footer>
    </div>




</x-app-layout>
