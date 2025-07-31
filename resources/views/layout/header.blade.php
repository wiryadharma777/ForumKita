<header class="bg-white shadow px-6 py-3 flex items-center justify-between sticky top-0 z-50">
    
    <h1 class="text-2xl font-extrabold text-gray-900">
        <a href="/"><span class="text-blue-400">Forum</span><span>Kita</span></a>
    </h1>

    <!-- #region Form Search -->

    <form action="/search" method="get"
        class="flex flex-1 max-w-md mx-6 relative" role="search" aria-label="Pencarian topik">

        <!-- #region Check Request Filter -->
        @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif

        @if(request('populer'))
            <input type="hidden" name="populer" value="{{ request('populer') }}">
        @endif

        <!-- #endregion -->

        <label for="search" class="sr-only">Cari Topik</label>

        <input 
            type="text" 
            id="search" 
            class="w-full rounded-md border border-gray-300 bg-blue-50 pl-10 pr-8 py-2 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" 
            placeholder="Cari Topik..." 
            name="search"
            value="{{ request('search') }}"
            required
        />

        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none" aria-hidden="true" id="search-icon">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>

        @if(request('search'))
            @php
                $onlySearch = !request('kategori') && !request('populer');
            @endphp

            <a href="{{ $onlySearch ? '/' : route('search', request()->except('search')) }}"
                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-red-500 transition"
                aria-label="Clear Search">
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>
        @endif

    </form>

    <!-- #endregion -->
    
    <!-- #region Profile & logout -->

    <div class="flex items-center gap-4">
        @auth
            <div class="relative inline-block text-left" x-data="{ open: false }">
                
                <!-- #region Profile -->

                <button @click="open = !open" class="flex items-center gap-0.5 focus:outline-none">
                    <div class="flex justify-center items-center w-9 h-9 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm select-none overflow-hidden">
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
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- #endregion -->

                <!-- Dropdown -->
                <div 
                    x-show="open"
                    x-cloak
                    @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-50"
                >
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <!-- Icon Dashboard (Squares) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12h6V3H3v9zm0 9h6v-6H3v6zm9 0h9v-9h-9v9zm0-18v6h9V3h-9z" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- #region Logout -->

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <!-- Icon Logout -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-11V4" />
                            </svg>
                            Logout
                        </button>
                    </form>

                    <!-- #endregion -->

                </div>
            </div>
        @endauth
    </div>

    <!-- #endregion -->

</header>
