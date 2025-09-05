<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ForumKita - Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/favicon.png" type="image/png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .register-button {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }
        .register-button:hover {
            background: linear-gradient(90deg, #60a5fa, #3b82f6);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
    <div class="w-full max-w-6xl h-[600px] bg-white rounded-2xl shadow-lg flex flex-row-reverse overflow-hidden">
        <div class="relative flex-1 p-12 flex flex-col justify-center items-start text-white bg-gradient-to-br from-blue-700 to-blue-400">
            <h1 class="text-4xl font-bold mb-4">
                Bergabung dengan <span class="text-blue-200">Komunitas Kami</span>
            </h1>
            <p class="text-lg font-light leading-relaxed max-w-md">
                Daftar sekarang untuk mulai berbagi kode, menanyakan pertanyaan teknis, dan berkolaborasi dengan sesama developer.
            </p>
            <div class="absolute bottom-0 left-0 w-full h-full">
                <div class="absolute w-24 h-2 bg-white opacity-20 transform rotate-45 top-1/4 left-1/4"></div>
                <div class="absolute w-32 h-2 bg-white opacity-20 transform -rotate-12 top-1/2 left-1/2"></div>
                <div class="absolute w-48 h-2 bg-white opacity-20 transform rotate-30 bottom-1/4 right-1/4"></div>
                <div class="absolute w-20 h-2 bg-white opacity-20 transform -rotate-60 top-1/3 right-1/4"></div>
                <div class="absolute w-36 h-2 bg-white opacity-20 transform rotate-15 bottom-1/3 left-1/4"></div>
            </div>
        </div>
      
        <div class="w-full md:w-1/2 lg:w-2/5 p-10 flex flex-col justify-center items-center bg-white">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">
                DAFTAR AKUN
            </h2>

            @if (session('success'))
                <div class="mb-4 flex items-center justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md relative transition-all w-full">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium">{{ session('success') }} <a href="/login" class="hover:text-blue-400 hover:underline">Silakan login.</a></span>
                    </div>
                    <button
                        onclick="this.parentElement.classList.add('opacity-0'); setTimeout(() => this.parentElement.remove(), 300);"
                        class="ml-4 text-green-600 hover:text-green-800 transition-colors"
                    >
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <form class="flex flex-col gap-6 w-full" action="/daftar" method="POST">
                @csrf

                <div class="flex flex-col relative">
                    <label for="nama" class="mb-1 text-sm font-semibold text-gray-700 sr-only">Nama</label>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <input
                            class="border border-gray-300 rounded-full px-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 w-full"
                            id="nama"
                            name="nama"
                            type="text"
                            required
                            placeholder="Nama Lengkap"
                            value="{{ old('nama') }}"
                        />
                    </div>
                    @error('nama')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col relative">
                    <label for="username" class="mb-1 text-sm font-semibold text-gray-700 sr-only">Username</label>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H9V7a3 3 0 016 0v2a2 2 0 002 2v5a2 2 0 002 2h1a1 1 0 100-2h-1v-5a4 4 0 00-4-4V7a5 5 0 00-5-5z" />
                        </svg>
                        <input
                            class="border border-gray-300 rounded-full px-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 w-full"
                            id="username"
                            name="username"
                            type="text"
                            required
                            placeholder="Username"
                            value="{{ old('username') }}"
                        />
                    </div>
                    @error('username')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col relative">
                    <label for="email" class="mb-1 text-sm font-semibold text-gray-700 sr-only">Email</label>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <input
                            class="border border-gray-300 rounded-full px-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300 w-full"
                            id="email"
                            name="email"
                            type="email"
                            required
                            placeholder="Email"
                            value="{{ old('email') }}"
                        />
                    </div>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col relative">
                    <label for="password" class="mb-1 text-sm font-semibold text-gray-700 sr-only">Password</label>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2h2a2 2 0 012 2v5a2 2 0 01-2 2H3a2 2 0 01-2-2v-5a2 2 0 012-2h2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        <input
                            class="border border-gray-300 rounded-full px-12 py-3 pr-16 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Password"
                            required
                        />
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                        >
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.67-3.045m1.784-2.347A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-4.293 5.62M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9l18-18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex flex-col relative">
                    <label for="password_confirmation" class="mb-1 text-sm font-semibold text-gray-700 sr-only">Konfirmasi Password</label>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2h2a2 2 0 012 2v5a2 2 0 01-2 2H3a2 2 0 01-2-2v-5a2 2 0 012-2h2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        <input
                            class="border border-gray-300 rounded-full px-12 py-3 pr-16 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Konfirmasi Password"
                            required
                        />
                        <button
                            type="button"
                            id="togglePasswordConfirmation"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                        >
                            <svg id="eyeOpenConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeClosedConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.67-3.045m1.784-2.347A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-4.293 5.62M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9l18-18" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button
                    class="register-button text-white px-5 py-3 rounded-full font-semibold transition-all duration-300 shadow-md hover:shadow-lg mt-4"
                    type="submit">
                    DAFTAR
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm">
                Sudah punya akun? <a href="/login" class="text-blue-500 hover:text-blue-700 font-semibold">Login sekarang</a>
            </div>
        </div>

        

    </div>
    
    <script>
        // #region Password Hider
        // Eye Functionality - Password
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');
        
        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            
            eyeOpen.classList.toggle('hidden', !isPassword);
            eyeClosed.classList.toggle('hidden', isPassword);
        });
        
        // Eye Functionality - Password Confirmation
        const passwordInputConfirmation = document.getElementById('password_confirmation');
        const toggleBtnConfirmation = document.getElementById('togglePasswordConfirmation');
        const eyeOpenConfirmation = document.getElementById('eyeOpenConfirmation');
        const eyeClosedConfirmation = document.getElementById('eyeClosedConfirmation');
        
        toggleBtnConfirmation.addEventListener('click', () => {
            const isPassword = passwordInputConfirmation.type === 'password';
            passwordInputConfirmation.type = isPassword ? 'text' : 'password';
            
            eyeOpenConfirmation.classList.toggle('hidden', !isPassword);
            eyeClosedConfirmation.classList.toggle('hidden', isPassword);
        });
        // #endregion
    </script>
</body>
</html>