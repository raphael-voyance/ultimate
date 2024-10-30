<x-app-layout>

    @section('js')
        @vite(['resources/js/add/appointment.js'])
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
                        <p>{{ $ic->getInvoiceDateForHuman($appointment->updated_at) }}</p>
                    </div>

                    <div class="mb-2">
                        <p>Mode de consultation :</p> 
                        @switch($appointment->appointment_type)
                            @case('tchat')
                                <p>Par tchat</p>
                            @break
                        
                            @case('phone')
                                <p>Par téléphone</p>
                            @break

                            @case('writing')
                                <p>Par écrit</p>
                            @break
                                
                        @endswitch
                    </div>

                    <div class="mb-2"><p>Statut de votre demande :</p> 
                        @switch($appointment->status)
                            @case('CANCELLED')
                                <p>Annulé</p>
                            @break
                        
                            @case('PENDING')
                                <p>En attente</p>
                            @break

                            @case('APPROVED')
                                <p>Approuvé</p>
                            @break

                            @case('CONFIRMED')
                                <p>Confirmé</p>
                            @break

                            @case('PASSED')
                                <p>Passé</p>
                            @break
                                
                        @endswitch
                    </div>
                        
                    @if($appointment->appointment_type != 'writing')
                    <p>Votre rendez-vous aura lieu le :</p>
                    <p> {{ $appointment_informations->time_slot_day_for_human }} à
                     {{ $appointment_informations->time_slot_for_human }} </p>
                    @else
                    <p>Rappel de votre question par email :</p>
                    <p class="p-4">" {{ $appointment->appointment_message }} "</p>
                    @endif
                        
                </div>
            </div>
            {{-- Fin 1ère colonne --}}

            {{-- Début 2ème colonne --}}
            <div>
                <div class="py-6 px-4 mb-4 rounded bg-base-300/75">
                    @php
                        $userContact = json_decode($user->profile->contact);
                    @endphp
                    <h3 class="mb-2">Contact : </h3>
                    <div>
                    Tel :
                    {{ isset($userContact->phone) ? $userContact->phone : 'Merci de renseigner votre numéro de téléphone.' }}
                    </div>
                    <div class="break-words">
                        Email : {{ $user->email }}
                    </div>

                    <div class="mt-4">
                        @php
                            $btnText = !isset($userContact->phone) ? 'Ajouter votre numéro de téléphone' : 'Modifier vos coordonnées';
                        @endphp
                        @livewire('modal-user-profile-contact-form', ['btnText' => $btnText])
                    </div>
                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        <footer class="text-center text-xl mt-6">
            <h2 class="mb-6">Actions sur votre demande :</h2>

            @if($appointment->status == 'CANCELLED' || $appointment->status == 'PASSED')

                <a href="{{ route('invoice.view', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token]) }}" class="btn btn-primary hover:text-black active::text-black focus:text-black">
                    Accéder à ma facture
                </a>

            @elseif ($appointment->status == 'PENDING' || $appointment->status == 'APPROVED' || $appointment->status == 'CONFIRMED')

                <form method="POST" action="#">
                    @csrf
                    <input type="hidden" id="appoitment_delete_route" value="{{ route('my_space.appointment.delete', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token])}}" />
                    <div class="flex flex-row flex-wrap gap-4 justify-center">

                        @livewire('modal-edit-appointment', ['appointment' => $appointment])

                        <button id="cancel_request" class="btn btn-error">
                            Annuler ma demande
                        </button>
                    
                        <a href="{{ route('invoice.view', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token]) }}" class="btn btn-primary hover:text-black active::text-black focus:text-black">
                            @if($appointment->invoice->status == 'PENDING')
                                Payer ma facture
                            @else
                                Accéder à ma facture
                            @endif
                        </a>
                    </div>
                </form>

            @endif

        </footer>
    </div>




</x-app-layout>