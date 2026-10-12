@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-xl font-semibold text-gray-800">Edit Fasilitas</h2>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.facilities.update', $facility) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Nama Fasilitas -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                value="{{ old('name', $facility->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon (Font
                                Awesome)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-4 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">
                                    <i class="fas fa-info-circle mr-2"></i>fa-
                                </span>
                                <input type="text" name="icon" id="icon"
                                    class="flex-1 rounded-r-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all px-4 py-2"
                                    value="{{ old('icon', $facility->icon) }}" placeholder="wifi">
                            </div>
                            <div class="mt-2">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                                    <span>Pilih icon dari <a href="https://fontawesome.com/icons" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 hover:underline">Font Awesome</a> tanpa
                                        awalan "fa-"</span>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2" id="icon-preview">
                                    @foreach (['wifi', 'bed', 'shower', 'utensils', 'swimming-pool', 'coffee'] as $iconExample)
                                        <div class="inline-flex items-center px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full text-sm cursor-pointer transition-colors"
                                            onclick="document.getElementById('icon').value = '{{ $iconExample }}'">
                                            <i class="fas fa-{{ $iconExample }} mr-1"></i>
                                            {{ $iconExample }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('icon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none">{{ old('description', $facility->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Actions -->
                    <div class="flex justify-end space-x-3 mt-8 pt-5 border-t border-gray-100">
                        <a href="{{ route('admin.facilities.index') }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Live icon preview
            const iconInput = document.getElementById('icon');
            iconInput.addEventListener('input', function() {
                const iconPreview = document.createElement('div');
                iconPreview.className = 'text-center mt-3 p-2 border border-gray-200 rounded-lg';
                iconPreview.innerHTML = `
            <div class="text-2xl mb-2"><i class="fas fa-${this.value}"></i></div>
            <div class="text-sm text-gray-600">fa-${this.value}</div>
        `;

                const existingPreview = document.querySelector('#dynamic-preview');
                if (existingPreview) {
                    existingPreview.replaceWith(iconPreview);
                } else {
                    document.querySelector('#icon-preview').after(iconPreview);
                }
                iconPreview.id = 'dynamic-preview';
            });
        </script>
    @endpush
@endsection
