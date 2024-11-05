<x-app-layout>

    @section('js')
        @vite(['resources/js/add/payment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            @if ($invoice_informations->type != 'writing')
            Votre facture pour votre consultation du {{ $invoice_informations->time_slot_day_for_human }} :
            @else
            Votre facture pour votre consultation par écrit :
            @endif
            
        </h2>
    </x-slot>

    <div x-data="{
        checkRequest: {{ $checkRequest }}
    }">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Récapitulatif de votre demande : </h3>

                    @if ($servicesProducts->isNotEmpty())
                    <div class="mb-2">
                        @if ($servicesProducts->count() > 1)
                            <p>Votre demande concerne plusieurs services :</p>
                            <ul>
                                @foreach ($servicesProducts as $product)
                                    <li>{{ $product->name }} - {{ $ic->setAmountPriceForHuman($product->price) }}</li>
                                @endforeach
                            </ul>
                        @else
                        <p>Service demandé :</p>
                        @foreach ($servicesProducts as $product)
                            <p>{{ $product->name }}</p>
                            <p>Tarif : {{ $ic->setAmountPriceForHuman($product->price) }}</p>
                        @endforeach
                        
                        @endif
                    </div>

                    <div class="mb-2">
                        <p>Votre demande a été enregistrée le :</p> 
                        <p>{{ $ic->getInvoiceDateForHuman($invoice->updated_at) }}</p>
                    </div>

                    <div class="mb-2">
                        <p>Statut de votre facture :</p> 
                        <p>
                        @switch($invoice->status)
                            @case('REFUNDED')
                                Remboursée
                            @break
                            @case('FREE')
                                Gratuite
                            @break
                            @case('PAID')
                                Payée
                            @break
                            @case('PENDING')
                                En attente de paiement
                            @break
                            @case('CANCELLED')
                                Annulée
                            @break
                        @endswitch
                        </p>
                    </div>

                        @if ($invoice_informations->type != 'writing' && $invoice->status == 'PAID' || $invoice->status == 'FREE' || $invoice->status == 'PENDING')
                            @if(!$appointmentPassed)
                            <p>Votre rendez-vous aura lieu le :</p>
                            @else
                            <p>Votre rendez-vous a eu lieu le :</p>
                            @endif
                            <p>{{ $invoice_informations->time_slot_day_for_human }} à
                            {{ $invoice_informations->time_slot_for_human }}</p>
                        @endif

                        @if ($invoice_informations->type == 'writing')
                            <p>Rappel de votre question :</p>
                            <p class="p-4">"{{ $invoice_informations->writing_consultation->question }}"</p>
                        @endif

                    @endif

                    @if ($physicalsProducts->isNotEmpty())
                        Produit{{ $physicalsProducts->count() > 1 ? 's' : '' }}
                        commandé{{ $physicalsProducts->count() > 1 ? 's' : '' }} : <br><br>
                        @foreach ($physicalsProducts as $product)
                            {{ $product->name }} - {{ $product->price }}<br>
                        @endforeach
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
                    @if(isset(json_decode($checkRequest)->errors->phone))
                        {{ json_decode($checkRequest)->errors->phone }}
                    @endif
                    {{ isset($userContact->phone) ? $userContact->phone : '' }}
                    </div>
                    <div class="break-words">
                        Email : {{ $user->email }}
                    </div>
                    
                    @if ($invoice->status == 'PENDING')
                    
                    <div class="mt-4">
                        @php
                            $btnText = !isset($userContact->phone) ? 'Ajouter votre numéro de téléphone' : 'Modifier vos coordonnées';
                        @endphp
                        @livewire('modal-user-profile-contact-form', ['btnText' => $btnText])
                    </div>
                    @endif

                </div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Adresse de facturation : </h3>

                    @livewire('get-user-place', ['user' => $user, 'userContact' => $userContact, 'hasPhysicalsProducts' => $hasPhysicalsProducts, 'invoice_status' => $invoice->status, 'checkRequest' => $checkRequest])
                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        @if ($invoice->status == 'PENDING')
            @if (json_decode($checkRequest)->hasErrors == true)
                <div class="alert mb-4">
                    <div>
                        <p>
                            Pour pouvoir régler votre facture et confirmer votre demande de consultation vous devez saisir toutes les informations requises :
                        </p>
                        <ul class="list-disc list-inside pt-2">
                            <template x-for="e in checkRequest.errors">
                                <li x-text="e"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            @endif
        @endif

        <footer class="text-center text-xl mt-6">
            @if (($invoice->status == 'PENDING' || $invoice->status == 'FREE' || $invoice->status == 'PAID' || $invoice->status == 'REFUNDED') && !$appointmentPassed)
                <h2 class="mb-6">Actions sur votre demande :</h2>
            @endif
            
            @if(!$appointmentPassed)
            <form method="POST"
                action="{{ route('payment.store', ['payment_invoice_token' => $invoice->payment_invoice_token]) }}">
                @csrf
                <input type="hidden" id="payment_delete_route" value="{{ route('payment.delete', ['payment_invoice_token' => $invoice->payment_invoice_token ]) }}" />
                <div class="flex flex-row flex-wrap gap-4 justify-center">
                    
                    @if ($invoice->status == 'PENDING' || $invoice->status == 'FREE' || $invoice->status == 'PAID')
                    @livewire('modal-edit-appointment', ['appointment' => $invoice->appointment])
                    <button type="button" id="cancel_request" class="btn btn-error">
                        Annuler ma demande
                    </button>
                    @endif

                    @if ($invoice->status == 'PAID' || $invoice->status == 'REFUNDED')
                    <button id="download_invoice" data-invoice-ref="{{ $invoice->ref }}" type="button" class="btn btn-accent">
                        Télécharger ma facture
                    </button>
                    @endif
    
                    @if ($invoice->status == 'PENDING')
                    <template x-if="!checkRequest.hasErrors">
                        <button class="btn btn-primary" type="submit">
                            Payer ma facture
                        </button>
                    </template>
                    @endif

                </div>
                
            </form>
            @else
                @if ($invoice->status == 'PAID' || $invoice->status == 'REFUNDED')
                <button id="download_invoice" data-invoice-ref="{{ $invoice->ref }}" type="button" class="btn btn-accent">
                    Télécharger ma facture
                </button>
                @endif
            @endif
        </footer>
    </div>




</x-app-layout>
