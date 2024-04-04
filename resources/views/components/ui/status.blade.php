@props(['type' => 'default', 'message', 'timer' => false])
{{-- {{ réflechir pour rendre fonctionnel le timer }} --}}
{{-- Début Container Status --}}
<div x-cloak
    x-data="sessionStatus"
    x-transition
    x-show="visible"
    class="
        fixed
        top-2 left-1/2 -translate-x-1/2
        w-[400px] max-w-full">

        <div @class(['group relative min-h-max w-full pl-4 pr-8 pt-3 pb-2 mb-2 last:m-auto rounded-lg cursor-pointer transition-all shadow-lg',
            'text-white bg-success' => $type == 'success',
            'text-white bg-info' => $type == 'info',
            'text-white bg-error' => $type == 'error',
            'text-white bg-neutral' => $type == 'default',
            ])
            @click="removeStatus()">
            <span>{{ $message }}</span>
            @if ($timer)
                <span x-text="timer"></span>
            @endif
            <span class="invisible opacity-0 absolute top-0 right-1 group-hover:visible group-hover:opacity-100 transition-all"><i class="fa-thin fa-xmark"></i></span>
        </div>
</div>
{{-- Fin Container Toast --}}
