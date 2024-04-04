<x-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Messaging') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('admin.messaging.content', [
                        'received_messages' => $received_messages,
                        'sent_messages' => $sent_messages
                        ])
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
