<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Rendez-vous
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        @foreach ($appointments as $appointment)
            <h3 class="text-lg font-semibold">
                @switch($appointment->appointment_type)
                    @case('phone')
                        <i class="fa-thin mr-2 fa-phone"></i>Consultation par téléphone
                    @break

                    @case('tchat')
                        <i class="fa-thin mr-2 fa-sharp fa-comments"></i>Consultation par tchat
                    @break

                    @case('writing')
                        <i class="fa-thin mr-2 fa-thin fa-pen-nib"></i>Consultation écrite
                    @break
                        
                @endswitch
            </h3>

            @if($appointment->appointment_type == 'writing')
                <p>Réponse estimée le {{ $appointment->reply_date }}</p>
            @else
                <p>Rendez-vous le {{ $appointment->date }} à {{ $appointment->time }}</p>
            @endif

            <a href="{{ route('my_space.appointment.show', ['appointment_id' => $appointment['id'], 'user_name' => $appointment['authUserName']]) }}" class="btn btn-xs btn-primary hover:text-black focus:text-black active:text-black">Voir le rendez-vous</a>
        @endforeach
        
    </article>

</x-admin-layout>
