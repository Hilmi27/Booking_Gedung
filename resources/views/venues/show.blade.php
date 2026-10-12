@extends('layouts.app')

@section('title', $venue->name)

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 text-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 transition-colors">
                            <i class="fas fa-home mr-2"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('venues.index') }}"
                                class="text-gray-600 hover:text-primary-600 transition-colors">Gedung</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500 font-medium">{{ $venue->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Image Gallery with improved layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-6">
                    <div class="lg:col-span-2 relative group">
                        <img src="{{ asset($venue->getPrimaryImage() ?? 'venues/default.jpg') }}" alt="{{ $venue->name }}"
                            class="w-full h-[500px] object-cover rounded-xl transition-all duration-300 group-hover:brightness-95">
                        <div
                            class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($venue->images->where('is_primary', false)->take(4) as $index => $image)
                            <div class="relative group overflow-hidden rounded-xl">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $venue->name }}"
                                    class="w-full h-[230px] object-cover transition-all duration-300 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start mb-8 gap-8">
                        <div class="flex-grow">
                            <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $venue->name }}</h1>
                            <div class="flex items-center text-gray-600 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="font-medium">Kapasitas: {{ $venue->capacity }} orang</span>
                            </div>
                        </div>
                        <div class="bg-primary-50 p-6 rounded-xl text-center shadow-sm flex flex-col lg:min-w-[280px]">
                            <p class="text-gray-600 mb-1 font-medium">Harga per hari</p>
                            <p class="text-4xl font-bold text-primary-700 mb-4">Rp
                                {{ number_format($venue->price_per_day, 0, ',', '.') }}</p>
                            @auth
                                <a href="{{ route('bookings.create', ['venue_id' => $venue->id]) }}"
                                    class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg w-full text-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 border-2 border-primary-600 hover:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 active:translate-y-0">
                                    Booking Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg w-full text-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 border-2 border-primary-600 hover:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 active:translate-y-0">
                                    Login untuk Booking
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <!-- Description -->
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Deskripsi
                            </h2>
                            <p class="text-gray-700 leading-relaxed mb-6 text-lg">{{ $venue->description }}</p>
                        </div>

                        <!-- Facilities -->
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Fasilitas
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($venue->facilities as $facility)
                                    <div
                                        class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <i class="fas {{ $facility->icon }} text-primary-600 mr-3 text-lg"></i>
                                        <span class="font-medium">{{ $facility->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Availability Checker -->
                        <div>
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Ketersediaan
                            </h2>
                            <div class="bg-gray-50 p-6 rounded-xl mb-8 shadow-sm">
                                <div x-data="{ selectedDate: '' }">
                                    <div class="mb-6">
                                        <label for="check_date" class="block text-gray-700 font-medium mb-2">Pilih
                                            Tanggal</label>
                                        <input type="date" id="check_date" x-model="selectedDate"
                                            min="{{ date('Y-m-d') }}"
                                            class="form-input w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200">
                                    </div>

                                    <div x-show="selectedDate" x-cloak>
                                        <button @click="checkAvailability(selectedDate)"
                                            class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 border-2 border-primary-600 hover:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 active:translate-y-0 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            Cek Ketersediaan
                                        </button>

                                        <div id="availability-result"
                                            class="hidden p-6 rounded-lg text-center mt-6 shadow-sm">
                                            <!-- Will be filled by JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function checkAvailability(date) {
                const resultDiv = document.getElementById('availability-result');
                if (!date) {
                    alert('Silakan pilih tanggal terlebih dahulu.');
                    return;
                }

                console.log(`Fetching availability for venue ID {{ $venue->id }} on date ${date}`);

                resultDiv.innerHTML = `
        <div class="flex justify-center items-center">
            <svg class="animate-spin h-5 w-5 text-primary-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-600 font-medium">Memeriksa ketersediaan...</p>
        </div>`;
                resultDiv.classList.remove('hidden', 'bg-green-100', 'bg-red-100');
                resultDiv.classList.add('bg-gray-100');

                fetch(`{{ route('bookings.check-availability') }}?venue_id={{ $venue->id }}&date=${date}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.available) {
                            resultDiv.innerHTML = `
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-700 font-medium text-lg mb-4">Gedung tersedia pada tanggal yang dipilih!</p>
                        @auth
                            <a href="{{ route('bookings.create') }}?venue_id={{ $venue->id }}&date=${date}" 
                               class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 border-2 border-primary-600 hover:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 active:translate-y-0 flex items-center justify-center">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                               </svg>
                               Booking Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200 border-2 border-primary-600 hover:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 active:translate-y-0 flex items-center justify-center">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                               </svg>
                               Login untuk Booking
                            </a>
                        @endauth
                    </div>
                `;
                            resultDiv.classList.remove('bg-gray-100', 'bg-red-100');
                            resultDiv.classList.add('bg-green-100');
                        } else {
                            resultDiv.innerHTML = `
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-red-700 font-medium text-lg mb-2">Maaf, gedung tidak tersedia pada tanggal yang dipilih.</p>
                        <p class="text-gray-600">Silakan pilih tanggal lain.</p>
                    </div>
                `;
                            resultDiv.classList.remove('bg-gray-100', 'bg-green-100');
                            resultDiv.classList.add('bg-red-100');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultDiv.innerHTML = `
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-red-700 font-medium">Terjadi kesalahan. Silakan coba lagi.</p>
                </div>`;
                        resultDiv.classList.remove('bg-gray-100', 'bg-green-100');
                        resultDiv.classList.add('bg-red-100');
                    });
                resultDiv.classList.remove('hidden');
            }
        </script>
    @endpush
@endsection
