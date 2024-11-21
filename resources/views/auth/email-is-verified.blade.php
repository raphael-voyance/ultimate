<x-guest-layout>
        <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-success">
                    Un nouveau lien de vérification vous a été envoyé sur l'adresse email enregistrée sur votre compte, s'il n'apparaît pas dans votre boîte de réception, vérifiez vos spams.
                </div>
            @endif

        <div class="mb-4 text-sm text-gray-400">
            Super ! Votre adresse email a bien été confirmée. </br>
            Vous pouvez désormais prendre rendez-vous en ligne.</br>
            Vous pouvez également découvrir des nouvelles fonctionnalités qui vous sont proposées telles que le calcul de votre chemin de vie numérologique ou encore des tirages de tarot en ligne interprétés directement par Raphaël.
            </div>

            <div class="mt-4 flex items-center justify-center">
                <a href="{{ route('my_space.index') }}" class="btn btn-secondary btn-sm text-xs hover:text-white focus:text-white">Visiter le tableau de bord</a>
            </div>
        </div>
</x-guest-layout>
