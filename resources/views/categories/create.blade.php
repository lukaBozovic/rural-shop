<x-splade-modal max-width="7xl" close-explicitly>
    <div class="max-w-7xl x-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
            Nova kategorija
        </h2>
        <x-splade-form :action="route('categories.store')" class="mx-auto p-4 bg-white rounded-md">
            <x-splade-input name="name" label="Ime" placeholder="Unesite ime" required/>
            <x-splade-submit class="mt-4" label="Potvrdi"/>
        </x-splade-form>
    </div>
</x-splade-modal>

