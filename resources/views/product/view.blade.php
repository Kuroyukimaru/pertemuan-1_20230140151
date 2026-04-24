<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">

                            <a href="{{ route('product.index') }}"
                                class="p-2 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                                    Product Details
                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    ID: <span class="font-medium text-gray-700 dark:text-gray-300">
                                        #{{ $product->id }}
                                    </span>
                                </p>
                            </div>

                        </div>

                        {{-- ACTION --}}
                        <div class="flex gap-2">

                            <a href="{{ route('product.edit', $product) }}"
                                class="px-3 py-2 text-sm font-medium rounded-lg bg-amber-500 hover:bg-amber-600 text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-2 text-sm font-medium rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>

                    {{-- DETAIL --}}
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg divide-y dark:divide-gray-700">

                        {{-- ITEM --}}
                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Product Name</div>
                            <div class="col-span-2 font-semibold text-gray-800 dark:text-gray-100">
                                {{ $product->name }}
                            </div>
                        </div>

                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Quantity</div>
                            <div class="col-span-2">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded
                                    {{ $product->qty > 10
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                        : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' }}">
                                    {{ $product->qty }}
                                    ({{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }})
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Price</div>
                            <div class="col-span-2 font-semibold text-gray-800 dark:text-gray-100">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Owner</div>
                            <div class="col-span-2 flex items-center gap-2">
                                <div
                                    class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($product->user->name ?? '?', 0, 1) }}
                                </div>

                                <span class="text-sm text-gray-800 dark:text-gray-100">
                                    {{ $product->user->name ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Created</div>
                            <div class="col-span-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ $product->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-3 px-5 py-4 items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Updated</div>
                            <div class="col-span-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ $product->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>