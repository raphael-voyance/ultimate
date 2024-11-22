<x-app-layout>

    @section('js')
        @vite(['resources/js/add/universe/appointment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            @if($appointment->appointment_type != 'writing')
            Rendez-vous du {{ $appointment_informations->time_slot_day_for_human }} à {{ $appointment_informations->time_slot_for_human }} </br>
            avec <a class="italic" target="_blank" href="{{ route('admin.users.show', $user->id) }}">{{ $user->fullName() }}</a>
            @else
            Demande de consultation par écrit </br>
            pour <a class="italic" target="_blank" href="{{ route('admin.users.show', $user->id) }}">{{ $user->fullName() }}</a>
            @endif
        </h2>
    </x-slot>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Récapitulatif de la demande : </h3>

                    <div class="mb-2">
                        <p>Demande enregistrée le :</p> 
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

                    <div class="mb-2"><p>Statut de la demande :</p> 
                        @switch($appointment->status)
                            @case('CANCELLED')
                                <p>Annulée</p>
                            @break

                            @case('REPLY')
                                <p>Répondue le : {{ \Carbon\Carbon::parse($appointment->request_response_date)->translatedFormat('l d F Y') }}</p>
                            @break
                        
                            @case('PENDING')
                                <p>En attente
                                    <span class="text-slate-300 text-xs italic">(Facture en attente de paiement)</span>
                                </p>
                            @break

                            @case('CONFIRMED')
                                <p>Validée
                                    @if($appointment->appointment_type != 'writing')
                                    <span class="text-slate-300 text-xs italic">(En attente de confirmation)</span>
                                    @else
                                    <span class="text-slate-300 text-xs italic">(En attente de réponse)</span>
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
                    <p>Le rendez-vous doit avoir lieu le :</p>
                    <p> {{ $appointment_informations->time_slot_day_for_human }} à
                     {{ $appointment_informations->time_slot_for_human }} </p>
                    @else
                        @if(($appointment->invoice->status == 'PAID' || $appointment->invoice->status == 'FREE') && $appointment->status != 'REPLY')
                        <p>Réponse attendue le :</p>
                        <p class="mb-2">{{ \Carbon\Carbon::parse($appointment->updated_at)->add('3days')->translatedFormat('l d F Y') }}</p>
                        @endif
                    <p>Question :</p>
                    <p class="p-4">" {!! nl2br(e($appointment->appointment_message)) !!} "</p>
                        @if(isset($appointment->request_reply))
                                <p>Réponse :</p>
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
                    Numéro de téléphone du consultant :
                    {{ isset($userContact->phone) ? $userContact->phone : 'Aucun numéro de téléphone n\'est renseigné sur le profil du consultant.' }}
                    </div>
                    <div class="break-words">
                        Email du consultant : {{ $user->email }}
                    </div>
                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        <footer class="text-center text-xl mt-6">
            <h2 class="mb-6">Actions sur la demande :</h2>

            @if($appointment->invoice->status != 'CANCELLED')
            <form method="POST" action="#">
                @csrf
                <input type="hidden" id="appointment_delete_route" value="{{ route('admin.appointments.delete', ['payment_invoice_token' => $appointment->invoice->payment_invoice_token])}}" />
                <div class="flex flex-row flex-wrap gap-4 justify-center">

                    @if(($appointment->appointment_type != 'writing' || $appointment->status != 'REPLY') && $appointment->status != 'PASSED')
                        @livewire('admin.modal-edit-appointment', ['appointment' => $appointment, 'name' => $user->fullName()])
                    
                    <button type="button" id="cancel_request" class="btn btn-error">
                        Annuler la demande
                    </button>
                    @endif
                    
                    @if ($appointment->invoice->status == 'PAID' && $appointment->appointment_type != 'writing')
                        <input type="hidden" id="approved_route" value="{{ route('admin.appointments.approved', $appointment->id) }}" />
                        <button type="button" id="confirm_request" class="btn btn-success">
                            Confirmer le rendez-vous
                        </button>
                    @endif
                
                    <a href="{{ route('admin.invoices.show', $appointment->invoice->id) }}" class="btn btn-info hover:text-black active:text-black focus:text-black">
                            Accéder à la facture
                    </a>
                </div>
            </form>
            @endif

        </footer>
    </div>




</x-app-layout>
