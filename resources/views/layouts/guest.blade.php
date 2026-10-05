<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light py-4">
            <div>
                <a href="/">
                    <x-application-logo style="width: 80px; height: 80px; fill: #6c757d;" />
                </a>
            </div>

            <div class="card shadow-sm mt-4 w-100" style="max-width: 28rem;">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
