@extends('layout.app-v2')

@section('title', ' - Profile')

@section('content')

<main class="flex-1 p-6">

    {{-- Notification --}}
    @if (session('success'))
        <div class="flex items-start justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md transition-all">
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

    <div class="bg-blue-50 border border-blue-100 rounded-md p-6 mb-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Profil</h2>

        <form action="/profile/process" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-xl font-bold text-blue-600 overflow-hidden">
                        @if ($user->pp)
                            <img src="{{ asset($user->pp) }}" alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                        @else
                            @php
                                $nama = trim($user->nama);
                                $parts = explode(' ', $nama);
                                $first = strtoupper(substr($parts[0], 0, 1));
                                $last = strtoupper(substr(end($parts), 0, 1));
                            @endphp
                            {{ $first }}{{ $last }}
                        @endif
                    </div>

                    <label class="flex flex-col">
                        <span class="block text-sm font-medium text-gray-700 mb-1">Upload Foto</span>
                        <input 
                        type="file" 
                        name="pp"
                        id="pp"
                        accept="image/*"
                        class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                                cursor-pointer"
                        />
                        @error('pp')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-gray-700">Nama</label>
                <input type="text" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                name="nama"
                value="{{ $user->nama }}">
            </div>

            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                name="email"
                value="{{ $user->email }}"
                readonly>
            </div>
            
            <button
                class="bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
                type="submit">
                Simpan
            </button>
        </form>
    </div>

    <!-- Ganti Password -->
    <div class="bg-white border border-gray-200 rounded-md p-6">
        <h2 class="text-xl font-semibold mb-4">Ganti Password</h2>

        <form action="/reset-password/process" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Password Sebelumnya</label>
                <input type="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                name="password_sebelumnya"
                placeholder="Password Sebelumnya"
                required
                >
                @error('password_sebelumnya')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Password Baru</label>
                <input type="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                name="password_baru"
                placeholder="Password Baru"
                required
                >
                @error('password_baru')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" 
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                name="password_baru_confirmation"
                placeholder="Konfirmasi Password Baru"
                required
                >
                @error('password_baru_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button
            class="bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
            type="submit">
            Simpan
            </button>
        </form>
    </div>
</main>

@endsection