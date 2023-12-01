<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="border px-6 py-4">No</th>
                        <th class="border px-6 py-4">User</th>
                        <th class="border px-6 py-4">Food</th>
                        <th class="border px-6 py-4">Quantity</th>
                        <th class="border px-6 py-4">Total</th>
                        <th class="border px-6 py-4">Status</th>
                        <th class="border px-6 py-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($transaction as $item)
                            <tr>
                                <td class="border px-6 py-4">{{ $loop->index+1 }}</td>
                                <td class="border px-6 py-4">{{ $item->user->name }}</td>
                                <td class="border px-6 py-4">{{ $item->food->name }}</td>
                                <td class="border px-6 py-4">{{ $item->quantity }}</td>
                                <td class="border px-6 py-4">Rp. {{ number_format($item->total) }}</td>
                                <td class="border px-6 py-4">{{ $item->status }}</td>
                                <td class="border px-6 py- text-center">
                                    <a href="{{ route('transactions.show', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                               <td colspan="7" class="border text-center p-5">
                                   There is no data here
                               </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $transaction->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
