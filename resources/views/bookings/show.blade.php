@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600">
                            <i class="fas fa-home mr-2"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('bookings.index') }}" class="text-gray-700 hover:text-primary-600">Booking
                                Saya</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">Detail Booking</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-2xl font-bold">Detail Booking #{{ $booking->id }}</h1>
                        <div>
                            @if ($booking->status == 'pending')
                                <span
                                    class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($booking->status == 'approved')
                                <span
                                    class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @elseif($booking->status == 'rejected')
                                <span
                                    class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-xl font-bold mb-4">Informasi Booking</h2>

                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-600">Gedung</p>
                                        <p class="font-medium">{{ $booking->venue->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Tanggal</p>
                                        <p class="font-medium">{{ $booking->booking_date->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Acara</p>
                                        <p class="font-medium">{{ $booking->event_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Total</p>
                                        <p class="font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                @if ($booking->event_description)
                                    <div class="mt-4">
                                        <p class="text-gray-600">Deskripsi Acara</p>
                                        <p class="font-medium">{{ $booking->event_description }}</p>
                                    </div>
                                @endif
                            </div>

                            @if ($booking->status == 'rejected' || $booking->status == 'cancelled')
                                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-red-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-red-700">
                                                {{ $booking->rejection_reason }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($booking->status == 'pending' && !$booking->payment_proof)
                                <div class="flex space-x-2">
                                    <a href="{{ route('venues.show', $booking->venue) }}" class="btn btn-secondary">Lihat
                                        Gedung</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">Batalkan
                                            Booking</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('venues.show', $booking->venue) }}" class="btn btn-secondary">Lihat
                                    Gedung</a>
                            @endif
                        </div>

                        <div>
                            <h2 class="text-xl font-bold mb-4">Pembayaran</h2>

                            @if ($booking->payment_proof)
                                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                    <p class="text-gray-600 mb-2">Status Pembayaran</p>
                                    @if ($booking->status == 'approved')
                                        <p class="text-green-600 font-medium mb-4">Pembayaran telah dikonfirmasi</p>
                                    @elseif($booking->status == 'rejected')
                                        <p class="text-red-600 font-medium mb-4">Pembayaran ditolak</p>
                                    @else
                                        <p class="text-yellow-600 font-medium mb-4">Menunggu konfirmasi admin</p>
                                    @endif

                                    <p class="text-gray-600 mb-2">Bukti Pembayaran</p>
                                    <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Bukti Pembayaran"
                                        class="w-full h-auto rounded-lg">

                                    <p class="text-gray-600 mt-4 mb-2">Tanggal Pembayaran</p>
                                    <p class="font-medium">{{ $booking->payment_date->format('d M Y H:i') }}</p>
                                </div>
                            @elseif($booking->status == 'pending')
                                <div class="bg-yellow-50 rounded-lg p-4 mb-6">
                                    <h3 class="font-bold mb-2">Instruksi Pembayaran</h3>
                                    <p class="mb-4">Silakan transfer sejumlah <span class="font-bold">Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</span> ke salah satu
                                        rekening berikut:</p>

                                    <div class="space-y-4">
                                        @foreach ($paymentDetails as $payment)
                                            <div class="bg-white p-3 rounded-md">
                                                <p class="font-bold">{{ $payment->bank_name }}</p>
                                                <p>No. Rekening: {{ $payment->account_number }}</p>
                                                <p>Atas Nama: {{ $payment->account_name }}</p>
                                            </div>
                                        @endforeach
                                    </div>

                                    <p class="mt-4 text-sm text-yellow-700">Setelah melakukan pembayaran, silakan upload
                                        bukti pembayaran di bawah ini.</p>
                                </div>

                                <form action="{{ route('bookings.upload-payment', $booking) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                                        <input type="file" name="payment_proof" id="payment_proof" class="form-input"
                                            accept="image/*" required>
                                        @error('payment_proof')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-full">Upload Bukti Pembayaran</button>
                                </form>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 mb-6 text-center">
                                    <i class="fas fa-ban text-gray-400 text-4xl mb-2"></i>
                                    <p class="text-gray-600">Booking telah dibatalkan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
