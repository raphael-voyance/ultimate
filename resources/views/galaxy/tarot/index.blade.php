<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Vos tirages de tarot
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
        @foreach ($draws as $draw)
        @php
            $drawData = json_decode($draw->draw, true);
        @endphp
        <div class="flex flex-col justify-between items-start mb-3">
            <h2>@if(isset($drawData['name'])){{  $drawData['name'] }} @endif</h2>
            <h4>Le {{ $draw->created_at->format('d/m/Y') }}</h4>
            <a href="{{ route('tarot.get-draw-cards', $draw->id) }}">Voir le tirage</a>
        </div>
        @endforeach
        
    </article>

</x-app-layout>
