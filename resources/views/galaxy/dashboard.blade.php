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
            <x-ui.card title="Vos dernières consultations">
                @if (count($pastsAppointments) >= 1)
                <ul>
                    @foreach ($pastsAppointments as $appointment)
                        <li><i @class([
                            'fa-thin mr-2',
                            'fa-phone' => $appointment['type'] == 'phone',
                            'fa-sharp fa-comments' => $appointment['type'] == 'tchat',
                            'fa-thin fa-pen-nib' => $appointment['type'] == 'writing'])></i> 

                            @if($appointment['type'] == 'writing')
                                demandée le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par écrit
                            @elseif ($appointment['type'] == 'tchat')
                                le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par tchat
                            @else
                                le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par téléphone
                            @endif
                        </li>
                    @endforeach
                </ul>

                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations passées" href="{{ route('home') }}" />
                </x-slot:actions>
                @else
                <p class="text-white/65 italic">Aucune consultation n'est enregistrée sur votre profil.</p>
                @endif
            </x-ui.card>

            {{-- Consultations à venir --}}
            <x-ui.card title="Vos consultations à venir">
                @if (count($futursAppointments) >= 1)
                <ul>
                    @foreach($futursAppointments as $appointment)
                    <li><i @class([
                        'fa-thin mr-2',
                        'fa-phone' => $appointment['type'] == 'phone',
                        'fa-sharp fa-comments' => $appointment['type'] == 'tchat',
                        'fa-thin fa-pen-nib' => $appointment['type'] == 'writing'])></i> 

                        @if($appointment['type'] == 'writing')
                            demandée le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par écrit
                        @elseif ($appointment['type'] == 'tchat')
                            le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par tchat
                        @else
                            le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" /> par téléphone
                        @endif
                    </li>
                    @endforeach
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations programmées" href="{{ route('home') }}" />
                </x-slot:actions>
                @else
                <p class="text-white/65 italic">Vous n'avez pas de consultation programmée.</p>
                @endif
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
                    @forelse ($draws as $draw)
                    @php
                        $jsonString = html_entity_decode(json_decode($draw->draw));
                        $drawDatas = json_decode($jsonString);
                    @endphp
                        <li><a class="inline-flex items-center gap-2 px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out" href="{{ route('tarot.get-draw-cards', $draw->id) }}"><i class="fa-thin fa-thin fa-cards" aria-hidden="true"></i> {{ $drawDatas->name }} du {{ $draw->created_at->format('d/m/Y') }}</a></li>
                    @empty
                        <li>Vous n'avez pas encore de tirages enregistrés.</li>
                    @endforelse
                    @if($drawsCount > 5)
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
