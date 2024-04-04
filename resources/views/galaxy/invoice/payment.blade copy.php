<x-app-layout>


    <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
        Payer ma consultation par carte bancaire

                        <input id="card-holder-name" type="text">

                        <!-- Stripe Elements Placeholder -->
                        <div class="border-red-700 p-4" id="card-element"></div>

                        <button id="card-button">
                            Process Payment
                        </button>

                        {{-- @if ($appointmentType != "writing") --}}
                            Vous souhaitez régler votre séance plus tard ?
                            Votre demande de rendez-vous sera enregistrée mais non validée.
                            Pour confirmer celle-ci vous devrez vous acquiter du montant de la consultation avant sa réalisation.
                            <button>Payer plus tard</button>
                        {{-- @endif --}}
    </div>

    <h4 class="mb-4">6 - Confirmation de votre demande</h4>

                    @if ($appointmentType != 'writing')
                        Super votre rendez-vous a été programmé le DATE de DEBUT à environ FIN pour une séance de
                        voyance par MODE avec Raphaël.

                        Pour suivre, modifer ou annuler votre demande de rendez-vous, allez dans votre espace
                        "Consultant" rubrique "Mes rendez-vous".
                    @else
                        Super votre demande de consultation écrite a été transmise avec succés.

                        Raphaël Vous répondra dans les meilleurs délais. Comptez en moyenne 3 à 4 jours.

                        Pour suivre votre demande de consultation écrite, allez dans votre espace "Consultant" rubrique
                        "Mes consultations écrites".
                    @endif

                    @auth
                        @if ($appointmentType)
                            <x-ui.primary-button class="btn-sm btn-outline mt-4 float-right"
                                @click="$wire.resetModal()">Fermer</x-ui.primary-button>
                        @endif
                    @endauth

    @section('js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.addEventListener('load-stripe-form', function() {
            console.log('salut');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
        });

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                // The card has been verified successfully...
            }
        });
    </script>
    @endsection

</x-app-layout>
