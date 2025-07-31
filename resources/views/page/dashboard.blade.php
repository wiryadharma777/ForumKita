@extends('layout.app-v2')

@section('title', '- Dashboard')

@section('content')

    <main class="flex-1 p-6">
        <div class="w-full bg-blue-50 border border-blue-100 rounded-md p-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Dashboard</h2>

            <!-- #region Dashboard Parameter -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Discussions -->
                <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center gap-3 shadow min-h-[180px]">
                    <div class="bg-blue-100 p-3 rounded-full">
                    <!-- Icon -->
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                    </svg>
                    </div>
                    <div class="text-center">
                    <div class="text-gray-500 text-sm">Total Discussions</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $totalDiscussions }}</div>
                    </div>
                </div>
        
                <!-- Total Views -->
                <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center gap-3 shadow min-h-[180px]">
                    <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    </div>
                    <div class="text-center">
                    <div class="text-gray-500 text-sm">Total Views</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $totalViews }}</div>
                    </div>
                </div>
        
                <!-- Total Likes -->
                <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center gap-3 shadow min-h-[180px]">
                    <div class="bg-pink-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.682 4.318 12.682a4.5 4.5 0 010-6.364z" />
                    </svg>
                    </div>
                    <div class="text-center">
                    <div class="text-gray-500 text-sm">Total Likes</div>
                    <div class="text-2xl font-bold text-gray-800">
                        <span class="text-xs text-gray-500">Discussions</span>&nbsp;{{ $totalLikesDiscussions }}
                        <span class="mx-1">/</span>
                        {{ $totalLikesComments }}&nbsp;<span class="text-xs text-gray-500">Comments</span>
                    </div>
                    </div>
                </div>
        
                <!-- Total Comments -->
                <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-center gap-3 shadow min-h-[180px]">
                    <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v7a2 2 0 01-2 2h-2m-4 0H7l-4 4V4a2 2 0 012-2h12a2 2 0 012 2v4" />
                    </svg>
                    </div>
                    <div class="text-center">
                    <div class="text-gray-500 text-sm">Total Comments</div>
                    <div class="text-2xl font-bold text-gray-800">
                        <span class="text-xs text-gray-500">All</span>&nbsp;{{ $totalComments }}
                        <span class="mx-1">/</span>
                        {{ $totalCommentsUnique }}&nbsp;<span class="text-xs text-gray-500">Unique</span>
                    </div>
                    </div>
                </div>
            </div>
            <!-- #endregion -->
        </div>
    </main>
    
@endsection