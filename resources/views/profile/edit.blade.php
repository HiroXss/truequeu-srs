<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold mb-0">
            Perfil
        </h2>
    </x-slot>

    <div class="container">
        <div class="d-flex flex-column gap-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mx-auto" style="max-width: 36rem;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mx-auto" style="max-width: 36rem;">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mx-auto" style="max-width: 36rem;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
