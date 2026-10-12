@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Tambah Fasilitas</h1>
            <p class="mt-1 text-sm text-gray-500">Buat fasilitas baru untuk venue</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.facilities.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <!-- Facility Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                            <input type="text" name="name" id="name"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon Selection -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (Font
                                Awesome)</label>
                            <div class="flex rounded-lg shadow-sm">
                                <span
                                    class="inline-flex items-center px-4 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M440 6.5L24 246.4c-34.4 19.9-31.1 70.8 5.7 85.9L144 379.6V464c0 46.4 59.2 65.5 86.6 28.6l43.8-59.1 111.9 46.2c5.9 2.4 12.1 3.6 18.3 3.6 8.2 0 16.3-2.1 23.6-6.2 12.8-7.2 21.6-20 23.9-34.5l59.4-387.2c6.1-40.1-36.9-68.8-71.5-48.9zM192 464v-64.6l36.6 15.1L192 464zm212.6-28.7l-153.8-63.5L391 169.5c10.7-15.5-9.5-33.5-23.7-21.2L155.8 332.6 48 288 464 48l-59.4 387.3z" />
                                    </svg>
                                    fa-
                                </span>
                                <input type="text" name="icon" id="icon"
                                    class="flex-1 min-w-0 block w-full px-4 py-2.5 rounded-none rounded-r-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150"
                                    value="{{ old('icon') }}" placeholder="wifi">
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Masukkan nama icon dari
                                <a href="https://fontawesome.com/icons" target="_blank"
                                    class="ml-1 text-primary-600 hover:text-primary-800 underline transition duration-150">
                                    Font Awesome
                                </a>
                                <span class="mx-1">tanpa awalan "fa-".</span>
                            </div>
                            @error('icon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-150">{{ old('description') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Deskripsi singkat tentang fasilitas ini (opsional)</p>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon Preview -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">Preview Icon</h3>
                            <div class="flex items-center space-x-4">
                                <div id="icon-preview"
                                    class="w-12 h-12 flex items-center justify-center bg-primary-100 text-primary-600 rounded-lg">
                                    <i class="fas fa-question text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-700">Icon akan ditampilkan seperti ini pada daftar fasilitas
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-5 border-t border-gray-200">
                            <a href="{{ route('admin.facilities.index') }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-primary-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const iconInput = document.getElementById('icon');
                const iconPreview = document.getElementById('icon-preview');

                // Update preview when typing
                iconInput.addEventListener('input', updateIconPreview);

                // Initial preview
                updateIconPreview();

                function updateIconPreview() {
                    const iconName = iconInput.value.trim();
                    iconPreview.innerHTML = iconName ?
                        `<i class="fas fa-${iconName} text-xl"></i>` :
                        `<i class="fas fa-question text-xl"></i>`;
                }
            });
        </script>
    @endpush

@endsection
