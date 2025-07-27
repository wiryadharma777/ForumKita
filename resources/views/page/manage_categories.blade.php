@extends('layout.app-v2')

@section('title', ' - Manage Categories')

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
        <h2 class="text-xl font-semibold mb-4">Informasi Categories</h2>

        <a href="/categories/buat-kategori">
            <button
            class="mb-4 bg-blue-400 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-500 transition-colors"
            type="submit">
            BUAT KATEGORI
            </button>
        </a>

        <div class="overflow-x-auto rounded-md">
            <table class="w-full bg-white border border-gray-200 shadow rounded-md overflow-hidden">
            <thead class="bg-blue-100">
                <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Total Diskusi</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @foreach ($allCategories as $category)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration + $allCategories->firstItem() - 1}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $discussionCounts[$category->kategori] ?? 0 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <!-- Edit Button -->
                                <a href="/categories/{{ \Vinkla\Hashids\Facades\Hashids::encode($category->id) }}/edit">
                                    <button class="flex items-center gap-1 px-4 py-2 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 transition">
                                        <!-- Icon Edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l12-12a2.828 2.828 0 10-4-4L5 17v4z" />
                                        </svg>
                                        Edit
                                    </button>
                                </a>
                                <!-- Delete Form -->
                                <form
                                id="delete-form-{{ $category->id }}"
                                action="/categories/delete"
                                method="POST"
                                class="inline">
                                @csrf
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                                    <button type="button"
                                        onclick="confirmDelete({{ $category->id }})"
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
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            </table>
        </div>

        <div class="mt-5">
        {{ $allCategories->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Anda yakin?',
                text: "Kategori dan diskusi terkait kategori ini akan dihapus permanen!",
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
    </script>
</main>

@endsection