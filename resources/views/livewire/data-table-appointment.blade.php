<div>
    RDV à venir :
    <br/>

    @foreach ($upComingAppointments as $appointment)
        le : {{ $appointment->formatted_day }} à {{ $appointment->formatted_time }}
    @endforeach

    <br/>

    RDV passé :
    <br/>

    @foreach ($pastAppointments as $appointment)
        le : {{ $appointment->formatted_day }} à {{ $appointment->formatted_time }}
    @endforeach
</div>
