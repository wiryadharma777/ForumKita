<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ForumKita - Daftar</title>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Icon --}}
  <link rel="icon" href="/img/favicon.png" type="image/png">

</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center px-6 overflow-hidden">
  <div class="max-w-6xl w-full bg-gray-100 flex flex-col md:flex-row items-center justify-center gap-12 py-20">
    <!-- Left side - Illustration -->
    <div class="hidden md:flex flex-1 justify-center items-center relative">
      {{-- <img 
      class="w-[70%] absolute left-[-90px] top-[-330px]"
      src="img/img-daftar.png" alt=""> --}}
      <img 
      class="w-[70%] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -ml-40"
      src="img/img-daftar.png" alt="">
    </div>

    <!-- Right side - Form -->
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-sm">
      <h1 class="font-extrabold text-3xl mb-8 text-center select-none">
        <span class="text-blue-400">Forum</span><span>Kita</span>
      </h1>

      {{-- Notification --}}
      @if (session('success'))
        <div class="mb-4 flex items-center justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md relative transition-all">
          <div class="flex items-center gap-2">
            <!-- Message -->
            <span class="text-sm font-medium">{{ session('success') }} <a href="/login" class=" hover:text-blue-400 hover:underline">Silakan login.</a></span>
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

      <form class="flex flex-col gap-5" action="/daftar" method="POST">
        @csrf

        <div class="flex flex-col">
          <label for="nama" class="mb-1 text-sm font-semibold text-gray-700">Nama</label>
          <input
            class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            id="nama"
            name="nama"
            type="text"
            required
            placeholder="Masukkan Nama"
            required
            value="{{ old('nama') }}"
          />
          @error('nama')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex flex-col">
          <label for="username" class="mb-1 text-sm font-semibold text-gray-700">Username</label>
          <input
            class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            id="username"
            name="username"
            type="text"
            required
            placeholder="Masukkan Username"
            required
            value="{{ old('username') }}"
          />
          @error('username')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex flex-col">
          <label for="email" class="mb-1 text-sm font-semibold text-gray-700">Email</label>
          <input
            class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            id="email"
            name="email"
            type="email"
            required
            placeholder="Masukkan Email"
            required
            value="{{ old('email') }}"
          />
          @error('email')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex flex-col relative">
          <label for="password" class="mb-1 text-sm font-semibold text-gray-700">Password</label>

          <!-- Wrapper relative untuk icon -->
          <div class="relative">
              <input
              class="border border-gray-300 rounded-md px-4 py-2 pr-10 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
              id="password"
              name="password"
              type="password"
              placeholder="Masukkan Password"
              required
              />

              <!-- Eye Icon -->
              <button
              type="button"
              id="togglePassword"
              class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 transition-colors duration-200"
              >
              
              <!-- Icon eye open -->
              <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                
                <!-- Icon eye closed -->
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.67-3.045m1.784-2.347A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-4.293 5.62M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9l18-18" />
                </svg>
              </button>
          </div>

          @error('password')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        
        <div class="flex flex-col relative">
          <label for="password_confirmation" class="mb-1 text-sm font-semibold text-gray-700">Password Confirmation</label>

          <!-- Wrapper relative untuk icon -->
          <div class="relative">
              <input
              class="border border-gray-300 rounded-md px-4 py-2 pr-10 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              placeholder="Konfirmasi Password"
              required
              />

              <!-- Eye Icon -->
              <button
              type="button"
              id="togglePasswordConfirmation"
              class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 transition-colors duration-200"
              >
              <!-- Icon eye open -->
              <svg id="eyeOpenConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>

              <!-- Icon eye closed -->
              <svg id="eyeClosedConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.67-3.045m1.784-2.347A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-4.293 5.62M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 9l18-18" />
              </svg>
              </button>
          </div>

          @error('password_confirmation')
              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="flex items-center justify-between">
          <a href="/login" class="text-xs text-gray-600 hover:text-blue-400 hover:underline select-none">Sudah punya akun?</a>
          <button
            class="bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
            type="submit">
            DAFTAR
          </button>
        </div>
      </form>

    </div>
  </div>
  <script>
    // // Auto Username
    // const nameInput = document.getElementById('nama');
    // const usernameInput = document.getElementById('username');

    // nameInput.addEventListener('input', function() {
    //   // Ambil isi nama
    //   let nama = nameInput.value;

    //   // Buat lowercase, hapus spasi
    //   let username = nama.toLowerCase().replace(/\s+/g, '');

    //   // Isi ke input username
    //   usernameInput.value = username;
    // });

    // Eye Functionality - Password
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    toggleBtn.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        // Toggle icon dengan animasi Tailwind
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

        // Toggle icon dengan animasi Tailwind
        eyeOpenConfirmation.classList.toggle('hidden', !isPassword);
        eyeClosedConfirmation.classList.toggle('hidden', isPassword);
    });

</script>
</body>
</html>