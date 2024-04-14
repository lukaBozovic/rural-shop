<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black leading-tight">
                Kategorije
            </h2>
            <x-create-button :route="route('categories.create')"/>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$categories">
                <x-splade-cell action as="$item">
                    <x-edit-button :route="route('categories.edit', $item->id)"/>
                    <x-delete-button
                        confirm="Obriši kategoriju?"
                        :route="route('categories.destroy', $item->id)"
                        method="DELETE"/>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
