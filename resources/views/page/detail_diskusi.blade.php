@section('title', '- Detail Diskusi')

@extends('layout.app')

@section('content')

    <section class="flex-1 flex flex-col space-y-6">
        
        <!-- #region Breadcrumbs -->
        <nav class="flex items-center text-gray-600 text-sm" aria-label="Breadcrumb">
            <a href="/" class="flex items-center text-blue-500 hover:text-blue-700 transition-colors">
                <!-- Home icon Heroicons Solid -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 1.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 9h1v7a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1V9h1a1 1 0 00.707-1.707l-7-7z" />
                </svg>
            </a>

            <span class="mx-2 text-white">/</span>

            <span class="text-white font-semibold">Detail Diskusi</span>
        </nav>

        <!-- #endregion -->
        
        <!-- #region Notification -->
        @if (session('success'))
            <div class="mb-4 flex items-start justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md relative transition-all">
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

        <!-- #endregion -->

        <!-- #region Detail Diskusi -->
        <div 
            class="bg-white rounded-lg p-5 shadow relative min-w-[40rem]"
        >
            <div class="flex items-center gap-3 mb-2">
            <div class="flex justify-center items-center w-9 h-9 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm select-none overflow-hidden">
                @if ($discussion->user->pp)
                    <img src="{{ asset($discussion->user->pp) }}" alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                @else
                    @php
                    $nama = trim($discussion->user->nama ?? '');
                    $parts = explode(' ', $nama);
                    $first = strtoupper(substr($parts[0] ?? '', 0, 1));
                    $last = strtoupper(substr(end($parts) ?: '', 0, 1));
                    @endphp
                    {{ $first }}{{ $last }}
                @endif
            </div>
            <p class="text-sm font-semibold text-gray-900">{{ $discussion->user->username }}</p>
            </div>
            <h3 class="font-semibold text-gray-900 text-lg tracking-wide mb-1">{{ $discussion->judul }}</h3>
            <div class="text-gray-600 text-sm mb-3 max-w-[37rem]">{!! $discussion->deskripsi !!}</div>

            <div class="flex items-center gap-3 text-xs text-gray-500">
                <form action="/like" method="POST" class="inline">
                @csrf
                    <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                    <input type="hidden" name="type" value="discussion">

                    <button type="submit"
                        class="flex items-center gap-1 text-red-500 hover:text-red-600 transition-colors duration-150"
                        aria-label="Like">
                        
                        @if ($discussion->is_liked)
                        <!-- Heart Filled -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        @else
                        <!-- Heart Outline -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        @endif

                        <span>{{ $discussion->likes_count}}</span>
                    </button>
                </form>
                <div class="flex items-center gap-1" aria-label="Dilihat">
                    <!-- Ikon Mata -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                        class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $discussion->views_count }}</span>
                </div>

                <span class="flex items-center gap-1 text-gray-400 text-sm">
                    <!-- Icon jam -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $discussion->created_at->diffForHumans() }}
                </span>

                <div class="flex ml-auto gap-2">
                    @if (auth()->check() && auth()->user()->id === $discussion->user_id)
                        <a href="/detail-diskusi/{{ \Vinkla\Hashids\Facades\Hashids::encode($discussion->id) }}/edit">
                            <button class="flex items-center gap-1 px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                                <!-- Icon Edit -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l12-12a2.828 2.828 0 10-4-4L5 17v4z" />
                                </svg>
                                Edit
                            </button>
                        </a>


                        {{-- <form action="/detail-diskusi/delete" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus diskusi ini?')">
                        @csrf
                            <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                            <button type="submit"
                                class="flex items-center gap-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <!-- Icon Delete -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Delete
                            </button>
                        </form> --}}

                        <form id="delete-form-{{ $discussion->id }}"
                        action="/detail-diskusi/delete"
                        method="POST"
                        class="inline">
                        @csrf
                            <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">

                            <button type="button"
                                onclick="confirmDelete({{ $discussion->id }})"
                                class="flex items-center gap-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                <!-- Icon Delete -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    @endif

                    
                </div>
            </div>

            <span class="absolute top-4 right-4 bg-green-400 text-white text-xs font-semibold px-2 py-1 rounded select-none">{{ $discussion->category->kategori }}</span>
        </div>
        <!-- #endregion -->

        <!-- #region Komentar -->
        <div>
            <div class="flex justify-between items-center mb-3">
                <h1 class="font-semibold text-white">KOMENTAR</h1>
                
                <form action="/detail-diskusi/{{ \Vinkla\Hashids\Facades\Hashids::encode($discussion->id) }}" method="GET" x-data="{ open: false }" class="relative inline-block">

                    <!-- Tombol Sort By -->
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-2 bg-blue-400 px-4 py-2 rounded-md text-sm text-white hover:bg-blue-500 transition"
                    >
                        Sort By
                        <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-10"
                    >
                        <button
                            type="submit"
                            name="sortby"
                            value="lattest"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >Latest</button>
                        <button
                            type="submit"
                            name="sortby"
                            value="mostlikes"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >Most Likes</button>
                    </div>
                </form>
            </div>

            <hr class="mb-4 border-white">

            <!-- Looping Komentar -->
            <div class="space-y-4 mb-4 max-h-[19.5rem] overflow-y-auto">
                
                @foreach ($allComments as $comment)
                    <div 
                        class="bg-white rounded-lg p-5 shadow relative min-w-[40rem] border-l-4 border-blue-400"
                    >
                        <div class="flex items-center gap-3 mb-2">
                            <div class="flex justify-center items-center w-9 h-9 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm select-none overflow-hidden">
                                @if ($comment->user->pp)
                                    <img src="{{ asset($comment->user->pp) }}" alt="Foto Profil" class="w-full h-full object-cover rounded-full">
                                @else
                                    @php
                                    $nama = trim($comment->user->nama ?? '');
                                    $parts = explode(' ', $nama);
                                    $first = strtoupper(substr($parts[0] ?? '', 0, 1));
                                    $last = strtoupper(substr(end($parts) ?: '', 0, 1));
                                    @endphp
                                    {{ $first }}{{ $last }}
                                @endif
                            </div>
                            <p class="text-sm font-semibold text-gray-900">{{ $comment->user->username }}</p>
                        </div>
                        <div class="text-gray-600 text-sm mb-3 truncate max-w-[37rem]">{{ $comment->komentar }}</div>
        
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <form action="/like" method="POST" class="inline">
                            @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="type" value="comment">

                                <button type="submit"
                                    class="flex items-center gap-1 text-red-500 hover:text-red-600 transition-colors duration-150"
                                    aria-label="Like">
                                    
                                    @if ($comment->is_liked)
                                    <!-- Heart Filled -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    @else
                                    <!-- Heart Outline -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    @endif

                                    <span>{{ $comment->likes_count }}</span>
                                </button>
                            </form>
        
                            <span class="flex items-center gap-1 text-gray-400 text-sm">
                                <!-- Icon jam -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Komentar Form -->
            <div 
                    class="bg-white rounded-lg p-5 shadow relative min-w-[40rem]"
                >
                    <form action="/komentar" method="POST">
                        @csrf

                        <input type="hidden" name="type" value="discussion">
                        <input type="hidden" value="{{ $discussion->id }}" name="discussion_id"/>

                        <div class="relative w-full">
                            
                            <input
                            class="border border-gray-300 rounded-md px-4 py-2 pr-20 w-full focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                            id="komentar"
                            name="komentar"
                            type="text"
                            placeholder="Masukkan Komentar"
                            required
                            />

                            <button
                            type="submit"
                            class="absolute inset-y-0 right-0 flex items-center px-4 bg-blue-400 text-white rounded-r-md hover:bg-blue-500 transition-colors duration-200"
                            >
                            Kirim
                            </button>
                        </div>


                    </form>
            </div>
        </div>
        <!-- #endregion -->
        
    </section>
    
    <script>
        // #region Sweetalert Delete Diskusi
        function confirmDelete(id) {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Diskusi akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // #endregion
    </script>
@endsection