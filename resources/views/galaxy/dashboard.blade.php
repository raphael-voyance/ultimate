<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->fullName() }} </span>
            <span>Tableau de bord</span>
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <x-ui.card title="Informations personnelles">
            <ul>
                <li>Nom : {{ Auth::user()->last_name }}</li>
                <li>Prénom : {{ Auth::user()->first_name }}</li>
                <li>Adresse email : {{ Auth::user()->email }}</li>
                @if(Auth::user()->phone())
                <li>Numéro de téléphone : {{ Auth::user()->phone() }}</li>
                @endif
                @if(Auth::user()->birthday())
                <li>Date de naissance : {{ Auth::user()->birthday() }}</li>
                @endif
            </ul>
            <x-slot:actions>
                <x-ui.link label="Modifier mes informations" href="{{ route('my_space.profile.edit') }}" />
            </x-slot:actions>
        </x-ui.card>

        <x-ui.card title="Vos rendez-vous">
            <div class="text-xl font-bold">
                Séances passées :
            </div>
            <ul>
                <li>le : 18/05/2023</li>
                <li>le : 08/03/2023</li>
                <li>le : 02/12/2022</li>
            </ul>

            <div class="text-xl font-bold">
                Séances à venir :
            </div>
            <ul>
                <li>le : 27/10/2023</li>
                <li>le : 30/12/2023</li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="Voir toutes les séances" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

        @if($invoices->count() >= 1)
        <x-ui.card title="Paiements & facturations">
            <ul>
                @foreach ($invoices as $invoice)
                <li class="flex flex-row justify-between">
                    <a href="{{ route('invoice.view', $invoice->payment_invoice_token) }}">{{ Str::limit($invoice->ref, 15) }}</a>
                    @php
                        $status = '';
                        if($invoice->status == 'PENDING') {
                            $status = 'En attente';
                        }elseif ($invoice->status == 'PAID') {
                            $status = 'Payé';
                        }elseif ($invoice->status == 'REFUNDED') {
                            $status = 'Remboursé';
                        }elseif ($invoice->status == 'CANCELLED') {
                            $status = 'Annulé';
                        }elseif ($invoice->status == 'FREE') {
                            $status = 'Gratuit';
                        }
                    @endphp
                    <x-mary-badge value="{{ $status }}"
                    @class([
                        'badge-success' => $invoice->status == 'PAID',
                        'badge-warning' => $invoice->status == 'PENDING',
                        'badge-secondary' => $invoice->status == 'REFUNDED',
                        'badge-error' => $invoice->status == 'CANCELLED',
                        'badge-primary' => $invoice->status == 'FREE']) 
                        />
                </li>    
                @endforeach
                
            </ul>
            <x-slot:actions>
                <x-ui.link label="Voir tous les paiements" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>
        @endif

        <x-ui.card title="Prévisions">
            

            

            
            <ul>
                @if(!$numerology)
                <li>Pour calculer votre chemin de vie merci de renseigner votre date de naissance depuis la page des prévisions. Pour cela cliquer sur "En découvrir plus".</li>
                @else
                <li>Votre date de naissance : {{ $numerology->birthdate }}</li>
                <li>Votre chemin de vie : {{ $numerology->lifePath }}</li>
                <li>Votre année personnelle : {{ $numerology->annualPath }}</li>
                @endif
                <li><a href="{{ route('my_space.previsions') }}">Faire un tirage de Tarot</a></li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="En découvrir plus" href="{{ route('my_space.previsions') }}" />
            </x-slot:actions>
        </x-ui.card>

        <x-ui.card title="Articles enregistrés">
            I am using slots here.
            <x-slot:actions>
                <x-ui.link label="Voir tous les articles" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

    </div>

</x-app-layout>
