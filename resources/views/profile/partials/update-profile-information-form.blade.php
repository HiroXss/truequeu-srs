<section>
    <header>
        <h2 class="fs-5 fw-semibold">
            Información del perfil
        </h2>

        <p class="small text-muted">
            Actualiza la información de tu cuenta y tu correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" name="name" type="text" class="mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-3">
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" name="email" type="email" class="mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="small mt-2">
                        Tu correo electrónico no está verificado.

                        <button form="send-verification" class="small text-muted text-decoration-none">
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 small text-success fw-semibold">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-3">
            <x-input-label for="programa" value="Programa / Facultad" />
            <x-text-input id="programa" name="programa" type="text" class="mt-1" :value="old('programa', $user->programa)" required autocomplete="organization" />
            <x-input-error class="mt-2" :messages="$errors->get('programa')" />
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <x-primary-button>Guardar</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="small text-muted mb-0"
                >Guardado.</p>
            @endif
        </div>
    </form>
</section>
