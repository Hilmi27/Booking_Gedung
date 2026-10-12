@extends('layouts.admin')

@section('title', 'Edit Gedung')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .input-modern {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .input-modern:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            transform: translateY(-1px);
        }

        .btn-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .image-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .image-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .image-overlay {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.9), rgba(118, 75, 162, 0.9));
            transition: all 0.3s ease;
        }

        .section-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .checkbox-modern {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox-modern:checked {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-color: #4f46e5;
        }

        .checkbox-modern:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .facility-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .facility-card:hover {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            transform: translateY(-2px);
        }

        .facility-card.selected {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.1));
            border-color: #4f46e5;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen gradient-bg py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
                    <i class="fas fa-edit text-indigo-600 text-xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Edit Gedung</h1>
                <p class="text-indigo-100 text-lg">{{ $venue->name }}</p>
            </div>

            <form action="{{ route('admin.venues.update', $venue) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Basic Information Card -->
                        <div class="section-card p-8">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-info-circle text-white"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Informasi Dasar</h2>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-building text-indigo-500 mr-2"></i>Nama Gedung
                                    </label>
                                    <input type="text" name="name" id="name"
                                        class="input-modern w-full px-4 py-3 rounded-xl focus:outline-none"
                                        value="{{ old('name', $venue->name) }}" required>
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-align-left text-indigo-500 mr-2"></i>Deskripsi
                                    </label>
                                    <textarea name="description" id="description" rows="4"
                                        class="input-modern w-full px-4 py-3 rounded-xl focus:outline-none resize-none" required>{{ old('description', $venue->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="capacity" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-users text-indigo-500 mr-2"></i>Kapasitas
                                        </label>
                                        <div class="relative">
                                            <input type="number" name="capacity" id="capacity"
                                                class="input-modern w-full px-4 py-3 pr-16 rounded-xl focus:outline-none"
                                                value="{{ old('capacity', $venue->capacity) }}" min="1" required>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500">
                                                <span class="text-sm font-medium">orang</span>
                                            </div>
                                        </div>
                                        @error('capacity')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="price_per_day" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fas fa-money-bill-wave text-indigo-500 mr-2"></i>Harga per Hari
                                        </label>
                                        <div class="relative">
                                            <input type="number" name="price_per_day" id="price_per_day"
                                                class="input-modern w-full px-12 py-3 rounded-xl focus:outline-none"
                                                value="{{ old('price_per_day', $venue->price_per_day) }}" min="0"
                                                required>
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                                                <span class="text-sm font-medium">Rp</span>
                                            </div>
                                        </div>
                                        @error('price_per_day')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Facilities Card -->
                        <div class="section-card p-8">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-cogs text-white"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Fasilitas</h2>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($facilities as $facility)
                                    <label
                                        class="facility-card bg-gray-50 hover:bg-gray-100 p-4 rounded-xl border-2 border-transparent transition-all cursor-pointer"
                                        data-facility-id="{{ $facility->id }}">
                                        <div class="flex items-center space-x-3">
                                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                                class="checkbox-modern"
                                                {{ in_array($facility->id, old('facilities', $venue->facilities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <div class="flex-1">
                                                <div class="flex items-center">
                                                    <i class="fas fa-star text-amber-500 mr-2"></i>
                                                    <span class="font-medium text-gray-800">{{ $facility->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('facilities')
                                <p class="text-red-500 text-sm mt-4 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-8">
                        <!-- Current Images Card -->
                        @if ($venue->images->count() > 0)
                            <div class="section-card p-8">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-600 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-images text-white"></i>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-800">Gambar Saat Ini</h2>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($venue->images as $image)
                                        <div
                                            class="image-card rounded-2xl overflow-hidden {{ $image->is_primary ? 'ring-4 ring-indigo-500' : 'ring-1 ring-gray-200' }}">
                                            <div class="relative group">
                                                <img src="{{ asset($image->image_path) }}" alt="{{ $venue->name }}"
                                                    class="w-full h-40 object-cover">

                                                <!-- Primary Badge -->
                                                @if ($image->is_primary)
                                                    <div class="absolute top-3 left-3">
                                                        <div
                                                            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center">
                                                            <i class="fas fa-crown mr-1"></i>Primary
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Action Overlay -->
                                                <div
                                                    class="image-overlay absolute inset-0 opacity-0 group-hover:opacity-100 flex items-center justify-center space-x-3 transition-all duration-300">
                                                    @if (!$image->is_primary)
                                                        <input type="radio" name="primary_image"
                                                            value="{{ $image->id }}" id="primary-{{ $image->id }}"
                                                            class="hidden">
                                                        <button type="button"
                                                            onclick="selectPrimary({{ $image->id }})"
                                                            class="btn-modern bg-white text-indigo-600 px-4 py-2 rounded-xl font-semibold flex items-center space-x-2 hover:bg-indigo-50">
                                                            <i class="fas fa-crown"></i>
                                                            <span>Set Primary</span>
                                                        </button>
                                                    @else
                                                        <input type="radio" name="primary_image"
                                                            value="{{ $image->id }}" id="primary-{{ $image->id }}"
                                                            class="hidden" checked>
                                                    @endif

                                                    <button type="button" onclick="deleteImage({{ $image->id }})"
                                                        class="btn-modern bg-red-500 text-white px-4 py-2 rounded-xl font-semibold flex items-center space-x-2 hover:bg-red-600">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Hapus</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 p-4 bg-blue-50 rounded-xl border border-blue-200">
                                    <div class="flex items-start space-x-2">
                                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                        <div class="text-sm text-blue-700">
                                            <p class="font-medium">Tips:</p>
                                            <p>Hover pada gambar untuk melihat opsi. Pilih gambar primary sebelum update.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Upload New Images Card -->
                        <div class="section-card p-8">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-cloud-upload-alt text-white"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Upload Gambar</h2>
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all duration-300 cursor-pointer"
                                onclick="document.getElementById('images').click()">
                                <div class="space-y-4">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto">
                                        <i class="fas fa-images text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-semibold text-gray-800 mb-1">Pilih Gambar</p>
                                        <p class="text-gray-500">atau drag & drop file di sini</p>
                                    </div>
                                    <p class="text-xs text-gray-400">JPG, PNG, GIF hingga 2MB</p>
                                </div>
                            </div>

                            <input type="file" name="images[]" id="images" class="hidden" accept="image/*"
                                multiple>

                            @error('images')
                                <p class="text-red-500 text-sm mt-3 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror

                            <!-- File Preview -->
                            <div id="file-preview" class="mt-4 space-y-2 hidden">
                                <p class="text-sm font-medium text-gray-700">File yang dipilih:</p>
                                <div id="file-list" class="space-y-1"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-4">
                            <button type="submit"
                                class="btn-modern w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center space-x-2 hover:from-indigo-700 hover:to-purple-700">
                                <i class="fas fa-save"></i>
                                <span>Update Gedung</span>
                            </button>

                            <a href="{{ route('admin.venues.index') }}"
                                class="btn-modern w-full bg-white text-gray-700 py-4 rounded-xl font-bold border-2 border-gray-200 flex items-center justify-center space-x-2 hover:bg-gray-50">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden form for deleting images -->
    <form id="deleteImageForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        // Delete image function
        function deleteImage(imageId) {
            Swal.fire({
                title: 'Hapus Gambar?',
                text: 'Gambar yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteImageForm');
                    form.action = `/admin/venues/images/${imageId}`;
                    form.submit();
                }
            });
        }

        // Select primary image
        function selectPrimary(imageId) {
            // Remove all rings
            document.querySelectorAll('.image-card').forEach(card => {
                card.classList.remove('ring-4', 'ring-indigo-500');
                card.classList.add('ring-1', 'ring-gray-200');
            });

            // Add ring to selected
            const radio = document.getElementById(`primary-${imageId}`);
            radio.checked = true;
            const card = radio.closest('.image-card');
            card.classList.remove('ring-1', 'ring-gray-200');
            card.classList.add('ring-4', 'ring-indigo-500');

            // Show success toast
            Swal.fire({
                icon: 'success',
                title: 'Primary Image Selected!',
                text: 'Jangan lupa klik "Update Gedung" untuk menyimpan.',
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Handle facility selection
        document.addEventListener('DOMContentLoaded', function() {
            const facilityCards = document.querySelectorAll('.facility-card');

            facilityCards.forEach(card => {
                const checkbox = card.querySelector('input[type="checkbox"]');

                // Initial state
                if (checkbox.checked) {
                    card.classList.add('selected');
                }

                // Handle clicks
                card.addEventListener('click', function(e) {
                    if (e.target.type !== 'checkbox') {
                        checkbox.checked = !checkbox.checked;
                    }

                    if (checkbox.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            });

            // File upload preview
            const fileInput = document.getElementById('images');
            const filePreview = document.getElementById('file-preview');
            const fileList = document.getElementById('file-list');

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    filePreview.classList.remove('hidden');
                    fileList.innerHTML = '';

                    Array.from(this.files).forEach(file => {
                        const fileItem = document.createElement('div');
                        fileItem.className =
                            'flex items-center space-x-2 text-sm text-gray-600 bg-gray-50 p-2 rounded-lg';
                        fileItem.innerHTML = `
                        <i class="fas fa-image text-indigo-500"></i>
                        <span class="flex-1">${file.name}</span>
                        <span class="text-xs text-gray-400">${(file.size / 1024).toFixed(1)} KB</span>
                    `;
                        fileList.appendChild(fileItem);
                    });
                } else {
                    filePreview.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
