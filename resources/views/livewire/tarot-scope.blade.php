<div class="max-w-full flex flex-col md:flex-row gap-4">
    <div class="md:w-1/2 p-2">
        <h4>Tarot-Scope de naissance</h4>
        <ul class="flex flex-row flex-wrap gap-2 justify-center">
            @foreach ($tarotScope['firstTarotLine'] as $card)
                <li class="w-24">
                    <a href="#">
                        <img width="80" src="{{ $card['card']['imgPath'] }}" alt="{{ $card['card']['name'] }}" />
                        <span>{{ $card['num'] }} - {{ $card['card']['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="flex flex-row flex-wrap gap-2 justify-center">
            @foreach ($tarotScope['lastTarotLine'] as $card)
            <li class="w-24">
                <a href="#">
                    <img width="80" src="{{ $card['card']['imgPath'] }}" alt="{{ $card['card']['name'] }}" />
                    <span>{{ $card['num'] }} - {{ $card['card']['name'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="md:w-1/2 p-2">
        <h4>Tarot-Scope de l'année</h4>
        <ul class="flex flex-row flex-wrap gap-2 justify-center">
            @foreach ($yearlyTarotScope['firstTarotLine'] as $card)
                <li class="w-24">
                    <a href="#">
                        <img width="80" src="{{ $card['card']['imgPath'] }}" alt="{{ $card['card']['name'] }}" />
                        <span>{{ $card['num'] }} - {{ $card['card']['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="flex flex-row flex-wrap gap-2 justify-center">
            @foreach ($yearlyTarotScope['lastTarotLine'] as $card)
            <li class="w-24">
                <a href="#">
                    <img width="80" src="{{ $card['card']['imgPath'] }}" alt="{{ $card['card']['name'] }}" />
                    <span>{{ $card['num'] }} - {{ $card['card']['name'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>




</div>
