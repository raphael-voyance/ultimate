<div id="home-hero" class="relative h-screen w-screen max-w-full bg-cover bg-no-repeat bg-center" style="background-image: url('{{ asset('imgs/hero-img.jpg') }}'">
{{ $slot }}



    <style type="text/css">
        .content__text {
            display: none;
        }

        .content__text--current {
            display: block;
        }
    </style>

<div
    id="hero_messages"
    class="
    group absolute w-10/12 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 py-6 px-10 h-auto flex overflow-hidden
    md:w-8/12 lg:w-6/12 md:text-2xl lg:text-3xl
    font-sans text-white text-xl bg-black/75 rounded-lg border-white/85 border-r-2 border-b-2 shadow-md shadow-white/75 hover:bg-black/80 transition">
    @foreach ($messages as $message)
        <div class="content__text m-auto" data-splitting>{{ $message }}</div>
    @endforeach
    <div class="absolute top-2 right-4 opacity-0 group-hover:opacity-60 transition">
        <i class="fa-duotone fa-pause"></i>
    </div>
</div>

</div>
