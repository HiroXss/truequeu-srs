<x-app-layout>
    <div class="container py-4">
        <h1 class="display-5 fw-bold text-center text-primary mb-3">Explorar Publicaciones</h1>
        <p class="text-center text-muted mb-4">Encuentra artículos y servicios para intercambiar con otros estudiantes.</p>

        <form method="GET" action="{{ route('publicaciones.index') }}" class="row g-2 justify-content-center mb-5">
            <div class="col-md-6">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-lg" placeholder="Buscar por título, palabra clave...">
            </div>
            @if(request('categoria_id')) <input type="hidden" name="categoria_id" value="{{ request('categoria_id') }}"> @endif
            @if(request('estado')) <input type="hidden" name="estado" value="{{ request('estado') }}"> @endif
            <div class="col-auto">
                <button class="btn btn-primary btn-lg">Buscar</button>
            </div>
        </form>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Filtros</h5>
                        <form method="GET" action="{{ route('publicaciones.index') }}">
                            <input type="hidden" name="q" value="{{ request('q') }}">
                            <div class="mb-3">
                                <label class="form-label small text-muted">Categoría</label>
                                <select name="categoria_id" class="form-select">
                                    <option value="">Todas las categorías</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small text-muted">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="disponible" @selected(request('estado') == 'disponible')>Disponible</option>
                                    <option value="reservado" @selected(request('estado') == 'reservado')>Reservado</option>
                                </select>
                            </div>
                            <button class="btn btn-outline-primary w-100">Aplicar filtros</button>
                            <a href="{{ route('publicaciones.index') }}" class="btn btn-link w-100 mt-2 small">Limpiar</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <p class="text-muted mb-3">Mostrando <strong>{{ $publicaciones->total() }}</strong> resultado(s)</p>

                @if($publicaciones->isEmpty())
                    <div class="alert alert-info">No se encontraron publicaciones con esos criterios.</div>
                @endif

                <div class="row g-4">
                    @foreach($publicaciones as $pub)
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-primary-subtle text-primary align-self-start mb-2">{{ $pub->categoria->nombre }}</span>
                                    <h5 class="card-title">{{ $pub->titulo }}</h5>
                                    <p class="card-text small text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($pub->descripcion, 90) }}</p>
                                    <ul class="list-unstyled small mb-3">
                                        <li><strong>Ofrece:</strong> {{ $pub->ofrece }}</li>
                                        <li><strong>Busca:</strong> {{ $pub->busca }}</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge {{ $pub->estado === 'disponible' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">{{ ucfirst($pub->estado) }}</span>
                                        <a href="{{ route('publicaciones.show', $pub) }}" class="btn btn-sm btn-outline-primary">Ver detalle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">{{ $publicaciones->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
