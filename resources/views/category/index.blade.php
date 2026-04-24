<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- =========================
                 HEADER HALAMAN
            ========================= --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Data Category
                </h2>

                {{-- tombol tambah category --}}
                <a href="{{ route('category.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                    Tambah Category
                </a>
            </div>

            {{-- =========================
                 ALERT SUCCESS
            ========================= --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- =========================
                 TABLE DATA CATEGORY
            ========================= --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        {{-- HEADER TABLE --}}
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">Nama Category</th>
                                <th class="px-4 py-3 text-left">Total Product</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        {{-- BODY TABLE --}}
                        <tbody class="divide-y dark:divide-gray-700">

                            {{-- LOOP DATA CATEGORY --}}
                            @forelse($categories as $index => $c)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                    {{-- NO URUT --}}
                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- NAMA CATEGORY --}}
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-100 font-medium">
                                        {{ $c->name }}
                                    </td>

                                    {{-- JUMLAH PRODUCT DALAM CATEGORY --}}
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                            {{ $c->products_count }} Produk
                                        </span>
                                    </td>

                                    {{-- AKSI (EDIT & DELETE) --}}
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">

                                            {{-- tombol edit --}}
                                            <a href="{{ route('category.edit', $c->id) }}"
                                                class="px-3 py-1 text-xs bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                                Edit
                                            </a>

                                            {{-- form delete category --}}
                                            <form action="{{ route('category.destroy', $c->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus category ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-3 py-1 text-xs bg-red-500 text-white rounded-md hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty

                                {{-- kalau data kosong --}}
                                <tr>
                                    <td colspan="4" class="text-center py-10 text-gray-500">
                                        Belum ada category
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