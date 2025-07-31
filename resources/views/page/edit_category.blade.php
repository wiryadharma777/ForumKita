@extends('layout.app-v2')

@section('title', ' - Manage Categories')

@section('content')

<main class="flex-1 p-6">

    <!-- #region Breadcrumbs -->
    <nav class="flex items-center text-gray-600 text-sm" aria-label="Breadcrumb">
        <a href="/categories" class="flex items-center text-blue-500 hover:text-blue-700 transition-colors">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.707 1.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 9h1v7a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1V9h1a1 1 0 00.707-1.707l-7-7z" />
            </svg>
        </a>

        <span class="mx-2 text-gray-400">/</span>

        <span class="text-gray-800 font-semibold">Edit Kategori</span>
    </nav>
    <!-- #endregion -->

    <div class="bg-white border border-gray-200 rounded-md p-6 mb-6 mt-6">
        
        <!-- #region Notification -->
        @if (session('success'))
            <div class="mb-4 flex items-start justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md transition-all">
                <div class="flex items-center gap-2">
                <
                <span class="text-sm font-medium">{{ session('success') }} <a href="/login" class=" hover:text-blue-400 hover:underline"></a></span>
                </div>
                
                <button
                onclick="this.parentElement.classList.add('opacity-0'); setTimeout(() => this.parentElement.remove(), 300);"
                class="ml-4 text-green-600 hover:text-green-800 transition-colors"
                >
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
        @endif
        <!-- #endregion -->

        <!-- #region Form Edit Kategori -->
        <form action="/categories/edit" method="POST">
            @csrf

            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="flex flex-col">
                <label for="kategori" class="mb-1 text-sm font-semibold text-gray-700">Judul</label>
                <input
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    id="kategori"
                    name="kategori"
                    type="text"
                    placeholder="Masukkan Kategori"
                    value="{{ old('kategori', $category->kategori)}}"
                    required
                    autocomplete="off"
                />
                @error('kategori')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button
                class="mt-4 bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
                type="submit">
                EDIT
            </button>
        </form>
        <!-- #endregion -->
        
    </div>

</main>

@endsection