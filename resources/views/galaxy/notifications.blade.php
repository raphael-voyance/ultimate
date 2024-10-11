<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Notifications
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        @foreach ($notifications as $notification)
            <div class="border-b-2 border-white text-white last-of-type:border-b-0 py-1 px-2 flex flex-nowrap flex-row gap-2 justify-between items-center">
                <span class="p-2">{{ $notification->data['message'] }}</span>
                <div class="flex flex-nowrap flex-row gap-2 justify-evenly items-center">
                    <form action="#" method="post">
                        @csrf
                        <button type="submit" class="btn btn-xs text-white btn-accent">D'accord</button>
                        <button type="submit" class="btn btn-xs text-white btn-error">Supprimer</button>
                    </form>
                </div>
            </div>
            
        @endforeach
        
    </article>

</x-app-layout>
