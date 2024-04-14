<x-splade-modal max-width="2xl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
            Izmijeni korisnka
        </h2>
        <x-splade-form method="put" :default="$user" :action="route('users.update',$user->id)"
                       class="mx-auto p-4 bg-white rounded-md" preserve-scroll>
            <x-splade-input name="name" label="Ime" placeholder="Unesite ime" required/>
            <x-splade-input name="email" label="Email" placeholder="Unesite email" required/>
            <x-splade-submit class="mt-4"/>
        </x-splade-form>
    </div>
</x-splade-modal>
