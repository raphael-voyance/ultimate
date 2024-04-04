<div>
    @if ($message)
        {{-- Début Boutons d'action du message --}}
        <div class="mb-4">
            <x-ui.primary-button type="button"
                wire:click="dispatchContentActive('reply-message')">Répondre</x-ui.primary-button>
            <x-ui.primary-button type="button">Marquer le message</x-ui.primary-button>
            <x-ui.danger-button type="button"
                wire:click="remove({{ $message['id'] }})">Supprimer</x-ui.danger-button>
        </div>
        {{-- Fin Boutons d'action du message --}}

        {{-- Début Message --}}

        {{-- Début Expéditeur du Message --}}
        <div class="border-b-2 border-slate-100 pb-2 mb-4">
            <x-ui.hover-content hoverPosition="bottom">
                <x-slot:content>
                    <p class="group">de: <span class="italic text-accent group-hover:text-accent-focus">
                        {{ $message['sender_first_name'] }} {{ $message['sender_last_name'] }}
                    </span></p>
                </x-slot:content>
                <x-slot:hover>
                    <p class="italic">
                        <a href="#">{{ $message['sender_email'] }}</a>
                    </p>
                    @if($message['receiver_id'] == auth()->user()->id)
                        @if ($message['sender_phone'])
                        <p><i class="fa-thin fa-phone-rotary"></i> {{ $message['sender_phone'] }}</p>
                        @endif
                    @endif
                </x-slot:hover>
            </x-ui.hover-content>
        </div>
        {{-- Fin Expéditeur du Message --}}

        {{-- Début Destinataire du Message --}}
        <div class="border-b-2 border-slate-100 pb-2 mb-4">
            <x-ui.hover-content hoverPosition="bottom">
                <x-slot:content>
                    <p class="group">pour: <span class="italic text-accent group-hover:text-accent-focus">
                        {{ $message['receiver_first_name'] }} {{ $message['receiver_last_name'] }}
                    </span></p>
                </x-slot:content>
                <x-slot:hover>
                    <p class="italic">
                        <a href="#">{{ $message['receiver_email'] }}</a>
                    </p>
                    @if($message['sender_id'] == auth()->user()->id)
                        @if ($message['sender_phone'])
                        <p><i class="fa-thin fa-phone-rotary"></i> {{ $message['sender_phone'] }}</p>
                        @endif
                    @endif
                </x-slot:hover>
            </x-ui.hover-content>
        </div>
        {{-- Fin Destinataire du Message --}}

        {{-- Début Date du Message --}}
        <div class="border-b-2 border-slate-100 pb-2 mb-4">
            <p>
                {{ $message['sender_id'] == auth()->user()->id ? 'Envoyé le: ' : 'Reçu le: ' }}
                {{ \Carbon\Carbon::create($message['created_at'])->locale('fr')->dayName }}
                {{ \Carbon\Carbon::create($message['created_at'])->day }}
                {{ \Carbon\Carbon::create($message['created_at'])->locale('fr')->monthName }}
                {{ \Carbon\Carbon::create($message['created_at'])->year }}
            </p>
        </div>
        {{-- Fin Date d'envoie du Message --}}

        {{-- Début Sujet du message --}}
        <div class="border-b-2 border-slate-100 pb-2 mb-4">
            <p>
                Sujet:
                @if ($message['subject'])
                    <span class="italic">{{ $message['subject'] }}</span>
                @else
                    <span class="italic text-slate-400"><i class="fa-thin fa-ban"></i> Message sans sujet</span>
                @endif
            </p>
        </div>
        {{-- Fin Sujet du message --}}

        {{-- Début Contenu du message --}}
        <div>
            <p class="border-b-2 border-slate-100 pb-2 mb-4">
                Contenu du message :
            </p>
            <p>
                {{ $message['content'] }}
            </p>

        </div>
        {{-- Fin Contenu du message --}}

        {{-- Début La personne est connu du site ou non --}}
        @if (!$message['receiver_id'])
            <p class=
            "relative mt-4 p-4
            after:absolute after:block after:w-[10px] after:h-[10px] after:rounded-full after:left-0 after:top-[23px] after:bg-error"
            >Destinataire non inscrit</p>
        @endif
        @if (!$message['sender_id'])
        <p class=
                "relative mt-4 p-4
                after:absolute after:block after:w-[10px] after:h-[10px] after:rounded-full after:left-0 after:top-[23px] after:bg-error"
            >Expéditeur non inscrit</p>
        @endif
        {{-- Fin La personne est connu du site ou non --}}

        {{-- Début Le message est marqué ou non --}}
        {{-- Fin Le message est marqué ou non --}}

        {{-- Fin Message --}}
    @else
        <p>Le message a des difficultés pour s'afficher correctement.</p>
    @endif
</div>
