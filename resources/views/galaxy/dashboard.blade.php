<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            <span>Tableau de bord</span>
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <x-ui.card title="Informations personnelles">
            <ul>
                <li>Nom : </li>
                <li>Prénom : </li>
                <li>Date de naissance : </li>
                <li>Numéro de téléphone : </li>
                <li>Adresse email : </li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="Modifier mes informations" href="{{ route('home') }}" />
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

        <x-ui.card title="Paiements">
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
                    <x-badge value="{{ $status }}"
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

        <x-ui.card title="Prévisions">
            <ul>
                <li>Votre chemin de vie : 9</li>
                <li>Votre année personnelle</li>
                <li>Faire un tirage de Tarot</li>
            </ul>
        </x-ui.card>

        <x-ui.card title="Articles enregistrés">
            I am using slots here.
            <x-slot:actions>
                <x-ui.link label="Voir tous les articles" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

    </div>

</x-app-layout>
