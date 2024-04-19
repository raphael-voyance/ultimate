<div x-data="{
    checkRequest: {{ $checkRequest }}
}">
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
        @elseif(json_decode($checkRequest)->errors->facturation_address)
            {{ json_decode($checkRequest)->errors->facturation_address }}
        @endif
    
    {{-- si il y a des produits physiques --}}
    @if($hasPhysicalsProducts)
    <br>
    Adresse de livraison :<br>
    Numéro - Voie - Nom de voie <br>
    Code postal - Ville - Pays<br>
    @endif

    @if ($invoice_status == 'PENDING')
    <div class="mt-4">
        @php
            $cr = json_decode($checkRequest);
            $btnText = $cr && isset($cr->facturation_address) ? 'Ajouter votre adresse de facturation' : 'Modifier  votre adresse de facturation';
        @endphp
        @livewire('modal-user-profile-address-form', ['btnText' => $btnText])
    </div>
    @endif
    
</div>
