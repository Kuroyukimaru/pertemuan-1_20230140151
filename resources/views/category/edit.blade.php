<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Edit Category
                </h2>

                <a href="{{ route('category.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white text-sm rounded-lg hover:bg-gray-600 transition">
                    Kembali
                </a>
            </div>

            {{-- ALERT ERROR --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form action="/category/{{ $category->id }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- INPUT --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Category
                        </label>

                        <input type="text" name="name"
                            value="{{ old('name', $category->name) }}"
                            placeholder="Contoh: Elektronik"
                            class="w-full px-4 py-2.5 rounded-lg border text-sm
                            {{ $errors->has('name') 
                                ? 'border-red-400 bg-red-50 dark:bg-red-900/20' 
                                : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                            text-gray-900 dark:text-gray-100
                            focus:outline-none focus:ring-2 focus:ring-indigo-500">

                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-lg shadow-sm transition">
                            Update
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>