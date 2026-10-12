@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-xl font-bold">Detail Booking #{{ $booking->id }}</h2>
                <div>
                    @if ($booking->status == 'pending')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif($booking->status == 'approved')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Disetujui
                        </span>
                    @elseif($booking->status == 'rejected')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                            Dibatalkan
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Informasi Booking</h3>

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
                                <p class="font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        @if ($booking->event_description)
                            <div class="mt-4">
                                <p class="text-gray-600">Deskripsi Acara</p>
                                <p class="font-medium">{{ $booking->event_description }}</p>
                            </div>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold mb-4">Informasi Pengguna</h3>

                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Nama</p>
                                <p class="font-medium">{{ $booking->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Email</p>
                                <p class="font-medium">{{ $booking->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($booking->status == 'rejected')
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        <span class="font-bold">Alasan Penolakan:</span> {{ $booking->rejection_reason }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($booking->status == 'pending')
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Setujui Booking</button>
                            </form>

                            <button type="button" class="btn btn-danger" onclick="showRejectModal()">Tolak Booking</button>
                        </div>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Bukti Pembayaran</h3>

                    @if ($booking->payment_proof)
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <p class="text-gray-600 mb-2">Tanggal Pembayaran</p>
                            <p class="font-medium mb-4">{{ $booking->payment_date->format('d M Y H:i') }}</p>

                            <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Bukti Pembayaran"
                                class="w-full h-auto rounded-lg">
                        </div>
                    @else
                        <div class="bg-yellow-50 rounded-lg p-4 mb-6 text-center">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-2"></i>
                            <p class="text-yellow-700">Pengguna belum mengupload bukti pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="reject-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Tolak Booking</h3>

            <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="rejection_reason" class="form-label">Alasan Penolakan</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="3" class="form-input" required></textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" class="btn btn-secondary" onclick="hideRejectModal()">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function showRejectModal() {
                document.getElementById('reject-modal').classList.remove('hidden');
            }

            function hideRejectModal() {
                document.getElementById('reject-modal').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
