<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Ažurirajte lozinku
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Osigurajte svoj nalog izborom sigurne lozinke.
        </p>
    </header>

    <x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6" preserve-scroll>
        <x-splade-input id="current_password" name="current_password" type="password" label="Trenutna lozinka" autocomplete="current-password" />
        <x-splade-input id="password" name="password" type="password" label="Nova lozinka" autocomplete="new-password" />
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password" label="Potvrda lozinke" autocomplete="new-password" />

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Save')" />

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </x-splade-form>
</section>
