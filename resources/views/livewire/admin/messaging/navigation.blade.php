<nav id="messages_navigation" class="pt-2">

    {{-- Début Entête Navigation Messages --}}
    <div x-data="{ open: false }" class="flex flex-row justify-between mb-4 relative">
        <x-ui.primary-button type="button" wire:click="dispatchContentActive('new-message')">Nouveau
            message</x-ui.primary-button>
        {{-- Début Recherche --}}
        <button type="button" x-on:click="open = true" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 focus:ring-0 focus:ring-offset-0"><i class="fa-thin fa-magnifying-glass"></i></button>

        <div class="absolute left-0 w-full" x-cloak x-show="open"
            x-on:click.away="open = false; $wire.resetQuery()">
            <x-input placeholder="Votre recherche..." icon="o-user" wire:model='query' wire:keydown.prevent.enter='searchQuery()' />
            @if($searchResults && count($searchResults) > 0  && $searchResults[0] != 'No result')
            <ul>
                {{ dd($searchResults) }}
                @foreach ($searchResults as $index => $message)
                <li class="pt-4 px-2 mb-2 last:mb-0 cursor-pointer bg-slate-50 hover:bg-slate-100">
                    <span>de : XXXXXX</span>
                    <span>pour : XXXXXX</span>
                    <p>Sujet : {{ $message['subject'] }} </p>
                    <p>Message : {{ Str::excerpt($message['content'], null, ['radius' => 30]) }}</p>
                </li>
                @endforeach
            </ul>
            @elseif($searchResults && in_array('No result', $searchResults))
                <div class="bg-slate-50">
                    <p>Pas de résultat pour la recherche : "{{ $query }}"</p>
                </div>
            @endif
        </div>
        {{-- Fin Recherche --}}
    </div>
    {{-- Fin Entête Navigation Messages --}}

    {{-- Début Dropdown Messages Reçus --}}
    <x-ui.dropdown :outside="false" :dropdownMenu="false" toggle-text="Boîte de réception">

        {{-- Début Dropdown Header Messages Reçus --}}
        <div>
            <span class="bg-slate-500 text-white text-center text-xs w-24 px-2 py-1 my-2 float-right">
                {{ $totalReceivedMessage }} message{{ $totalReceivedMessage > 1 ? 's' : '' }}
            </span><br>
            <div class="float-left text-xs text-slate-400 -mt-[5px]">
                <button type="button" @class(['mr-2', 'font-bold text-slate-500' => $orderReceivedMessages == 'ASC']) wire:click="ascReceivedMessages"><i class="fa-thin fa-arrow-up"></i> ASC</button>
                <button type="button" @class(['font-bold text-slate-500' => $orderReceivedMessages == 'DESC']) wire:click="descReceivedMessages"><i class="fa-thin fa-arrow-down"></i>
                    DSC</button>
            </div>
        </div>
        {{-- Fin Dropdown Header Messages Reçus --}}

        {{-- Début Dropdown List Messages Reçus --}}
        <ul class="w-full clear-both min-h-[380px]">
            @foreach ($receivedMessagesOnPage as $rm)
                <li :key="{{ $rm['id'] }}" wire:click='dispatchMessage("{{ $rm['id'] }}")'
                    @class(['p-2 text-left text-sm leading-5 text-slate-700 cursor-pointer hover:bg-slate-100 focus:outline-none focus:bg-slate-100 transition duration-150 ease-in-out', 'font-bold bg-slate-50' => !$messageReadStates[$rm['id']]])>
                    <div class="flex flex-row justify-between">
                        <span>de: {{ $rm['sender_first_name'] }} {{ $rm['sender_last_name'] }}</span>
                        <span>{{ \Carbon\Carbon::create($rm['created_at'])->diffForHumans() }}</span>
                    </div>
                    <div><span class="italic">Sujet:
                        </span>
                        @if($rm['subject'])
                                {{ $rm['subject'] }}
                            @else
                                <i class="fa-thin fa-ban"></i>
                            @endif
                    <div><span class="italic">Message:
                        </span>{{ Str::excerpt($rm['content'], null, ['radius' => 30]) }}</div>
                    @if (!$rm['sender_id'])
                        <div class="text-error">Expéditeur non inscrit</div>
                    @endif
                </li>
            @endforeach
        </ul>
        {{-- Fin Dropdown List Messages Reçus --}}

        {{-- Début Dropdown Footer Messages Reçus --}}
        <div class="flex flex-row justify-between text-sm bg-slate-100 p-2">
            <span>Page : {{ $currentReceivedPage }} / {{ $totalReceivedPage }}</span>
            <div>
                @if($currentReceivedPage > 1)
                <button wire:click='previousReceivedPage'><i class="fa-thin fa-arrow-left"></i></button>
                @endif
                @if($currentReceivedPage < $totalReceivedPage)
                <button wire:click='nextReceivedPage'><i class="fa-thin fa-arrow-right"></i></button>
                @endif
            </div>
        </div>
        {{-- Fin Dropdown Footer Messages Reçus --}}

    </x-ui.dropdown>
    {{-- Fin Dropdown Messages Reçus --}}

    {{-- Début Dropdown Messages Envoyés --}}
    <x-ui.dropdown :outside="false" :dropdownMenu="false" toggle-text="Messages envoyés">

        {{-- Début Dropdown Header Messages Envoyés --}}
        <div>
            <span class="bg-slate-500 text-white text-center text-xs w-24 px-2 py-1 my-2 float-right">
                {{ $totalSentMessage }} message{{ $totalSentMessage > 1 ? 's' : '' }}
            </span><br>
            <div class="float-left text-xs text-slate-400 -mt-[5px]">
                <button type="button" @class(['mr-2', 'font-bold text-slate-500' => $orderSentMessages == 'ASC']) wire:click="ascSentMessages"><i class="fa-thin fa-arrow-up"></i> ASC</button>
                <button type="button" @class(['font-bold text-slate-500' => $orderSentMessages == 'DESC']) wire:click="descSentMessages"><i class="fa-thin fa-arrow-down"></i>
                    DSC</button>
            </div>
        </div>
        {{-- Fin Dropdown Header Messages Envoyés --}}

        {{-- Début Dropdown List Messages Envoyés --}}
        <ul class="w-full clear-both min-h-[380px]">
            @foreach ($sentMessagesOnPage as $sm)
                <li :key="{{ $sm['id'] }}" wire:click='dispatchMessage("{{ $sm['id'] }}")'
                    class="p-2 text-left text-sm leading-5 text-slate-700 cursor-pointer hover:bg-slate-50 focus:outline-none focus:bg-slate-100 transition duration-150 ease-in-out">
                    <div class="flex flex-row justify-between">
                        <span>pour: {{ $sm['receiver_first_name'] }} {{ $sm['receiver_last_name'] }}</span>
                        <span>{{ \Carbon\Carbon::create($sm['created_at'])->diffForHumans() }}</span>
                    </div>
                    <div><span class="italic">Sujet:
                        </span>
                            @if($sm['subject'])
                                {{ $sm['subject'] }}
                            @else
                                <i class="fa-thin fa-ban"></i>
                            @endif
                        </div>
                    <div><span class="italic">Message:
                        </span>{{ Str::excerpt($sm['content'], null, ['radius' => 30]) }}</div>
                    @if (!$sm['receiver_id'])
                        <div class="text-error">Destinataire non inscrit</div>
                    @endif
                </li>
            @endforeach
        </ul>
        {{-- Fin Dropdown List Messages Envoyés --}}

        {{-- Début Dropdown Footer Messages Envoyés --}}
        <div class="flex flex-row justify-between text-sm bg-slate-100 p-2">
            <span>Page : {{ $currentSentPage }} / {{ $totalSentPage }}</span>
            <div>
                @if($currentSentPage > 1)
                <button wire:click='previousSentPage'><i class="fa-thin fa-arrow-left"></i></button>
                @endif
                @if($currentSentPage < $totalSentPage)
                <button wire:click='nextSentPage'><i class="fa-thin fa-arrow-right"></i></button>
                @endif
            </div>
        </div>
        {{-- Fin Dropdown Footer Messages Envoyés --}}

    </x-ui.dropdown>
    {{-- Fin Dropdown Messages Envoyés --}}

    {{-- Début Dropdown Messages Marqués --}}
    <x-ui.dropdown :outside="false" :dropdownMenu="false" toggle-text="Messages marqués">
        <ul>
            <li>
                <a href="#">Récupérer tous les messages marqués paginés</a>
            </li>
            <li>
                <a href="#">Message un (envoie le message à la vue "message")</a>
            </li>
            <li>
                <a href="#">Message deux (envoie le message à la vue "message")</a>
            </li>
            <li>
                <a href="#">Message trois (envoie le message à la vue "message")</a>
            </li>
        </ul>
    </x-ui.dropdown>
    {{-- Fin Dropdown Messages Marqués --}}

</nav>
