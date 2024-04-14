<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Izbrišite svoj nalog
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Nakon što izbrišete svoj nalog, svi resursi i podaci će biti trajno izbrisani. Molimo unesite lozinku da potvrdite da želite trajno izbrisati svoj nalog.
        </p>
    </header>

     <x-splade-form
        method="delete"
        :action="route('profile.destroy')"
        confirm="Da li ste sigurni da želite izbrisati svoj nalog?"
        confirm-text="Izbriši nalog"
        confirm-button="Izbriši nalog"
        require-password
    >
        <x-splade-submit danger label="Izbriši" />
    </x-splade-form>
</section>
