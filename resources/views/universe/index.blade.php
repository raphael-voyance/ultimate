<x-admin-layout>

    @section(('js'))
        @vite("resources/js/add/universe/backups.js")
        @vite("resources/js/add/universe/files.js")
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->fullName() }} </span>
            <span>Tableau d'administration</span>
        </h2>
    </x-slot>

    {{-- Paramètres --}}
    <div class="mb-8 py-4 px-6 bg-base-300">
        <h2 class="mb-4">Gestion du site</h2>
        {{-- {{dump($users)}} --}}
        <div id="element-save-backup-container" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.card title="Sauvegarde du site">
                <button id="btn-save-backup" class="btn btn-circle"><i class="fa-thin fa-floppy-disk fa-xl"></i></button>
                <x-slot:actions>
                <x-ui.link label="Voir toutes les sauvegardes" href="{{ route('admin.list-backups') }}" />
            </x-slot:actions>
            </x-ui.card>

            <x-ui.card title="Utilisateurs">
                
                <div class="font-bold">
                    Derniers utilisateurs inscrits :
                </div>
                <ul>
                    @foreach ($users as $user)
                        <li><x-ui.link label="{{ $user->fullName() }}" href="{{ route('admin.users.show', $user->id)}}" /></li>
                    @endforeach
                </ul>
    
                <x-slot:actions>
                    <x-ui.link label="Voir tous les utilisateurs" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

        </div>
    </div>

    {{-- Relatif aux consultations --}}
    <div class="mb-8 py-4 px-6 bg-base-300">
        <h2 class="mb-4">Gestion des consultations</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            @if($futursAppointments->count() > 0)
            <x-ui.card title="Consultations à venir">
                <ul>
                    @foreach ($futursAppointments as $appointment)
                        @if($appointment['type'] == 'writing')
                        {{-- {{dd($appointment)}} --}}
                            <li><i class="fa-thin fa-pen-nib mr-2"></i>{{ $appointment['status'] == 'CONFIRMED' ? 'confirmée le' : 'envoyée le' }} <x-ui.link label="{{ $appointment['day'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> par <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" /></li>
                        @elseif($appointment['type'] == 'tchat')
                            <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="{{ $appointment['day'] }} à {{ $appointment['time'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> avec <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" /></li>
                        @elseif($appointment['type'] == 'phone')
                            <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="{{ $appointment['day'] }} à {{ $appointment['time'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> avec <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" /></li>
                        @endif
                    @endforeach
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations à venir" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>
            @endif

            @if($pastsAppointments->count() > 0)
            <x-ui.card title="Dernières consultations">
                <ul>
                    @foreach ($pastsAppointments as $appointment)
                        @if($appointment['type'] == 'tchat')
                            <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="{{ $appointment['day'] }} à {{ $appointment['time'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> avec <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" /></li>
                        @elseif($appointment['type'] == 'phone')
                            <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="{{ $appointment['day'] }} à {{ $appointment['time'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> avec <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" /> </li>
                        @endif
                    @endforeach
                </ul>
    
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations passées" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>
            @endif

            {{-- Dernières consultations par écrit --}}
            @if (count($writtingAppointmentsReply) > 0 || count($writtingAppointmentsPast) > 0)
                <x-ui.card title="Dernière(s) consultation(s) par écrit">
                    
                    @if (count($writtingAppointmentsReply) > 0)
                    <ul>
                        @foreach ($writtingAppointmentsReply as $appointment)
                            <li><i class="fa-thin fa-envelope"></i> 
                                répondue le <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> pour <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" />
                            </li>
                        @endforeach
                    </ul>
                    @endif

                    @if(count($writtingAppointmentsPast) > 0)
                    <h4 class="text-white/65 italic mt-4 mb-2 text-lg leading-none">Consultation(s) écrite(s) sans réponse</h4>
                    <ul>
                        @foreach ($writtingAppointmentsPast as $appointment)
                            <li><i class="fa-thin fa-envelope"></i> 
                                du <x-ui.link label="{{ $appointment['date'] }}" href="{{ route('admin.appointments.show', $appointment['id']) }}" /> pour <x-ui.link label="{{ $appointment['user_name'] }}" href="{{ route('admin.users.show', $appointment['user_id']) }}" />
                            </li>
                        @endforeach
                    </ul>
                    @endif

                    <x-slot:actions>
                        <x-ui.link label="Toutes les consultations passées" href="{{ route('my_space.appointments.index', ['order' => 'asc']) }}" />
                    </x-slot:actions>
                    
                </x-ui.card>
            @endif

            <x-ui.card title="Gestion du temps">
                    <a class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out" href="{{ route('admin.timeslots.index') }}"><i class="fa-thin fa-clock-two-thirty mr-2"></i> Gestion des créneaux de consultation</a>
                    <a class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out" href="{{ route('admin.timeslots.index') }}"><i class="fa-thin fa-calendar-plus mr-2"></i> Créer un rendez-vous</a>
            </x-ui.card>
        </div>
    </div>

    {{-- Relatif au blog --}}
    <div class="mb-8 py-4 px-6 bg-base-300">
        <h2 class="mb-4">Gestion du blog</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-ui.card title="Articles">
                <ul>
                    <li><x-ui.link label="Rédiger un article" href="{{ route('admin.blog.post.create') }}" /></li>
                    <li><x-ui.link label="Voir tous les articles" href="{{ route('admin.blog.post.index') }}" /></li>
                    <li><x-ui.link label="Créer une catégorie" href="{{ route('admin.blog.category.create') }}" /></li>
                    <li><x-ui.link label="Voir toutes les catégories" href="{{ route('admin.blog.category.index') }}" /></li>
                </ul>
            </x-ui.card>

            <x-ui.card title="Commentaires">
            <ul>
                <li>3 commentaires à approuver</li>
                <li>56 commentaires approuvés</li>
            </ul>
    
            <x-slot:actions>
                <x-ui.link label="Voir tous les commentaires" href="{{ route('home') }}" />
            </x-slot:actions>
            </x-ui.card>
        </div>
        
    </div>

    {{-- Gestions des médias et des fichiers --}}
    <div class="mb-8 py-4 px-6 bg-base-300">
        <h2 class="mb-4">Gestions des médias et des fichiers</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.card title="Documents">
                @livewire('admin.new-file-modal', ['btnMd' => true])
                <x-slot:actions>
                <x-ui.link label="Parcourir les dossiers du site" href="{{ route('admin.list-folders') }}" />
            </x-slot:actions>
            </x-ui.card>

            {{-- <x-ui.card title="Images par défaut">
                @livewire('admin.add-site-imgs-component')
            </x-ui.card> --}}
        </div>
    </div>

    {{-- Relatif aux interprétations --}}
    <div class="mb-8 py-4 px-6 bg-base-300">
        <h2 class="mb-4">Gestion des prévisions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.card title="Les tirages">
                <ul>
                    <li><x-ui.link label="Voir tous les tirages" href="{{ route('admin.draw.index') }}" /></li>
                    <li></li><x-ui.link label="Interprétations des cartes" href="{{ route('admin.tarot.index') }}" /></li>
                    <li><x-ui.link label="Créer un tirage" href="{{ route('admin.draw.create') }}" /></li>
                </ul>
            </x-ui.card>
            

            <x-ui.card title="Numérologie">
                <ul>
                    <li><x-ui.link label="Interprétations des nombres" href="{{ route('admin.numerology.index') }}" /></li>
                </ul>
                
            </x-ui.card>

            <x-ui.card title="Les saisons">
                Liste des saisons
                <x-slot:actions>
                    <x-ui.link label="Voir toutes les saisons" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            <x-ui.card title="Les lunes">
                Liste des lunes
                <x-slot:actions>
                    <x-ui.link label="Voir toutes les lunes" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>
        </div>
    </div>

    {{-- Relatif à la comptabilité --}}
    <div class="py-4 px-6 bg-base-300">
        <h2 class="mb-4">Comptabilité</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-ui.card title="Gestion du temps">
                Nombre de consultation(s) du jour : 2 <br>
                Nombre de consultation(s) du mois : 28 <br>
                Nombre d'heures moyen de consultation sur l'année : 360 heures 
            </x-ui.card>

            <x-ui.card title="Trésorerie">
                Chiffre d'affaire du jour : 100€ <br>
                Chiffre d'affaire du mois : 1280€ <br>
                Chiffre d'affaire de l'année : 14521€ 
                <x-slot:actions>
                    <x-ui.link label="Voir tous les comptes" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            @if($invoices->count() >= 1)
            <x-ui.card title="Facturations">
                <ul>
                    @foreach ($invoices as $invoice)
                    <li class="flex flex-row justify-between gap-2">
                        <a href="{{ route('admin.invoices.show', $invoice->id) }}">{{ Str::limit($invoice->ref, 13) }}</a>
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
    
        </div>

        {{-- @if($invoices->count() >= 1)
            <x-ui.card title="Paiements & facturations">
                <ul>
                    @foreach ($invoices as $invoice)
                    <li class="flex flex-row justify-between gap-2">
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
            @endif --}}
    </div>
</x-admin-layout>
