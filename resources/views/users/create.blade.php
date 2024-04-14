<x-splade-modal max-width="7xl" close-explicitly>
    <div class="max-w-7xl x-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
            Novi korisnik
        </h2>
        <x-splade-form :action="route('users.store')" class="mx-auto p-4 bg-white rounded-md">
            <x-splade-input name="name" label="Ime" placeholder="Unesite ime" required/>
            <x-splade-input name="email" label="Email" placeholder="Unesite email" required/>
            <x-splade-input name="password" label="Lozinka" type="password" placeholder="Unesite lozinku" required/>
            <x-splade-submit class="mt-4" label="Potvrdi"/>
        </x-splade-form>
    </div>
</x-splade-modal>

