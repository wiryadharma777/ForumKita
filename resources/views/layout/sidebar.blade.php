<aside class="w-72 flex flex-col space-y-6">

<!-- #region Buat Diskusi Baru -->

<section class="bg-white rounded-lg p-6 shadow-md">
    <a href="/buat-diskusi-baru"
        class="bg-blue-400 hover:bg-blue-500 text-white text-sm rounded px-4 py-2 font-semibold uppercase tracking-wide transition-colors duration-150">
        Buat Diskusi Baru
    </a>
    <p class="mt-2 text-gray-500 text-sm leading-relaxed">
    Buat postingan baru untuk memulai topik.
    </p>
</section>

<!-- #endregion -->

<!-- #region Filter Kategori -->

<section aria-labelledby="kategori" class="bg-white rounded-lg shadow-md p-4">
    <h2 id="kategori" class="font-semibold text-gray-700 mb-2 uppercase text-sm tracking-wide pb-2 border-b border-slate-300">Kategori</h2>
    <ul class="divide-y divide-gray-100">

    @foreach ($allCategories as $category)
        <li class="flex justify-between items-center py-2 last:pb-0">
            <a href="{{ route('search', [
            'search' => request('search'),
            'kategori' => $category->kategori,
            'populer' => request('populer')])}}"
            class="text-gray-700 cursor-pointer hover:text-blue-500 transition-colors duration-200">
                {{ $category->kategori }}
            </a>
            <span class="bg-green-400 text-white text-xs font-semibold rounded px-2 py-0.5 select-none">
                {{ $discussionCounts[$category->kategori] ?? 0}}
            </span>
        </li>
    @endforeach
    </ul>

    @if(request('kategori'))
        @php
        $onlyKategori = !request('search') && !request('populer');
        @endphp

        @if($onlyKategori)
        <a href="/"
            class="inline-flex items-center gap-1 mt-4 text-xs text-gray-500 hover:text-red-500 hover:underline transition-colors duration-200">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Clear Kategori Filter
        </a>
        @else
        <a href="{{ route('search', request()->except('kategori')) }}"
            class="inline-flex items-center gap-1 mt-4 text-xs text-gray-500 hover:text-red-500 hover:underline transition-colors duration-200">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Clear Kategori Filter
        </a>
        @endif
    @endif
</section>

<!-- #endregion -->

<!-- #region Filter Most -->

<section aria-label="Popular info" class="bg-white rounded-lg p-4 shadow-md text-gray-700 text-sm">

    <a href="{{ route('search', [
        'search' => request('search'),
        'kategori' => request('kategori'),
        'populer' => 'views'
    ]) }}">
        <p class="flex items-center gap-2 pb-2 border-b border-gray-100 hover:text-blue-500 transition-colors duration-200 mb-2">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Most Views
        </p>
    </a>

    <a href="{{ route('search', [
        'search' => request('search'),
        'kategori' => request('kategori'),
        'populer' => 'likes'
    ]) }}">
        <p class="flex items-center gap-2 pb-2 border-b border-gray-100 hover:text-blue-500 transition-colors duration-200 mb-2">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 010 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            Most Likes
        </p>
    </a>

    <a href="{{ route('search', [
        'search' => request('search'),
        'kategori' => request('kategori'),
        'populer' => 'comments'
    ]) }}">
        <p class="flex items-center gap-2 hover:text-blue-500 transition-colors duration-200">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h6m-6 4h4m-6 4l-4-4V4a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H7z" />
            </svg>
            Most Comments
        </p>
    </a>

    @if(request('populer'))
        @php
            $onlyPopuler = !request('search') && !request('kategori');
        @endphp

        @if($onlyPopuler)
            <a href="/"
            class="inline-flex items-center gap-1 mt-4 text-xs text-gray-500 hover:text-red-500 hover:underline transition-colors duration-200">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Clear Populer Filter
            </a>
        @else
            <a href="{{ route('search', request()->except('populer')) }}"
            class="inline-flex items-center gap-1 mt-4 text-xs text-gray-500 hover:text-red-500 hover:underline transition-colors duration-200">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Clear Populer Filter
            </a>
        @endif
    @endif

</section>

<!-- #endregion -->


</aside>