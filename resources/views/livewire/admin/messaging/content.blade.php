<div class="flex flex-col md:grid md:grid-cols-12 gap-4">

    @section('css')
    @vite(['resources/css/add/messaging.css'])
    @endsection
    @section('scripts')
    @vite(['resources/js/add/sticky_nav_messaging.js'])
    @endsection

    {{-- Début Navigation des messages --}}
    <div id="container_messages_navigation" class="col-span-12 sm:col-span-4 p-2 overflow-y-auto">
        @livewire('admin.messaging.navigation', [
            'received_messages' => $received_messages,
            'sent_messages' => $sent_messages,
            ])
    </div>
    {{-- Fin Navigation des messages --}}

    {{-- Début Zone de contenu des messages --}}
    <div class="col-span-12 sm:col-span-8 p-2 overflow-y-auto w-full h-full">
        <div wire:loading.class="overflow-hidden" class="relative w-full h-full">

            {{-- Début Zone de chargement du contenu --}}
            <div wire:loading='contentActive'>
                <x-ui.loader />
            </div>

            {{-- Fin Zone de chargement du contenu --}}

            {{-- Début Zone d'affichage du contenu des messages --}}
            <div id="contentMessagesComponent" class="p-2 min-h-[400px]">
                @switch($contentActive)
                    @case("show-message")
                        @livewire('admin.messaging.show-message', [
                            'message' => $message
                        ])
                        @break

                    @case("new-message")
                        @livewire('admin.messaging.new-message')
                        @break

                    @case("reply-message")
                        @livewire('admin.messaging.reply-message', [
                            'message' => $message
                        ])
                        @break

                    @default
                    <div class="flex flex-col min-h-[400px] bg-contain bg-center bg-no-repeat" style="background-image: url('{{ asset('imgs/mailbox.svg') }}')">
                        <p class="m-auto p-4 bg-secondary text-white rounded-md">
                            Aucun contenu à afficher
                        </p>
                    </div>

                @endswitch
            </div>
            {{-- Fin Zone d'affichage du contenu des messages --}}

        </div>
    </div>
    {{-- Fin Zone de contenu des messages --}}

</div>


