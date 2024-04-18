<x-app-layout>

    @section('js')
        @vite(['resources/js/add/payment.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Page de paiement
        </h2>
    </x-slot>

    <div x-data="{
        checkRequest: {{ $checkRequest }}
    }">
        <div class="grid grid-cols-2 gap-4 mb-4">

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
                        <p>{{ $ic->getInvoiceDateForHuman($invoice->created_at) }}</p>
                    </div>
                        

                        @if ($invoice_informations->type != 'writing')
                            <p>Votre rendez-vous aura lieu le :</p>
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
                    @if(json_decode($checkRequest)->errors->phone)
                        {{ json_decode($checkRequest)->errors->phone }}
                    @endif
                    </div>
                    <div>
                        Email : {{ $user->email }}
                    </div>
                    
                    @if ($invoice->status == 'PENDING')
                    <div class="mt-4">
                        <button x-text="checkRequest.errors.phone ? 'Ajouter un numéro de téléphone' : 'Modifier vos coordonnées'" class="btn btn-sm btn-accent"></button>
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
            {{-- @if ($checkRequest['hasErrors'] == true)
         @foreach ($checkRequest['errors'] as $e)

         {{$e}}
             
         @endforeach
        @endif --}}

            <form method="POST"
                action="{{ route('payment.store', ['payment_invoice_token' => $invoice->payment_invoice_token]) }}">
                @csrf
                <div class="flex flex-row gap-4 justify-end">
                    <button class="btn btn-error">
                        Annuler ma demande
                    </button>
                    <template x-if="!checkRequest.hasErrors">
                        <button class="btn btn-primary" type="submit">
                            Payer ma facture
                        </button>
                    </template>
                </div>
                
            </form>
    </div>
    @endif
    </div>




</x-app-layout>
