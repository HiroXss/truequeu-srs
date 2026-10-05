<x-guest-layout>
    <div class="mb-4 small text-muted">
        ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu correo electrónico haciendo clic en el enlace que te enviamos? Si no recibiste el correo, te enviaremos otro con gusto.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 small text-success fw-semibold">
            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <div class="mt-4 d-flex align-items-center justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Reenviar correo de verificación
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="small text-muted text-decoration-none">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
