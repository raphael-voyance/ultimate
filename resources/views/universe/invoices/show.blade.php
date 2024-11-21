<x-app-layout>

    @section('js')
        @vite(['resources/js/add/payment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Facture n° {{ $invoice->ref }}
        </h2>
    </x-slot>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            {{-- Début 1ère colonne --}}
            <div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Récapitulatif de la demande : </h3>

                    <div class="mb-2">
                        <p>Client :</p>
                        <p><a class="italic" target="_blank" href="{{ route('admin.users.show', $user->id) }}">{{ $user->fullName() }}</a></p>
                    </div>
                    @if ($servicesProducts->isNotEmpty())
                    <div class="mb-2">
                        @if ($servicesProducts->count() > 1)
                            <p>La demande concerne plusieurs services :</p>
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
                        <p>La demande a été enregistrée le :</p> 
                        <p>{{ $ic->getInvoiceDateForHuman($invoice->updated_at) }}</p>
                    </div>

                    <div class="mb-2">
                        <p>Statut de la facture :</p> 
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

                        @if ($invoice_informations->type != 'writing' && ($invoice->status == 'PAID' || $invoice->status == 'FREE' || $invoice->status == 'PENDING'))
                            @if(!$appointmentPassed)
                            <p>Le rendez-vous aura lieu le :</p>
                            @else
                            <p>Le rendez-vous a eu lieu le :</p>
                            @endif
                            <p>{{ $invoice_informations->time_slot_day_for_human }} à
                            {{ $invoice_informations->time_slot_for_human }}</p>
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
                    Numéro de téléphone du client : {{ isset($userContact->phone) ? $userContact->phone : 'Aucun numéro de téléphone enregistré dans le profil du client.' }}
                    </div>
                    <div class="break-words">
                    Adresse email du client : {{ $user->email }}
                    </div>
                </div>

                <div class="py-6 px-4 rounded bg-base-300/75">
                    <h3 class="mb-2">Adresse de facturation : </h3>
                    <div>
                        @if (isset($userContact->address->facturation))
                            <p>{{ $user->fullName() }}</p>
                            <p>
                                {{ isset($userContact->address->facturation->number_of_way) ? $userContact->address->facturation->number_of_way . ', ' : '' }}
                    
                                {{ isset($userContact->address->facturation->type_of_way) ? $userContact->address->facturation->type_of_way : '' }}
                                
                                {{ isset($userContact->address->facturation->name_of_way) ? $userContact->address->facturation->name_of_way : '' }}
                            </p>
                    
                            <p>
                                {{ isset($userContact->address->facturation->postal_code) ? $userContact->address->facturation->postal_code : '' }} 
                        
                                {{ isset($userContact->address->facturation->city) ? $userContact->address->facturation->city : '' }} - 
                                
                                {{ isset($userContact->address->facturation->country) ? $userContact->address->facturation->country : '' }}
                            </p>
                            
                            @else
                                <p>Aucune adresse de facturation enregistrée dans le profil du client.</p>
                            @endif
                        
                        {{-- si il y a des produits physiques --}}
                        @if($hasPhysicalsProducts)
                        <br>
                        Adresse de livraison :<br>
                        Numéro - Voie - Nom de voie <br>
                        Code postal - Ville - Pays<br>
                        @endif
                        
                    </div>
                </div>
                
            </div>
            {{-- Fin 2ème colonne --}}
        </div>

        <footer class="text-center text-xl mt-6">
            <h2 class="mb-6">Actions sur la demande :</h2>
            
            <form method="POST"
                action="{{ route('payment.store', ['payment_invoice_token' => $invoice->payment_invoice_token]) }}">
                @csrf
                <input type="hidden" id="payment_delete_route" value="{{ route('payment.delete', ['payment_invoice_token' => $invoice->payment_invoice_token ]) }}" />
                <div class="flex flex-row flex-wrap gap-4 justify-center">
                    
                    @if ($invoice->status == 'PENDING' || $invoice->status == 'FREE' || $invoice->status == 'PAID')
                    @livewire('admin.modal-edit-appointment', ['appointment' => $invoice->appointment, 'name' => $user->fullName()])
                    <button type="button" id="cancel_request" class="btn btn-error">
                        Annuler la demande
                    </button>
                    @endif

                    @if ($invoice->status == 'PAID' || $invoice->status == 'REFUNDED')
                    <button id="download_invoice" data-invoice-ref="{{ $invoice->ref }}" type="button" class="btn btn-accent">
                        Télécharger la facture
                    </button>
                    @endif
    
                    @if ($invoice->status == 'PAID')
                        <button class="btn btn-primary" type="submit">
                            Rembourser la facture
                        </button>
                    @endif

                    @if (($invoice->status != 'REFUNDED' || $invoice->status != 'FREE') || ($invoice->status == 'PAID' || $invoice->status == 'PENDING'))
                        <button class="btn btn-success" type="button">
                            Mettre la facture en statut "Gratuit"
                        </button>
                    @endif

                </div>
                
            </form>
        </footer>
    </div>




</x-app-layout>
