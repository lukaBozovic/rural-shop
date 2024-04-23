<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black leading-tight">
                Narudžbina
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div class="font-semibold text-xl text-black leading-tight">
                            <h2>Narudžbina #{{ $order['id'] }}</h2>
                        </div>
                        <div class="text-sm text-gray-500">
                            <h2>{{ date_format(date_create($order['created_at']), 'Y-m-d H:i:s') }}</h2>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div>
                            <h2 class="font-semibold text-lg">Detalji Narudžbine</h2>
                            <div class="mt-4">
                                <h3 class="font-semibold">Naslov oglasa:</h3>
                                <p>{{ $ad['title'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Ime:</h3>
                                <p>{{ $order['name'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Adresa:</h3>
                                <p>{{ $order['address'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Grad:</h3>
                                <p>{{ $order['city'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Telefon:</h3>
                                <p>{{ $order['phone'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Email:</h3>
                                <p>{{ $order['email'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Napomena:</h3>
                                <p>{{ $order['comment'] }}</p>
                            </div>
                            <div class="mt-4">
                                <h3 class="font-semibold">Cijena:</h3>
                                <p>{{ $order['price'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
