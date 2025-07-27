@extends('layout.app-v2')

@section('title', ' - Manage Users')

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

    <div class="bg-white border border-gray-200 rounded-md p-6 mb-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Users</h2>

        <div class="overflow-x-auto rounded-md">
            <table class="min-w-full bg-white border border-gray-200 shadow rounded-md overflow-hidden">
            <thead class="bg-blue-100">
                <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Username</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @foreach ($allUsers as $oneUser)

                    @if ($oneUser->role != 'admin')
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration + $allUsers->firstItem() - 1}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $oneUser->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $oneUser->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $oneUser->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">{{ $oneUser->role }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($oneUser->status)
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Inactive</span>
                                @endif

                            </td>
                            <td class="px-6 py-4">
                                <form action="/users/activate-deactivate" method="POST">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $oneUser->id }}">

                                    @if ($oneUser->status)
                                        <button
                                            class="bg-red-400 text-white px-3 py-2 rounded-md font-semibold hover:bg-red-500 transition-colors"
                                            type="submit">
                                            Deactivate
                                        </button>
                                    @else
                                        <button
                                            class="bg-green-400 text-white px-3 py-2 rounded-md font-semibold hover:bg-green-500 transition-colors"
                                            type="submit">
                                            Activate
                                        </button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @endif


                @endforeach

            </tbody>
            </table>
        </div>

        <div class="mt-5">
        {{ $allUsers->links() }}
        </div>
    </div>

</main>

@endsection