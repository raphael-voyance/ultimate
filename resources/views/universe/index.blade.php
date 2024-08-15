<x-admin-layout>

    @section(('js'))
        @vite("resources/js/add/universe/index.js")
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->fullName() }} </span>
            <span>Tableau d'administration</span>
        </h2>
    </x-slot>

    <div>
        <h2>Paramètres</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.card id='card-save-bdd' title="Sauvegarde des données du site">
                <button id="btn-save-bdd" class="btn btn-circle"><i class="fa-thin fa-floppy-disk fa-xl"></i></button>
                <x-slot:actions>
                <x-ui.link label="Voir toutes les sauvegardes" href="{{ route('admin.list-backups') }}" />
            </x-slot:actions>
            </x-ui.card>
        </div>
    </div>

    <div>
        <h2>Relatif aux consultations :</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-ui.card title="Séances passées">
                <div class="text-xl font-bold">
                    Séances passées :
                </div>
                <ul>
                    <li>le : 18/05/2023</li>
                    <li>le : 08/03/2023</li>
                    <li>le : 02/12/2022</li>
                </ul>
    
                <x-slot:actions>
                    <x-ui.link label="Voir toutes les séances" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>

            <x-ui.card title="Séances à venir :">
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

            <x-ui.card title="Consultants">
                <div class="text-xl font-bold">
                    Listes des derniers consultants :
                </div>
                <ul>
                    <li>Thierry P.</li>
                    <li>Margueritte N.</li>
                    <li>Jean-Lou M.</li>
                </ul>
    
                <x-slot:actions>
                    <x-ui.link label="Voir tous les consultants" href="{{ route('home') }}" />
                </x-slot:actions>
            </x-ui.card>
        </div>
    </div>

    <div>
        <h2>Relatif au blog :</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-ui.card title="Articles">
                <div class="text-xl font-bold">
                    <x-ui.link label="Rédiger un article" href="{{ route('admin.blog.post.create') }}" />
                    <x-ui.link label="Catégories" href="{{ route('admin.blog.category.index') }}" />
                </div>
                <x-slot:actions>
                    <x-ui.link label="Voir tous les articles" href="{{ route('admin.blog.post.index') }}" />
                </x-slot:actions>
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

    <div>
        <h2>Relatif aux interprétations :</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-ui.card title="Les tirages">
                <x-ui.link label="Voir tous les tirages" href="{{ route('admin.draw.index') }}" />
                <x-ui.link label="Interprétations des cartes" href="{{ route('admin.tarot.index') }}" />
                <x-ui.link label="Créer un tirage" href="{{ route('admin.draw.create') }}" />
            </x-ui.card>
            

            <x-ui.card title="Numérologie">
                <x-ui.link label="Interprétations des nombres" href="{{ route('admin.numerology.index') }}" />
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

    <div>
        <h2>Relatif à la trésorerie :</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

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
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Gratuit" class="badge-primary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Annulé" class="badge-error"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Annulé" class="badge-error"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Gratuit" class="badge-primary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Gratuit" class="badge-primary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Payé" class="badge-success"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Remboursé" class="badge-secondary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Gratuit" class="badge-primary"/>
                    </li>
                    <li class="flex flex-row justify-between">
                        <a href="#">Paiement 1</a>
                        <x-mary-badge value="Payé" class="badge-success"/>
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
