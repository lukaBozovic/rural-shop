<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black leading-tight">
                Oglasi
            </h2>
            <x-create-button :route="route('ads.create')"/>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$ads">

                <x-splade-cell is_active as="$item">
                    <x-toggle-switch :route="route('ads.active-toggle', $item->id)" :value="$item->is_active"/>
                </x-splade-cell>
                <x-splade-cell action as="$item">
                    <x-edit-button :route="route('ads.edit', $item->id)"/>
                    <x-delete-button
                        confirm="Obriši oglas"
                        :route="route('ads.destroy', $item->id)"
                        method="DELETE"/>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
