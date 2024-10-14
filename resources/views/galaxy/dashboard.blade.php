<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->fullName() }} </span>
            <span>Tableau de bord</span>
        </h2>
    </x-slot>

    <div class="mb-8 py-4 px-6 bg-base-300">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Informations personnelles --}}
            <x-ui.card title="Informations personnelles">
                <ul>
                    <li>Nom : {{ Auth::user()->last_name }}</li>
                    <li>Prénom : {{ Auth::user()->first_name }}</li>
                    <li>Adresse email : {{ Auth::user()->email }}</li>
                    @if(Auth::user()->getPhone())
                    <li>Numéro de téléphone : {{ Auth::user()->getPhone() }}</li>
                    @endif
                    @if(Auth::user()->birthday())
                    <li>Date de naissance : {{ Auth::user()->birthday() }}</li>
                    @endif
                </ul>

                <x-slot:actions>
                    <x-ui.link label="Modifier mes informations" href="{{ route('my_space.profile.edit') }}" />
                </x-slot:actions>

            </x-ui.card>

            {{-- Dernières consultations --}}
            <x-ui.card title="Dernières consultations">
                <ul>
                    <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="08/05/2024" href="#" /> par téléphone</li>
                    <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="14/04/2024" href="#" /> par tchat</li>
                    <li><i class="fa-thin fa-pen-nib mr-2"></i> répondu le <x-ui.link label="19/03/2024" href="#" /> par écrit</li>
                </ul>

                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations passées" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            {{-- Consultations à venir --}}
            <x-ui.card title="Consultations à venir">
                <ul>
                    <li><i class="fa-thin fa-pen-nib mr-2"></i> demandée le <x-ui.link label="08/09/2024" href="#" /> par écrit</li>
                    <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="14/09/2024" href="#" /> par tchat</li>
                    <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="19/09/2024" href="#" /> par téléphone</li>
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations à venir" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            {{-- Facturation --}}
            @if($invoices->count() >= 1)
            <x-ui.card title="Paiements & facturations">
                <ul>
                    @foreach ($invoices as $invoice)
                    <li class="flex flex-row justify-between gap-2">
                        <a href="{{ route('invoice.view', $invoice->payment_invoice_token) }}">{{ Str::limit($invoice->ref, 13) }}</a>
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
                            'min-w-[90px]',
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

            {{-- Prévisions --}}
            <x-ui.card title="Prévisions">
            
                <ul>
                    @if(!$numerology)
                    <li>Pour calculer votre chemin de vie merci de renseigner votre date de naissance depuis la page des prévisions. Pour cela cliquer sur "En découvrir plus".</li>
                    @else
                    <li>Votre date de naissance : {{ $numerology->birthdate }}</li>
                    <li>Votre chemin de vie : {{ $numerology->lifePath }}</li>
                    <li>Votre année personnelle : {{ $numerology->annualPath }}</li>
                    @endif
                </ul>
                <x-slot:actions>
                    <x-ui.link label="En découvrir plus" href="{{ route('my_space.previsions') }}" />
                </x-slot:actions>
            </x-ui.card>

            {{-- Tarot --}}
            <x-ui.card title="Tirage de Tarot">
            
                <ul>
                    @if ($draws->count() > 0)
                        @foreach ($draws as $draw)
                            <li><a href="{{ route('tarot.get-draw-cards', $draw->id) }}">{{ $draw->created_at->format('d/m/Y') }}</a></li>
                        @endforeach
                        <li><a href="{{ route('tarot.draw-cards-index') }}">Voir tous vos tirages enregistrés</a></li>
                    @endif
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Faire un tirage de Tarot" href="{{ route('tarot.index') }}" />
                </x-slot:actions>
            </x-ui.card>
    
            {{-- Articles enregistrés --}}
            <x-ui.card title="Articles enregistrés">
                I am using slots here.
                <x-slot:actions>
                    <x-ui.link label="Voir tous les articles" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

        </div>
    </div>


</x-app-layout>
