@extends('layouts.admin')

@section('title', 'Tambah Gedung')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-building mr-2"></i>
                    Tambah Gedung Baru
                </h2>
                <p class="text-blue-100 text-sm mt-1">Lengkapi informasi gedung untuk ditambahkan ke sistem</p>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.venues.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf

                    <!-- Basic Information Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-gray-700 font-medium mb-4 pb-2 border-b border-gray-200">Informasi Dasar</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Gedung</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="text" name="name" id="name"
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 sm:text-sm"
                                        value="{{ old('name') }}" placeholder="Masukkan nama gedung" required>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas
                                    (orang)</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-users text-gray-400"></i>
                                    </div>
                                    <input type="number" name="capacity" id="capacity"
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 sm:text-sm"
                                        value="{{ old('capacity') }}" placeholder="Masukkan kapasitas maksimum"
                                        min="1" required>
                                </div>
                                @error('capacity')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="price_per_day" class="block text-sm font-medium text-gray-700 mb-1">Harga per
                                    Hari</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-money-bill-wave text-gray-400"></i>
                                    </div>
                                    <div
                                        class="absolute inset-y-0 left-10 pr-3 flex items-center pointer-events-none text-gray-500">
                                        Rp
                                    </div>
                                    <input type="number" name="price_per_day" id="price_per_day"
                                        class="pl-16 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 sm:text-sm"
                                        value="{{ old('price_per_day') }}" placeholder="Masukkan harga sewa per hari"
                                        min="0" required>
                                </div>
                                @error('price_per_day')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-gray-700 font-medium mb-4 pb-2 border-b border-gray-200">Deskripsi Gedung</h3>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                                Lengkap</label>
                            <div class="rounded-md shadow-sm">
                                <textarea name="description" id="description" rows="5"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 sm:text-sm"
                                    placeholder="Deskripsi detail tentang gedung, lokasi, dan keunggulannya" required>{{ old('description') }}</textarea>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Berikan deskripsi yang menarik dan detail untuk membantu penyewa memahami fasilitas gedung
                                Anda.
                            </p>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Facilities Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-gray-700 font-medium mb-4 pb-2 border-b border-gray-200">
                            <span class="flex items-center">
                                <i class="fas fa-clipboard-list mr-2 text-blue-600"></i>
                                Fasilitas Tersedia
                            </span>
                        </h3>

                        <div class="mb-2">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <button type="button" id="select-all"
                                    class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">Pilih
                                    Semua</button>
                                <button type="button" id="clear-all"
                                    class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition-colors">Bersihkan</button>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-3">
                                @foreach ($facilities as $facility)
                                    <div class="relative">
                                        <input type="checkbox" name="facilities[]" id="facility-{{ $facility->id }}"
                                            value="{{ $facility->id }}"
                                            class="facility-checkbox absolute h-4 w-4 opacity-0"
                                            {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}>
                                        <label for="facility-{{ $facility->id }}"
                                            class="facility-label flex items-center p-2 rounded-lg border border-gray-200 text-gray-700 text-sm cursor-pointer bg-white hover:bg-blue-50 transition-colors">
                                            <span
                                                class="facility-check w-4 h-4 mr-2 rounded border border-gray-300 bg-white flex items-center justify-center">
                                                <i class="fas fa-check text-white text-xs hidden"></i>
                                            </span>
                                            {{ $facility->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('facilities')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Images Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-gray-700 font-medium mb-4 pb-2 border-b border-gray-200">
                            <span class="flex items-center">
                                <i class="fas fa-images mr-2 text-blue-600"></i>
                                Unggah Gambar
                            </span>
                        </h3>

                        <div class="mb-4">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors cursor-pointer"
                                id="dropzone-area">
                                <input type="file" name="images[]" id="images" accept="image/*" multiple
                                    class="hidden">
                                <div class="space-y-2">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl"></i>
                                    <div class="text-gray-600">
                                        <p class="font-medium">Klik untuk memilih gambar</p>
                                        <p class="text-sm">atau drag and drop file gambar di sini</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                </div>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-3" id="preview-container"></div>
                        </div>
                        @error('images')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        @error('images.*')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.venues.index') }}"
                            class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                            <i class="fas fa-times mr-1.5"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2 border border-transparent rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                            <i class="fas fa-save mr-1.5"></i>
                            Simpan Gedung
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Facility checkbox styling
            const checkboxes = document.querySelectorAll('.facility-checkbox');
            checkboxes.forEach(checkbox => {
                updateCheckboxStyle(checkbox);
                checkbox.addEventListener('change', function() {
                    updateCheckboxStyle(this);
                });
            });

            // Select all and clear all buttons
            document.getElementById('select-all').addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    updateCheckboxStyle(checkbox);
                });
            });

            document.getElementById('clear-all').addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    updateCheckboxStyle(checkbox);
                });
            });

            // Image upload preview
            const dropzone = document.getElementById('dropzone-area');
            const fileInput = document.getElementById('images');
            const previewContainer = document.getElementById('preview-container');

            dropzone.addEventListener('click', function() {
                fileInput.click();
            });

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('border-blue-500', 'bg-blue-50');
            });

            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('border-blue-500', 'bg-blue-50');

                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    updateImagePreviews();
                }
            });

            fileInput.addEventListener('change', updateImagePreviews);

            function updateImagePreviews() {
                previewContainer.innerHTML = '';

                if (fileInput.files.length) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        const file = fileInput.files[i];

                        if (!file.type.match('image.*')) continue;

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewBox = document.createElement('div');
                            previewBox.className = 'relative border rounded-lg p-1 group';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-24 h-24 object-cover rounded-lg';

                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className =
                                'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity';
                            removeBtn.innerHTML = '<i class="fas fa-times text-xs"></i>';
                            removeBtn.onclick = function() {
                                // We can't directly modify FileList, so we need this workaround
                                // This marks the image for deletion visually
                                previewBox.classList.add('opacity-50');
                                previewBox.setAttribute('data-remove', 'true');
                            };

                            // Main image indicator for first image
                            if (i === 0) {
                                const mainBadge = document.createElement('span');
                                mainBadge.className =
                                    'absolute -top-2 -left-2 bg-blue-500 text-white text-xs rounded-full px-2 py-0.5';
                                mainBadge.textContent = 'Utama';
                                previewBox.appendChild(mainBadge);
                            }

                            previewBox.appendChild(img);
                            previewBox.appendChild(removeBtn);
                            previewContainer.appendChild(previewBox);
                        };

                        reader.readAsDataURL(file);
                    }
                }
            }

            function updateCheckboxStyle(checkbox) {
                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                const check = label.querySelector('.facility-check');
                const checkIcon = check.querySelector('i');

                if (checkbox.checked) {
                    check.classList.add('bg-blue-600', 'border-blue-600');
                    check.classList.remove('bg-white', 'border-gray-300');
                    checkIcon.classList.remove('hidden');
                    label.classList.add('bg-blue-50', 'border-blue-300');
                } else {
                    check.classList.remove('bg-blue-600', 'border-blue-600');
                    check.classList.add('bg-white', 'border-gray-300');
                    checkIcon.classList.add('hidden');
                    label.classList.remove('bg-blue-50', 'border-blue-300');
                }
            }
        });
    </script>
@endsection
