<x-guest-layout>
        <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-success">
                    Un nouveau lien de vérification vous a été envoyé sur l'adresse email enregistrée sur votre compte, s'il n'apparaît pas dans votre boîte de réception, vérifiez vos spams.
                </div>
            @endif

        <div class="mb-4 text-sm text-gray-400">
            Super ! Votre adresse email est validée. Vous pouvez maintenant découvrir les nouvelles fonctionnalités qui vous sont proposées telles que le calcul de votre arbre numérologique ou encore des tirages de tarot en ligne.
            Vous pouvez désormais également prendre rendez-vous en ligne avec Raphaël.
            </div>

            <div class="mt-4 flex items-center justify-center">
                <a href="{{ route('my_space.index') }}" class="btn btn-secondary btn-sm text-xs hover:text-white focus:text-white">Visiter le tableau de bord</a>
            </div>
        </div>
</x-guest-layout>
