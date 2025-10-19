<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <p class="text-lg font-medium text-gray-700">Kelola lowongan kerja yang tersedia.</p>
                        <a href="{{ route('jobs.create') }}"
                           class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold shadow transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                            Tambah Lowongan
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Judul</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Perusahaan</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lokasi</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Gaji</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Logo</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($jobs as $job)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->title }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->company }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->location }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->salary }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            @if($job->logo)
                                                <img src="{{ asset('storage/' . $job->logo) }}"
                                                     alt="Logo {{ $job->company }}"
                                                     class="h-12 w-12 rounded object-cover" />
                                            @else
                                                <span class="text-xs text-gray-400">Tidak ada logo</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('jobs.show', $job->id) }}"
                                                   class="inline-flex items-center rounded-md border border-transparent bg-yellow-500 px-3 py-1 text-xs font-semibold transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                                    Show
                                                </a>
                                                {{-- Jika Admin --}}
                                                @if(Auth::check() && Auth::user()->role === 'admin')
                                                <a href="{{ route('applications.index', $job->id) }}"
                                                   class="inline-flex items-center rounded-md border border-transparent bg-yellow-500 px-3 py-1 text-xs font-semibold transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                                    Daftar Pelamar
                                                </a>
                                                <a href="{{ route('jobs.edit', $job->id) }}"
                                                   class="inline-flex items-center rounded-md border border-transparent bg-yellow-500 px-3 py-1 text-xs font-semibold transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                                    Edit
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-3 py-1 text-xs font-semibold transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                                                        Hapus
                                                    </button>
                                                </form>
                                                {{-- Jika User Biasa --}}
                                                @elseif(Auth::check() && Auth::user()->role === 'user')
                                                <form action="{{ route('apply.store', $job->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="cv" required>
                                                    <button type="submit" class="btn btn-primary">Lamar</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                            Belum ada lowongan yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
