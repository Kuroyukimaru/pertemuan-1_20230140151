<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product List
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your product inventory</p>
                </div>
                @can('manage-products')
                    <x-add-product :url="route('product.create')" :name="'Product'" />
                @endcan
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        {{-- HEADER --}}
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left w-12">#</th>
                                <th class="px-4 py-3 text-left">Product</th>
                                <th class="px-4 py-3 text-left">Stock</th>
                                <th class="px-4 py-3 text-left">Price</th>
                                <th class="px-4 py-3 text-left">Owner</th>
                                <th class="px-4 py-3 text-center w-40">Action</th>
                            </tr>
                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y dark:divide-gray-700">
                            @forelse ($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- NO --}}
                                <td class="px-4 py-3 text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- PRODUCT --}}
                                <td class="px-4 py-3">
                                    <div class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $product->name }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        #{{ $product->id }}
                                    </div>
                                </td>

                                {{-- STOCK --}}
                                <td class="px-4 py-3">
                                    @if($product->qty > 10)
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-700">
                                            Low
                                        </span>
                                    @endif
                                </td>

                                {{-- PRICE --}}
                                <td class="px-4 py-3 font-medium text-gray-700 dark:text-gray-200">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                {{-- OWNER --}}
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="h-7 w-7 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($product->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-700 dark:text-gray-200">
                                            {{ $product->user->name ?? 'Admin' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- ACTION --}}
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-2">

                                        {{-- VIEW --}}
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-white bg-gray-500 rounded-md
                                            hover:bg-blue-600 transition">
                                            View
                                        </a>

                                        {{-- EDIT --}}
                                        @can('update', $product)
                                        <a href="{{ route('product.edit', $product) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-white bg-gray-500 rounded-md
                                            hover:bg-yellow-500 hover:text-black transition">
                                            Edit
                                        </a>
                                        @endcan

                                        {{-- DELETE --}}
                                        @can('delete', $product)
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="px-3 py-1.5 text-xs font-medium text-white bg-gray-500 rounded-md
                                                hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                        @endcan

                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">
                                    Belum ada produk
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>