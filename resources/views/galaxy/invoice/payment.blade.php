<x-app-layout>

    @php
        $invoice = App\Models\Invoice::where('payment_invoice_token', '60198e5b-03ee-302c-9a24-74877edd5454')->firstOrFail();

        $servicesProducts = $invoice->products->where('type', 'SERVICE_PRODUCT');

        $physicalsProducts = $invoice->products->where('type', 'PHYSICAL_PRODUCT');

        //dd($invoice->products);
        
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Page de paiement
        </h2>
    </x-slot>

        Vous : Nom - Prénom <br><br>
        Récapitulatif de votre paiement : <br>
        @if($servicesProducts->isNotEmpty())
            Service{{ $servicesProducts->count() > 1 ? 's' : '' }} demandé{{ $servicesProducts->count() > 1 ? 's' : '' }} : <br>
            @foreach ($servicesProducts as $product)
                {{ $product->name }} - -PRIX-<br>
            @endforeach

            <br>
            
            {{-- in work --}}
            @if($invoice->appointment && $invoice->appointment->session_type != 'writing' )
            Vous demandez un rendez-vous le -DATE- à -HEURE- <br><br>
            @endif
        @endif

        @if($physicalsProducts->isNotEmpty())
            Produit{{ $physicalsProducts->count() > 1 ? 's' : '' }} commandé{{ $physicalsProducts->count() > 1 ? 's' : '' }} : <br><br>
            @foreach ($physicalsProducts as $product)
                {{ $product->name }} - -PRIX-<br>
            @endforeach
        @endif
        
        <br>
        Contact : <br>
        Tel : <br>
        Email : <br>
        <br>
        Adresse de facturation :<br>
        Numéro - Voie - Nom de voie <br>
        Code postal - Ville - Pays<br>

        {{-- si il y a des produits physiques --}}
        @if($invoice->products->contains('type', 'PHYSICAL_PRODUCT'))
        <br>
        Adresse de livraison :<br>
        Numéro - Voie - Nom de voie <br>
        Code postal - Ville - Pays<br>
        @endif

        <br><br>

        Paiement :

        <br><br>

        <input id="card-holder-name" type="text">

        <!-- Stripe Elements Placeholder -->
        <div class="border-red-700 p-4" id="card-element"></div>

        <button id="card-button">
            Process Payment
        </button>

        <button>
            Annuler ma demande
        </button>

</x-app-layout>
