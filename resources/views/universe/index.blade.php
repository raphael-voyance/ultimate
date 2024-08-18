<x-admin-layout>

    @section(('js'))
        @vite("resources/js/add/universe/backups.js")
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
                    <li><x-ui.link label="Florent P." href="#" /></li>
                    <li><x-ui.link label="Joy N." href="#" /></li>
                    <li><x-ui.link label="Patrice V." href="#" /></li>
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

            <x-ui.card title="Dernières consultations">
                <ul>
                    <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="08/05/2024" href="#" /> avec Mathilde</li>
                    <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="14/04/2024" href="#" /> avec Brigitte</li>
                    <li><i class="fa-thin fa-pen-nib mr-2"></i> le <x-ui.link label="19/03/2024" href="#" /> pour Gérard</li>
                </ul>
    
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations passées" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            <x-ui.card title="Consultations à venir">
                <ul>
                    <li><i class="fa-thin fa-pen-nib mr-2"></i> le <x-ui.link label="08/09/2024" href="#" /> pour Brune</li>
                    <li><i class="fa-sharp fa-thin fa-comments mr-2"></i> le <x-ui.link label="14/09/2024" href="#" /> avec Louis</li>
                    <li><i class="fa-thin fa-phone mr-2"></i> le <x-ui.link label="19/09/2024" href="#" /> avec Jean-Gaspard</li>
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Toutes les consultations à venir" href="{{ route('home') }}" />
                </x-slot:actions>
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

            <x-ui.card title="Derniers paiements">
                <ul>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Payé" class="badge-success"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="En attente" class="badge-warning"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Remboursé" class="badge-secondary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Gratuit" class="badge-primary"/>
                    </li>
                </ul>
                <x-slot:actions>
                    <x-ui.link label="Voir tous les paiements" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>
    
        </div>

        {{-- @if($invoices->count() >= 1)
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
            @endif --}}
    </div>
</x-admin-layout>
