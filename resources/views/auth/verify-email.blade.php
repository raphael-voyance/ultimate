<x-guest-layout>


        <div class="relative m-auto max-w-full w-96 bg-neutral p-4 rounded-lg">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-success">
                    Un nouveau lien de vérification vous a été envoyé sur l'adresse email utilisée lors de la création de votre compte, s'il n'apparaît pas dans votre boîte de réception, vérifiez vos spams.
                </div>
            @endif

        <div class="mb-4 text-sm text-gray-400">
            Merci pour votre inscription ! Avant de pouvoir utiliser tous les services de votre espace consultant, vous devez valider votre adresse email en cliquant sur le lien que vous avez reçu par email lors de la création de votre compte.
            Vous ne l'avez pas reçu ? Vous pouvez en recevoir un nouveau en cliquant sur le bouton suivant :
            </div>

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-ui.primary-button class="btn-sm text-xs">
                            Renvoyer le lien de vérification
                        </x-ui.primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xs font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>





</x-guest-layout>
