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
                    <a href="{{ route('orders.show', $item['id']) }}" class="text-indigo-600 hover:text-indigo-900">Detalji</a>

                    <button
                        class="ml-2 px-3 py-1 text-white rounded @if($item['is_approved']) bg-gray-500 @else bg-blue-500 hover:bg-blue-600 @endif"
                        onclick="toggleOrderStatus('{{ $item['id'] }}')"
                        {{ $item['is_approved'] ? 'disabled' : '' }}>
                        {{ $item['is_approved'] ? 'Prihvaćeno' : 'Prihvati' }}
                    </button>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>

    <script>
        function toggleOrderStatus(orderId) {
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
    </script>

</x-app-layout>
