<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul Lowongan" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <x-input-label for="location" value="Lokasi" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="company" value="Nama Perusahaan" />
                                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company')" required />
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <x-input-label for="salary" value="Gaji" />
                                <x-text-input id="salary" name="salary" type="number" class="mt-1 block w-full" :value="old('salary')" />
                                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="logo" value="Logo Perusahaan" />
                                <input id="logo" name="logo" type="file"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:py-2 file:px-4 file:text-indigo-600 hover:file:bg-indigo-100" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('jobs.index') }}"
                               class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
