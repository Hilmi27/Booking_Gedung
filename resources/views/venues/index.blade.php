@extends('layouts.app')

@section('title', 'Daftar Gedung')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-center mb-8">Daftar Gedung Kesenian</h1>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <form action="{{ route('venues.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="capacity" class="form-label">Kapasitas Minimal</label>
                        <select name="capacity" id="capacity" class="form-input">
                            <option value="">Semua Kapasitas</option>
                            <option value="100" {{ request('capacity') == 100 ? 'selected' : '' }}>Min. 100 orang
                            </option>
                            <option value="200" {{ request('capacity') == 200 ? 'selected' : '' }}>Min. 200 orang
                            </option>
                            <option value="300" {{ request('capacity') == 300 ? 'selected' : '' }}>Min. 300 orang
                            </option>
                            <option value="500" {{ request('capacity') == 500 ? 'selected' : '' }}>Min. 500 orang
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="facility" class="form-label">Fasilitas</label>
                        <select name="facility" id="facility" class="form-input">
                            <option value="">Semua Fasilitas</option>
                            @foreach ($facilities ?? [] as $facility)
                                <option value="{{ $facility->id }}"
                                    {{ request('facility') == $facility->id ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="btn btn-primary w-full">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Venues Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($venues as $venue)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:transform hover:scale-105">
                        <img src="{{ asset($venue->getPrimaryImage() ?? 'venues/default.jpg') }}" alt="{{ $venue->name }}"
                            class="w-full h-56 object-cover">

                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2">{{ $venue->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($venue->description, 100) }}</p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($venue->facilities as $facility)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                        <i class="fas {{ $facility->icon }} mr-1"></i> {{ $facility->name }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-600">Kapasitas: {{ $venue->capacity }} orang</p>
                                    <p class="text-primary-600 font-bold">Rp
                                        {{ number_format($venue->price_per_day, 0, ',', '.') }}/hari</p>
                                </div>
                                <a href="{{ route('venues.show', $venue) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-500">Tidak ada gedung yang ditemukan</h3>
                        <p class="text-gray-500 mt-2">Coba ubah filter pencarian Anda</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
