@section('title', '- Buat Diskusi Baru')

@extends('layout.app')

@section('content')
    <section class="flex flex-col flex-1">
        <nav class="flex items-center text-gray-600 text-sm mb-4" aria-label="Breadcrumb">
            <a href="/" class="flex items-center text-blue-500 hover:text-blue-700 transition-colors">
                <!-- Home icon Heroicons Solid -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 1.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 9h1v7a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1V9h1a1 1 0 00.707-1.707l-7-7z" />
                </svg>
            </a>

            <span class="mx-2 text-gray-700">/</span>

            <span class="text-gray-700 font-semibold">Buat Diskusi Baru</span>
        </nav>

        <div class="bg-white rounded-lg p-5 shadow w-[45rem]">

            {{-- Notifications --}}
            @if (session('success'))
                <div class="mb-4 flex items-center justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md relative transition-all">
                    <div class="flex items-center gap-2">
                    <!-- Message -->
                    <span class="text-sm font-medium">{{ session('success') }} <a href="/login" class=" hover:text-blue-400 hover:underline"></a></span>
                    </div>

                    <!-- Close button -->
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

            <form action="/buat-diskusi-baru" method="POST">
            @csrf

                <div class="flex flex-col mb-4">
                    <label for="judul" class="mb-1 text-sm font-semibold text-gray-700">Judul</label>
                    <input
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        id="judul"
                        name="judul"
                        type="text"
                        placeholder="Masukkan Judul"
                        value="{{ old('judul') }}"
                        required
                        autocomplete="off"
                    />
                    @error('judul')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kategori" class="mb-1 text-sm font-semibold text-gray-700">Kategori</label>

                    <div class="relative">
                        <select
                            id="kategori"
                            name="kategori"
                            class="appearance-none w-full border border-gray-300 rounded-md px-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent cursor-pointer"
                            required
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->kategori }}" {{ old('kategori') == $category->kategori ? 'selected' : '' }}>{{ $category->kategori }}</option>
                            @endforeach

                            {{-- <option value="Front End" {{ old('kategori') == 'Front End' ? 'selected' : '' }}>Front End</option>
                            <option value="Back End" {{ old('kategori') == 'Back End' ? 'selected' : '' }}>Back End</option>
                            <option value="Database" {{ old('kategori') == 'Database' ? 'selected' : '' }}>Database</option>
                            <option value="Deployment" {{ old('kategori') == 'Deployment' ? 'selected' : '' }}>Deployment</option> --}}
                        </select>

                        @error('kategori')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
        
                        <!-- Custom Arrow Icon -->
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="">
                    <label for="deskripsi" class="mb-1 text-sm font-semibold text-gray-700">Deskripsi</label>
                    
                    <input id="deskripsi" type="hidden" name="deskripsi" required>
                    <trix-editor input="deskripsi"></trix-editor>
                    
                    @error('deskripsi')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button
                class="mt-4 bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
                type="submit">
                POST
                </button>
            </form>
        </div>
    </section>
@endsection