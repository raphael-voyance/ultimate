<div>

    {{ isset($userContact->address->facturation->number_of_way) ? $userContact->address->facturation->number_of_way . ', ' : '' }}

    {{ isset($userContact->address->facturation->type_of_way) ? $userContact->address->facturation->type_of_way : '' }}
    
    {{ isset($userContact->address->facturation->name_of_way) ? $userContact->address->facturation->name_of_way : '' }} <br>

    {{ isset($userContact->address->facturation->postal_code) ? $userContact->address->facturation->postal_code : '' }} 
    
    {{ isset($userContact->address->facturation->city) ? $userContact->address->facturation->city : '' }} - 
    
    {{ isset($userContact->address->facturation->country) ? $userContact->address->facturation->country : '' }}

    {{-- si il y a des produits physiques --}}
    @if($hasPhysicalsProducts)
    <br>
    Adresse de livraison :<br>
    Numéro - Voie - Nom de voie <br>
    Code postal - Ville - Pays<br>
    @endif

    @if($invoice_status == 'PENDING')
    <button class="btn btn-sm btn-accent">
        Modifier mes coordonnées
    </button>
    @endif
    
</div>
