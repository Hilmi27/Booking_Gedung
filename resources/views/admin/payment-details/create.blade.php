@extends('layouts.admin')

@section('title', 'Tambah Rekening Pembayaran')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Rekening Pembayaran</h2>

                <form action="{{ route('admin.payment-details.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                                <input type="text" name="bank_name" id="bank_name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    value="{{ old('bank_name') }}" placeholder="Masukkan nama bank" required>
                                @error('bank_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                    Rekening</label>
                                <input type="text" name="account_number" id="account_number"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    value="{{ old('account_number') }}" placeholder="Masukkan nomor rekening" required>
                                @error('account_number')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                            <input type="text" name="account_name" id="account_name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('account_name') }}" placeholder="Masukkan nama pemilik rekening" required>
                            @error('account_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center space-x-3 pt-4 mt-6 border-t border-gray-100">
                            <a href="{{ route('admin.payment-details.index') }}"
                                class="px-5 py-2.5 rounded-lg bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
