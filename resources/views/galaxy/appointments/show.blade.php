<x-app-layout>

    @section('js')
        @vite(['resources/js/add/appointment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            @if($appointment->appointment_type != 'writing')
            Votre rendez-vous :
            @else
            Votre demande de consultation par écrit :
            @endif
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
                                <p>Annulée</p>
                            @break
                        
                            @case('PENDING')
                                <p>En attente
                                    <span class="text-slate-300 text-xs italic">(Facture en attente de paiement)</span>
                                </p>
                            @break

                            @case('REPLY')
                                <p>Répondue le : {{ \Carbon\Carbon::parse($appointment->request_response_date)->translatedFormat('l d F Y') }}</p>
                            @break

                            @case('CONFIRMED')
                                <p>Validée
                                    @if($appointment->appointment_type != 'writing')
                                    <span class="text-slate-300 text-xs italic">(En attente de confirmation par Raphaël)</span>
                                    @else
                                    <span class="text-slate-300 text-xs italic">(En attente de réponse par Raphaël)</span>
                                    @endif
                                </p>
                            @break

                            @case('APPROVED')
                                <p>Confirmée</p>
                            @break

                            @case('PASSED')
                                <p>Passée</p>
                            @break
                                
                        @endswitch
                    </div>
                        
                    @if($appointment->appointment_type != 'writing')
                        <p>Votre rendez-vous aura lieu le :</p>
                        <p> {{ $appointment_informations->time_slot_day_for_human }} à
                        {{ $appointment_informations->time_slot_for_human }} </p>
                    @else
                        @if(($appointment->invoice->status == 'PAID' || $appointment->invoice->status == 'FREE') && $appointment->status != 'REPLY')
                            <p>Date de réponse estimée :</p>
                            <p class="mb-2">{{ \Carbon\Carbon::parse($appointment->updated_at)->add('3days')->translatedFormat('l d F Y') }}</p>
                        @endif
                        <p>Rappel de votre question par email :</p>
                        <p class="p-4">" {!! nl2br(e($appointment->appointment_message)) !!} "</p>
                        @if(isset($appointment->request_reply))
                            <p>Réponse de Raphaël :</p>
                            <p class="p-4">" {!! nl2br(e($appointment->request_reply)) !!} "</p>
                        @endif
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

            @if($appointment->status == 'REFUNDED' || $appointment->status == 'PASSED')

                <a href="{{ route('invoice.view', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token]) }}" class="btn btn-primary hover:text-black active::text-black focus:text-black">
                    Accéder à ma facture
                </a>

            @elseif ($appointment->status == 'PENDING' || $appointment->status == 'APPROVED' || $appointment->status == 'CONFIRMED' || $appointment->status == 'REPLY')

                <form method="POST" action="#">
                    @csrf
                    <input type="hidden" id="appointment_delete_route" value="{{ route('my_space.appointment.delete', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token])}}" />
                    <div class="flex flex-row flex-wrap gap-4 justify-center">
 
                        @if(($appointment->appointment_type != 'writing' || $appointment->status != 'REPLY') && $appointment->status != 'PASSED')
                            @livewire('modal-edit-appointment', ['appointment' => $appointment])
                        @endif
                        
                        <a href="{{ route('invoice.view', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token]) }}" class="btn btn-info hover:text-black active::text-black focus:text-black">
                                Accéder à ma facture
                        </a>
                    </div>
                </form>

            @endif

            @if($appointment->status == 'PENDING' || $appointment->status == 'APPROVED' || $appointment->status == 'CONFIRMED')
                <button type="button" id="cancel_request" class="btn btn-error mt-4">
                    Annuler ma demande
                </button>
            @endif

        </footer>
    </div>




</x-app-layout>
