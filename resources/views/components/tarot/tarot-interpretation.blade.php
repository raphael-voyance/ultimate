<div>
    <h4>Les 22 arcanes majeurs</h4>
    <ul class="flex flex-row flex-wrap gap-2 justify-center">
        @foreach ($cards as $key => $card)
            <li class="w-24">
                <a href="#">
                    <img width="80" src="{{ $card['imgPath'] }}" alt="{{ $card['name'] }}" />
                    <span>{{ $key }} - {{ $card['name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
