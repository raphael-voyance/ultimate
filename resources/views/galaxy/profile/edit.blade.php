<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Votre profil
        </h2>
    </x-slot>


            <div class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                <div class="max-w-xl">
                    {{ $user->profile }}
                    {{ $user->profile->birthday }}
                    <img src="{{ $user->profile->avatar }}" />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('galaxy.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('galaxy.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-neutral shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('galaxy.profile.partials.delete-user-form')
                </div>
            </div>
</x-app-layout>
