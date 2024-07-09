<x-admin-layout>
    {{-- @section("js")
        @vite("resources/js/add/universe/draws.js")
    @endsection --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Interprétation des nombres</span>
        </h2>
    </x-slot>

    <section>

        <section>
            <div class="grid grid-cols-5 gap-4">
            @foreach ($numbers as $number)
                    <div>
                        <a href="{{ route('admin.numerology.view', $number->number) }}">{{ $number->name }} - {{ $number->number }}</a>
                    </div>
            @endforeach
            </div>
        </section>

    </section>

</x-admin-layout>
