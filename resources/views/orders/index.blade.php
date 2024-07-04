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
                <x-splade-cell action as="$item">
                    <button
                        onclick="window.location.href='{{ route('orders.show', $item['id']) }}'"
                        class="ml-2 px-3 py-1 text-white rounded bg-green-400 hover:bg-green-500">
                        Detalji
                    </button>

                    <button
                        class="ml-2 px-3 py-1 text-white rounded @if($item['is_approved']) bg-gray-500 @else bg-blue-500 hover:bg-blue-600 @endif"
                        onclick="approveOrder('{{ $item['id'] }}')"
                        {{ $item['is_approved'] ? 'disabled' : '' }}>
                        {{ $item['is_approved'] ? 'Prihvaćeno' : 'Prihvati' }}
                    </button>
                    <button
                        class="ml-2 px-3 py-1 text-white rounded @if($item['is_approved']) bg-gray-500 @else bg-red-500 hover:bg-red-600 @endif"
                        onclick="deleteOrder('{{ $item['id'] }}')"
                        {{ $item['is_approved'] ? 'disabled' : '' }}>
                        Odbij
                    </button>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>

    <script>
        function approveOrder(orderId) {
            axios.post(`api/change-activity/order/${orderId}`, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error toggling order status:', error);
                });
        }
        function deleteOrder(orderId) {
            axios.post(`api/delete-order/${orderId}`, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error toggling order status:', error);
                });
        }
    </script>

</x-app-layout>
