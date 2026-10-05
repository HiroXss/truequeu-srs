<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TruequeU') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container py-5 text-center">
            <h1 class="display-4 fw-bold">TruequeU</h1>
            <p class="lead text-muted">Plataforma de trueque estudiantil: publica, busca e intercambia artículos y servicios con otros estudiantes.</p>

            <div class="mt-4 d-flex justify-content-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Ir al panel</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Registrarse</a>
                @endauth
            </div>
        </div>
    </body>
</html>
