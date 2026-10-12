@extends('layouts.admin')

@section('title', 'Edit Rekening Pembayaran')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <form action="{{ route('admin.payment-details.update', $paymentDetail) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="bank_name" class="form-label">Nama Bank</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-input"
                        value="{{ old('bank_name', $paymentDetail->bank_name) }}" required>
                    @error('bank_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="account_number" class="form-label">Nomor Rekening</label>
                    <input type="text" name="account_number" id="account_number" class="form-input"
                        value="{{ old('account_number', $paymentDetail->account_number) }}" required>
                    @error('account_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="account_name" class="form-label">Atas Nama</label>
                    <input type="text" name="account_name" id="account_name" class="form-input"
                        value="{{ old('account_name', $paymentDetail->account_name) }}" required>
                    @error('account_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.payment-details.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
