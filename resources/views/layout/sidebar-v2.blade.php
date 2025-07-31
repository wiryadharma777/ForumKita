<aside style="background-image: url('/img/side-background-2.png');" class="sticky top-16 w-64 h-[calc(100vh-4rem)] bg-white border-r border-gray-200 p-6 overflow-y-auto">
    
    @if (auth()->user()->role === 'user' || auth()->user()->role === 'admin')
        <h2 class="font-semibold text-gray-700 mb-2 uppercase text-sm tracking-wide pb-2 border-b border-slate-300">Dashboard</h2>
        
        <!-- Menu -->
        <nav class="">
            <a href="/dashboard" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition border-b border-gray-100 py-2">
            <!-- Icon User -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12h6V3H3v9zm0 9h6v-6H3v6zm9 0h9v-9h-9v9zm0-18v6h9V3h-9z" />
            </svg>
            Dashboard
            </a>

            <a href="/profile" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition border-b border-gray-100 py-2">
            <!-- Icon User -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.287.535 6.121 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Profil
            </a>

            <a href="/" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition py-2">
            <!-- Icon Home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 22V12h6v10" />
            </svg>
            Beranda
            </a>
        </nav>
    @endif

    @if (auth()->user()->role === 'admin')
        <h2 class="mt-3 font-semibold text-gray-700 mb-2 uppercase text-sm tracking-wide pb-2 border-b border-slate-300">Admin</h2>

        <nav class="">
            <a href="/users" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition border-b border-gray-100 py-2">
            <!-- Icon Users Group -->
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m6-4a4 4 0 11-8 0 4 4 0 018 0zM17 11a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            Manage Users
            </a>

            <a href="/categories" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition py-2">
            <!-- Icon Tag -->
            <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 7a2 2 0 012-2h5l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
            </svg>
            Manage Categories
            </a>
        </nav>
    @endif

</aside>