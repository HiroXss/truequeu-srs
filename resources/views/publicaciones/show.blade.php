<x-app-layout>
    <div class="container py-4">
        <a href="{{ route('publicaciones.index') }}" class="btn btn-link px-0 mb-3">&larr; Volver</a>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-primary-subtle text-primary">{{ $publicacion->categoria->nombre }}</span>
                        <h2 class="mt-2">{{ $publicacion->titulo }}</h2>
                        <p class="text-muted small">Publicado por {{ $publicacion->user->name }} · {{ $publicacion->user->programa }} · {{ $publicacion->created_at->diffForHumans() }}</p>
                        <hr>
                        <p>{{ $publicacion->descripcion }}</p>
                        <ul class="list-unstyled">
                            <li><strong>Ofrece:</strong> {{ $publicacion->ofrece }}</li>
                            <li><strong>Busca:</strong> {{ $publicacion->busca }}</li>
                            <li><strong>Estado:</strong> <span class="badge {{ $publicacion->estado === 'disponible' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">{{ ucfirst($publicacion->estado) }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>¿Te interesa?</h5>

                        @guest
                            <p class="small text-muted">Para contactar al dueño de esta publicación debes iniciar sesión o crear una cuenta.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Crear cuenta</a>
                        @else
                            @if($esDueno)
                                <div class="alert alert-secondary small mb-0">Esta publicación es tuya.</div>
                            @else
                                <form method="POST" action="{{ route('mensajes.store', $publicacion) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="contenido" class="form-control" rows="4" placeholder="Escribe tu mensaje..." required></textarea>
                                        @error('contenido')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if(session('status'))
                                        <div class="alert alert-success small">{{ session('status') }}</div>
                                    @endif
                                    <button class="btn btn-primary w-100">Contactar</button>
                                </form>
                            @endif
                        @endguest
                    </div>
                </div>

                @auth
                    @if($historial->isNotEmpty())
                        <div class="card shadow-sm mt-4">
                            <div class="card-body">
                                <h6>Historial de mensajes</h6>
                                @foreach($historial as $mensaje)
                                    <div class="mb-2">
                                        <small class="text-muted">{{ $mensaje->emisor->name }} · {{ $mensaje->created_at->format('d/m H:i') }}</small>
                                        <p class="mb-0 small">{{ $mensaje->contenido }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
