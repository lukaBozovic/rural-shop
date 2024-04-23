<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black leading-tight">
                Narudžbine
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$orders">

{{--                <x-splade-cell is_active as="$item">--}}
{{--                    <x-toggle-switch :route="route('ads.active-toggle', $item->id)" :value="$item->is_active"/>--}}
{{--                </x-splade-cell>--}}
                <x-splade-cell action as="$item">
                    <a href="{{ route('orders.show', $item['id']) }}" class="text-indigo-600 hover:text-indigo-900">Detalji</a>

                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
