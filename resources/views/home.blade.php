@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div
        class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Hero Background" class="w-full h-full object-cover opacity-15">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-blue-900/80"></div>
        </div>

        <!-- Floating elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/6 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-2/3 right-1/6 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse delay-1000">
            </div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl animate-pulse delay-500">
            </div>
        </div>

        <div class="relative z-10 max-w-8xl mx-auto px-4 py-24 sm:px-6 lg:px-8 text-center">
            <div class="space-y-10">
                <div class="space-y-6">
                    <div
                        class="inline-flex items-center px-6 py-3 bg-blue-500/20 backdrop-blur-md border border-blue-400/30 text-blue-300 rounded-2xl text-sm font-semibold">
                        <i class="fas fa-trophy mr-3"></i>
                        Platform Booking Gedung Kesenian Terdepan
                    </div>

                    <h1 class="text-6xl md:text-8xl font-black tracking-tight text-white leading-tight">
                        Ruang Seni
                        <span
                            class="block bg-gradient-to-r from-blue-400 via-cyan-400 to-indigo-400 bg-clip-text text-transparent">
                            Berkelas Dunia
                        </span>
                        untuk Visi Anda
                    </h1>

                    <p class="max-w-4xl mx-auto text-xl md:text-2xl text-slate-300 leading-relaxed font-light">
                        Transformasikan ide kreatif Anda menjadi kenyataan dengan gedung kesenian premium yang dilengkapi
                        teknologi canggih dan fasilitas world-class. Platform booking yang dipercaya ribuan seniman dan
                        event organizer.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center pt-10">
                    <a href="{{ route('venues.index') }}"
                        class="group relative px-10 py-5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/25 transform hover:-translate-y-2 transition-all duration-500 flex items-center space-x-3 text-lg">
                        <span>Eksplorasi Gedung</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>

                    {{-- <button
                        class="group px-10 py-5 border-2 border-white/30 text-white font-bold rounded-2xl backdrop-blur-md hover:bg-white/10 hover:border-white/50 transition-all duration-500 flex items-center space-x-3 text-lg">
                        <i class="fas fa-play-circle text-xl"></i>
                        <span>Virtual Tour</span>
                    </button> --}}
                </div>

                <!-- Trust indicators -->
                <div class="pt-16">
                    <p class="text-slate-400 text-sm mb-8">Dipercaya oleh 500+ organisasi terkemuka</p>
                    <div class="flex justify-center items-center space-x-12 opacity-60">
                        <div class="text-white/70 font-semibold">Brand 1</div>
                        <div class="text-white/70 font-semibold">Brand 2</div>
                        <div class="text-white/70 font-semibold">Brand 3</div>
                        <div class="text-white/70 font-semibold">Brand 4</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-8 h-12 border-2 border-blue-400/50 rounded-full flex justify-center backdrop-blur-sm">
                <div class="w-1.5 h-4 bg-blue-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-20 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                <div class="text-center group">
                    <div
                        class="text-5xl md:text-6xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-3 group-hover:scale-110 transition-transform duration-300">
                        75+</div>
                    <div class="text-gray-600 font-semibold text-lg">Gedung Premium</div>
                    <div class="text-gray-400 text-sm mt-1">Di seluruh Indonesia</div>
                </div>
                <div class="text-center group">
                    <div
                        class="text-5xl md:text-6xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-3 group-hover:scale-110 transition-transform duration-300">
                        2500+</div>
                    <div class="text-gray-600 font-semibold text-lg">Event Sukses</div>
                    <div class="text-gray-400 text-sm mt-1">Sejak 2020</div>
                </div>
                <div class="text-center group">
                    <div
                        class="text-5xl md:text-6xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-3 group-hover:scale-110 transition-transform duration-300">
                        98%</div>
                    <div class="text-gray-600 font-semibold text-lg">Kepuasan Klien</div>
                    <div class="text-gray-400 text-sm mt-1">Rating rata-rata</div>
                </div>
                <div class="text-center group">
                    <div
                        class="text-5xl md:text-6xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-3 group-hover:scale-110 transition-transform duration-300">
                        24/7</div>
                    <div class="text-gray-600 font-semibold text-lg">Premium Support</div>
                    <div class="text-gray-400 text-sm mt-1">Tim profesional</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Venues Section -->
    <div class="bg-gradient-to-br from-slate-50 to-blue-50/50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center px-6 py-3 bg-blue-100 text-blue-800 rounded-2xl text-sm font-bold mb-6 border border-blue-200">
                    <i class="fas fa-gem mr-3"></i>
                    Koleksi Eksklusif
                </div>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Gedung Kesenian
                    <span class="block bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                        Pilihan Utama
                    </span>
                </h2>
                <p class="max-w-4xl mx-auto text-xl text-gray-600 leading-relaxed font-light">
                    Setiap venue telah dikurasi khusus untuk memenuhi standar excellence tertinggi.
                    Dari arsitektur yang memukau hingga teknologi audio-visual terdepan.
                </p>
            </div>

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-1">
                @foreach ($featuredVenues as $venue)
                    <div
                        class="group bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-700 overflow-hidden border border-white/50">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($venue->getPrimaryImage() ?? 'venues/default.jpg') }}"
                                alt="{{ $venue->name }}"
                                class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-1000">

                            <!-- Overlay gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <!-- Premium badge -->
                            <div class="absolute top-6 left-6">
                                <div
                                    class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">
                                    <i class="fas fa-crown mr-2"></i>Premium
                                </div>
                            </div>

                            <!-- Capacity indicator -->
                            <div class="absolute top-6 right-6">
                                <div
                                    class="bg-white/90 backdrop-blur-sm text-gray-900 px-3 py-2 rounded-xl text-sm font-semibold">
                                    <i class="fas fa-users mr-1"></i>500+ seats
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="mb-6">
                                <h3
                                    class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $venue->name }}
                                </h3>
                                <p class="text-gray-600 leading-relaxed font-light">
                                    {{ Str::limit($venue->description, 130) }}
                                </p>
                            </div>

                            <!-- Facilities -->
                            <div class="mb-8">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($venue->facilities->take(3) as $facility)
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-blue-50 text-blue-700 border border-blue-100 hover:bg-blue-100 transition-colors duration-300">
                                            <i class="fas {{ $facility->icon }} mr-2"></i>
                                            {{ $facility->name }}
                                        </span>
                                    @endforeach

                                    @if ($venue->facilities->count() > 3)
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-300">
                                            +{{ $venue->facilities->count() - 3 }} fasilitas
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Price and CTA -->
                            <div class="flex justify-between items-center">
                                <div class="text-left">
                                    <div class="text-sm text-gray-500 mb-1 font-medium">Investasi mulai dari</div>
                                    <div
                                        class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($venue->price_per_day, 0, ',', '.') }}
                                        <span class="text-lg text-gray-500 font-normal">/hari</span>
                                    </div>
                                </div>
                                <a href="{{ route('venues.show', $venue) }}"
                                    class="group/btn px-8 py-4 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-2xl hover:shadow-xl hover:shadow-blue-500/25 transform hover:-translate-y-1 transition-all duration-500 flex items-center space-x-3">
                                    <span>Lihat Detail</span>
                                    <i
                                        class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- <div class="text-center mt-20">
                <a href="{{ route('venues.index') }}"
                    class="inline-flex items-center px-10 py-5 bg-white text-blue-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl border-2 border-blue-100 hover:border-blue-200 transition-all duration-500 space-x-4 text-lg">
                    <i class="fas fa-th-large"></i>
                    <span>Jelajahi Semua Venue</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div> --}}
        </div>
    </div>

    <!-- Process Section -->
    <div class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center px-6 py-3 bg-cyan-100 text-cyan-800 rounded-2xl text-sm font-bold mb-6 border border-cyan-200">
                    <i class="fas fa-rocket mr-3"></i>
                    Proses Seamless
                </div>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">
                    Booking dalam
                    <span class="block bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                        3 Langkah Mudah
                    </span>
                </h2>
                <p class="max-w-4xl mx-auto text-xl text-gray-600 leading-relaxed font-light">
                    Teknologi AI-powered yang mempermudah proses booking dengan akurasi tinggi dan pengalaman yang personal
                </p>
            </div>

            <div class="relative">
                <!-- Progress line -->
                <div
                    class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 transform -translate-y-1/2 z-0">
                </div>

                <div class="grid gap-12 lg:grid-cols-3 relative z-10">
                    <!-- Step 1 -->
                    <div class="relative group">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-10 text-center border border-blue-100 hover:shadow-2xl transition-all duration-500 group-hover:-translate-y-2">
                            <!-- Step number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-xl">
                                    01
                                </div>
                            </div>

                            <div
                                class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-2xl">
                                <i class="fas fa-search-location text-3xl"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Discover & Filter</h3>
                            <p class="text-gray-600 leading-relaxed font-light">
                                Gunakan smart filter AI untuk menemukan venue yang perfect match dengan
                                requirement acara Anda. Real-time availability dan instant pricing.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group">
                        <div
                            class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-3xl p-10 text-center border border-cyan-100 hover:shadow-2xl transition-all duration-500 group-hover:-translate-y-2">
                            <!-- Step number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-xl">
                                    02
                                </div>
                            </div>

                            <div
                                class="w-24 h-24 bg-gradient-to-br from-cyan-500 to-blue-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-2xl">
                                <i class="fas fa-calendar-check text-3xl"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Smart Booking</h3>
                            <p class="text-gray-600 leading-relaxed font-light">
                                Sistem booking pintar yang mengotomatisasi konfirmasi. AI assistant membantu
                                optimasi setup dan koordinasi dengan venue management.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-10 text-center border border-blue-100 hover:shadow-2xl transition-all duration-500 group-hover:-translate-y-2">
                            <!-- Step number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-xl">
                                    03
                                </div>
                            </div>

                            <div
                                class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-2xl">
                                <i class="fas fa-sparkles text-3xl"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Execute & Enjoy</h3>
                            <p class="text-gray-600 leading-relaxed font-light">
                                Payment gateway terintegrasi dengan multiple options. Real-time event monitoring
                                dan dedicated support team untuk memastikan kesuksesan acara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Technology & Features Section -->
    <div class="bg-gradient-to-br from-slate-900 to-blue-900 py-24 relative overflow-hidden">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center px-6 py-3 bg-white/10 text-white rounded-2xl text-sm font-bold mb-6 backdrop-blur-md border border-white/20">
                    <i class="fas fa-microchip mr-3"></i>
                    Powered by Technology
                </div>
                <h2 class="text-5xl md:text-6xl font-black text-white mb-6 leading-tight">
                    Platform dengan
                    <span class="block bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                        Teknologi Terdepan
                    </span>
                </h2>
                <p class="max-w-4xl mx-auto text-xl text-slate-300 leading-relaxed font-light">
                    Infrastruktur cloud-native yang scalable dengan AI integration untuk experience yang tak tertandingi
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-white/20 transition-all duration-500 border border-white/20">
                        <i class="fas fa-shield-alt text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Enterprise Security</h3>
                    <p class="text-slate-300 font-light">End-to-end encryption dengan SOC 2 compliance dan 99.9% uptime
                        guarantee</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-white/20 transition-all duration-500 border border-white/20">
                        <i class="fas fa-brain text-3xl text-cyan-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">AI-Powered Matching</h3>
                    <p class="text-slate-300 font-light">Machine learning algorithm untuk perfect venue recommendation
                        berdasarkan preferensi</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-white/20 transition-all duration-500 border border-white/20">
                        <i class="fas fa-mobile-alt text-3xl text-indigo-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Mobile-First Design</h3>
                    <p class="text-slate-300 font-light">Progressive Web App dengan native mobile experience dan offline
                        capability</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-white/20 transition-all duration-500 border border-white/20">
                        <i class="fas fa-chart-line text-3xl text-emerald-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Analytics Dashboard</h3>
                    <p class="text-slate-300 font-light">Real-time insights dan comprehensive reporting untuk ROI
                        optimization</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-slate-50 to-blue-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-gradient-to-br from-blue-600 via-cyan-600 to-indigo-600 rounded-3xl p-16 md:p-20 text-center relative overflow-hidden shadow-2xl">
                <!-- Background patterns -->
                <div class="absolute inset-0">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white rounded-full blur-2xl"></div>
                        <div class="absolute top-2/3 right-1/3 w-40 h-40 bg-white rounded-full blur-2xl"></div>
                        <div class="absolute bottom-1/4 left-2/3 w-36 h-36 bg-white rounded-full blur-2xl"></div>
                    </div>
                </div>

                <div class="relative z-10">
                    <div
                        class="inline-flex items-center px-6 py-3 bg-white/20 text-white rounded-2xl text-sm font-bold mb-8 backdrop-blur-md border border-white/30">
                        <i class="fas fa-star mr-3"></i>
                        Mulai Journey Kreatif Anda
                    </div>

                    <h2 class="text-5xl md:text-7xl font-black text-white mb-8 leading-tight">
                        Ready to Create
                        <span class="block text-blue-200">Something Amazing?</span>
                    </h2>

                    <p class="text-xl md:text-2xl text-blue-100 mb-12 max-w-4xl mx-auto leading-relaxed font-light">
                        Bergabunglah dengan ribuan creator yang telah mempercayai platform kami untuk mewujudkan
                        visi artistik mereka. Saatnya mengubah impian menjadi kenyataan.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('venues.index') }}"
                            class="group px-10 py-5 bg-white text-blue-600 font-black rounded-2xl shadow-2xl hover:shadow-white/25 transform hover:-translate-y-2 transition-all duration-500 flex items-center space-x-4 text-lg">
                            <i class="fas fa-rocket"></i>
                            <span>Mulai Eksplorasi</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                        </a>

                        <a href="{{ route('register') }}"
                            class="group px-10 py-5 border-2 border-white text-white font-black rounded-2xl hover:bg-white hover:text-blue-600 transition-all duration-500 flex items-center space-x-4 text-lg backdrop-blur-md">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar Premium</span>
                        </a>
                    </div>

                    <!-- Additional info -->
                    <div class="mt-12 text-blue-100">
                        <p class="text-sm font-light">
                            <i class="fas fa-check-circle mr-2"></i>
                            Gratis konsultasi dengan venue specialist
                            <span class="mx-4">•</span>
                            <i class="fas fa-check-circle mr-2"></i>
                            No hidden fees
                            <span class="mx-4">•</span>
                            <i class="fas fa-check-circle mr-2"></i>
                            24/7 premium support
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
