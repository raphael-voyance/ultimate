<div>
    @if($message)
    {{-- Début destinataire du Message --}}
    <div class="border-b-2 border-slate-100 pb-2 mb-4">
        <x-ui.hover-content hoverPosition="bottom">
            <x-slot:content>
                <p class="group">Vous répondez à : <span class="italic text-accent group-hover:text-accent-focus">
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

    {{-- Début Contenu du message --}}
      <div tabindex="0" class="collapse collapse-plus">
        <div class="collapse-title pl-0 border-b-2 border-slate-100 pb-2 mb-4">
            Contenu du message :
        </div>
        <div class="collapse-content">
          <p>{{ $message['content'] }}</p>
        </div>
      </div>
    {{-- Fin Contenu du message --}}

    {{-- Début La personne est connu du site ou non --}}
    @if (!$message['receiver_id'])
    <div class="text-red-500 bg-red-300/70 mt-4 p-4 rounded-md">Destinataire non inscrit</div>
    @endif
    @if (!$message['sender_id'])
        <div class="text-red-500 bg-red-300/70 mt-4 p-4 rounded-md">Expéditeur non inscrit</div>
    @endif
    {{-- Fin La personne est connu du site ou non --}}

    @endif
</div>
