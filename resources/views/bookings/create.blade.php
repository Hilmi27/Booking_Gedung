@extends('layouts.app')

@section('title', 'Buat Booking')

@section('content')
    <div class="bg-gradient-to-b from-primary-50 to-gray-50 py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Booking Baru</h1>
                <p class="text-gray-600">Isi formulir di bawah untuk memesan gedung kesenian</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label for="venue_id" class="form-label flex items-center">
                                    <i class="fas fa-building mr-2 text-primary-500"></i>
                                    Pilih Gedung
                                </label>
                                <select name="venue_id" id="venue_id"
                                    class="form-input rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-all"
                                    required>
                                    <option value="">-- Pilih Gedung --</option>
                                    @foreach ($venues as $venue)
                                        <option value="{{ $venue->id }}"
                                            {{ old('venue_id', request('venue_id')) == $venue->id ? 'selected' : '' }}
                                            data-price="{{ $venue->price_per_day }}">
                                            {{ $venue->name }} - Rp
                                            {{ number_format($venue->price_per_day, 0, ',', '.') }}/hari
                                        </option>
                                    @endforeach
                                </select>
                                @error('venue_id')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="booking_date" class="form-label flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-primary-500"></i>
                                    Tanggal Booking
                                </label>
                                <input type="date" name="booking_date" id="booking_date"
                                    class="form-input rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-all"
                                    min="{{ date('Y-m-d') }}" value="{{ old('booking_date', request('date')) }}" required>
                                @error('booking_date')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="event_name" class="form-label flex items-center">
                                <i class="fas fa-music mr-2 text-primary-500"></i>
                                Nama Acara
                            </label>
                            <input type="text" name="event_name" id="event_name"
                                class="form-input rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-all"
                                placeholder="Masukkan nama acara" value="{{ old('event_name') }}" required>
                            @error('event_name')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="event_description" class="form-label flex items-center">
                                <i class="fas fa-align-left mr-2 text-primary-500"></i>
                                Deskripsi Acara
                            </label>
                            <textarea name="event_description" id="event_description" rows="4"
                                class="form-input rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-all"
                                placeholder="Jelaskan detail acara Anda">{{ old('event_description') }}</textarea>
                            @error('event_description')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="bg-gradient-to-r from-primary-50 to-blue-50 p-6 rounded-xl border border-primary-100 shadow-sm">
                            <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center">
                                <i class="fas fa-receipt mr-2 text-primary-600"></i>
                                Ringkasan Booking
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center pb-2 border-b border-primary-100">
                                    <span class="text-gray-600 flex items-center">
                                        <i class="fas fa-building mr-2 text-primary-400"></i>
                                        Gedung:
                                    </span>
                                    <span id="summary-venue" class="font-medium text-gray-800">-</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-primary-100">
                                    <span class="text-gray-600 flex items-center">
                                        <i class="fas fa-calendar-day mr-2 text-primary-400"></i>
                                        Tanggal:
                                    </span>
                                    <span id="summary-date" class="font-medium text-gray-800">-</span>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-gray-700 font-bold flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2 text-primary-600"></i>
                                        Total:
                                    </span>
                                    <span id="summary-total" class="font-bold text-xl text-primary-700">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-between gap-4">
                            <a href="{{ route('bookings.index') }}"
                                class="btn btn-secondary flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary flex items-center justify-center">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Buat Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const venueSelect = document.getElementById('venue_id');
                const dateInput = document.getElementById('booking_date');
                const summaryVenue = document.getElementById('summary-venue');
                const summaryDate = document.getElementById('summary-date');
                const summaryTotal = document.getElementById('summary-total');

                function updateSummary() {
                    if (venueSelect.value) {
                        const selectedOption = venueSelect.options[venueSelect.selectedIndex];
                        summaryVenue.textContent = selectedOption.text.split(' - ')[0];

                        const price = parseFloat(selectedOption.dataset.price);
                        summaryTotal.textContent = `Rp ${price.toLocaleString('id-ID')}`;

                        // Animate the price change
                        summaryTotal.classList.add('text-primary-700');
                        setTimeout(() => {
                            summaryTotal.classList.remove('text-primary-700');
                        }, 300);
                    } else {
                        summaryVenue.textContent = '-';
                        summaryTotal.textContent = 'Rp 0';
                    }

                    if (dateInput.value) {
                        const date = new Date(dateInput.value);
                        summaryDate.textContent = date.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    } else {
                        summaryDate.textContent = '-';
                    }
                }

                venueSelect.addEventListener('change', updateSummary);
                dateInput.addEventListener('change', updateSummary);

                // Initial update
                updateSummary();

                // Add some animation to form inputs
                const formInputs = document.querySelectorAll('.form-input');
                formInputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('scale-105');
                        this.parentElement.style.transition = 'transform 0.2s ease';
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('scale-105');
                    });
                });
            });
        </script>
    @endpush
@endsection
