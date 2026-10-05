<section>
    <header>
        <h2 class="fs-5 fw-semibold">
            Eliminar cuenta
        </h2>

        <p class="small text-muted">
            Una vez eliminada tu cuenta, todos sus datos se borrarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Eliminar cuenta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h2 class="fs-5 fw-semibold">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="small text-muted">
                Una vez eliminada tu cuenta, todos sus datos se borrarán permanentemente. Ingresa tu contraseña para confirmar que deseas eliminarla definitivamente.
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="Contraseña" class="visually-hidden" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 w-75"
                    placeholder="Contraseña"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Eliminar cuenta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
