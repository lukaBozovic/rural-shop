<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black leading-tight">
                Korisnici
            </h2>
            <x-create-button :route="route('users.create')"/>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$users">
                <x-splade-cell action as="$item">
                    <x-edit-button :route="route('users.edit', $item->id)"/>
                    <x-delete-button
                        confirm="Obriši korisnika?"
                        :route="route('users.destroy', $item->id)"
                        method="DELETE"/>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
