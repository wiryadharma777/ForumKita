<header class="bg-white shadow px-6 py-3 flex items-center justify-between sticky top-0 z-100">
    <h1 class="text-2xl font-extrabold text-gray-900">
        <a href="/"><span class="text-blue-400">Forum</span><span>Kita</span></a>
    </h1>
    
    <!-- #region Profile & Logout -->
    <div class="flex items-center gap-4">
        
        <!-- #region Profil -->
        @auth
            <div class="relative inline-block text-left" x-data="{ open: false }">
                
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

                <!-- Dropdown -->
                <div 
                    x-show="open"
                    x-cloak
                    @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-50"
                >
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12h6V3H3v9zm0 9h6v-6H3v6zm9 0h9v-9h-9v9zm0-18v6h9V3h-9z" />
                        </svg>
                        Dashboard
                    </a>
                    
                    <!-- #region Logout Form -->
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            
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
        <!-- #endregion -->
    </div>
    <!-- #endregion -->

</header>
