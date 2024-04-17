<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Page de paiement
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4 mb-4">
        {{-- Début 1ère colonne --}}
        <div>

            <div>
                <h4>Récapitulatif de votre demande : </h4>

                @if($servicesProducts->isNotEmpty())
                    @foreach ($servicesProducts as $product)
                        {{ $product->name }} - {{ $ic->setAmountPriceForHuman($product->price) }}<br>
                    @endforeach

                    @if($invoice_informations->type != 'writing')
                        
                        Date : le {{ $invoice_informations->time_slot_day_for_human }} à {{ $invoice_informations->time_slot_for_human }}
                        
                    @else
                        Votre question : <br>
                        "{{ $invoice_informations->writing_consultation->question }}"
                    @endif
                    <br><br>
                @endif

                @if($physicalsProducts->isNotEmpty())
                    Produit{{ $physicalsProducts->count() > 1 ? 's' : '' }} commandé{{ $physicalsProducts->count() > 1 ? 's' : '' }} : <br><br>
                    @foreach ($physicalsProducts as $product)
                        {{ $product->name }} - {{ $product->price }}<br>
                    @endforeach
                @endif
            </div>

            <div>
                <h3>Contact : </h3>
                Prénom et nom : {{ $user->fullName() }} <br>
                Tel : {{ isset($userContact->phone) ? $userContact->phone : 'Merci d\'ajouter un numéro de téléphone' }} <br>
                Email : {{ $user->email }} <br>
                @if($invoice->status == 'PENDING')
                <button class="btn btn-sm btn-accent">
                    Modifier les coordonnées
                </button>
                @endif
            </div>
        </div>
        {{-- Fin 1ère colonne --}}

        {{-- Début 2ème colonne --}}
        <div>
            <h3>Adresse de facturation : </h3>

            @livewire('get-user-place', ['user' => $user, 'userContact' => $userContact, 'hasPhysicalsProducts' => $hasPhysicalsProducts, 'invoice_status' => $invoice->status])
        </div>
        {{-- Fin 2ème colonne --}}
    </div>

    @if($invoice->status == 'PENDING')
    <div>
        Paiement :

        <form action="{{ route('payment.store', ['payment_invoice_token' => $invoice->payment_invoice_token]) }}" method="POST">
            @method('POST')
            @csrf
            {{-- <input name="invoice_token" id="invoice_token" value="{{ $invoice->payment_invoice_token }}" type="hidden"> --}}
            <input id="card-holder-name" type="text">
            <div class="border-red-700 p-4" id="card-element"></div>
            <button id="card-button">
                Process Payment
            </button>
        </form>


        <div>
            <ul>
                <li>4242 4242 4242 4242</li>
                <li>01 25</li>
                <li>777</li>
                <li>66000</li>
            </ul>
        </div>
        

        <button>
            Annuler la demande
        </button>
    </div>
    @endif

    <script src="https://js.stripe.com/v3/"></script>
 
<script>
    const stripe = Stripe('pk_test_y41D2aUBeaP75Yo2vgVzXK6v');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');
    
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
    
        if (error) {
            console.log(error)
        } else {
            // Axios Post Payment
            console.log(paymentMethod)
        }
    });
</script>

</x-app-layout>
