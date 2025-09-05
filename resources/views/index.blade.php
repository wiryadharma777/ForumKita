@section('title', '- Beranda')

@extends('layout.app')

@section('content')

  <section class="flex-1 flex flex-col space-y-6">

    <!-- #region Search Result -->

    @if(request('search') || request('kategori') || request('populer'))
      <p class="text-sm text-gray-700">
          Menampilkan hasil
          @if(request('search'))
              untuk:
              <span class="font-semibold text-blue-400">
                  "{{ request('search') }}"
              </span>
          @endif

          @if(request('kategori'))
              @if(request('search'))
                  <span class="mx-1">|</span>
              @endif
              Kategori:
              <span class="font-semibold text-green-400">
                  "{{ request('kategori') }}"
              </span>
          @endif

          @if(request('populer'))
              @if(request('search') || request('kategori'))
                  <span class="mx-1">|</span>
              @endif
              Populer:
              <span class="font-semibold text-red-400">
                  @if(request('populer') === 'views')
                      Most Views
                  @elseif(request('populer') === 'likes')
                      Most Likes
                  @elseif(request('populer') === 'comments')
                      Most Comments
                  @endif
              </span>
          @endif
      </p>
    @endif

    <!-- #endregion -->
    
    <!-- #region Notification -->

    @if (session('success'))
      <div class="flex items-center justify-between rounded-md border border-green-300 bg-green-50 p-4 text-green-800 shadow-md relative transition-all">
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

    <!-- #region Looping Disucssion Card -->
    @if($allDiscussions->isEmpty())

      <div class="flex flex-col items-center justify-center py-12 text-center">
        <img src="/img/img-not-available.png" alt="Tidak ada diskusi" class="w-120 mb-2">
        <p class="text-gray-700 text-md">
          Tidak ada diskusi ditemukan. Silakan coba kata kunci atau filter lain.
          {{-- @if (request('search') || request('kategori') || request('populer'))
            
          @endif --}}
        </p>
    </div>
    
    @else

      @foreach ($allDiscussions as $discussion)

          <div 
            class="bg-white rounded-lg p-5 shadow hover:shadow-lg transition-shadow duration-200 relative min-w-[40rem]"
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
            <a href="/detail-diskusi/{{ \Vinkla\Hashids\Facades\Hashids::encode($discussion->id) }}"
            class="hover:underline text-gray-900 hover:text-blue-500 transition-colors ">
              <h3 class="font-semibold text-lg tracking-wide mb-1 inline">{{ $discussion->judul }}</h3>
            </a>
            <div class="text-gray-600 text-sm mb-3 line-clamp-1 max-w-[37rem]">
                {!! $discussion->deskripsi !!}
            </div>


            <div class="flex items-center gap-3 text-xs text-gray-500">
              
              <!-- #region Form Like -->

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

                  <span>{{ $discussion->likes_count }}</span>
                </button>
              </form>

              <!-- #endregion -->

              <!-- Komentar -->
              <div class="flex items-center gap-1 text-green-400" aria-label="Komentar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H9l-4 4v-4H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span>{{ $discussion->comments_count }} komentar</span>
              </div>

              <!-- Views -->
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

              <!-- Time -->
              <span class="flex items-center gap-1 text-gray-400 text-sm">
                
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
            </div>

            <span class="absolute top-4 right-4 bg-green-400 text-white text-xs font-semibold px-2 py-1 rounded select-none">{{ $discussion->category->kategori }}</span>
          </div>
          
      @endforeach

    @endif

    <!-- #endregion -->

    <!-- #region Pagination -->

    <div>
      {{ $allDiscussions->links() }}
    </div>

    <!-- #endregion -->
    
  </section>
  
@endsection


