@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Informasi Profil
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Perbarui informasi profil dan alamat email akun Anda.
                    </p>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" name="name" type="text" class="form-input"
                                value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-input"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-gray-600">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Ubah Password
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
                    </p>

                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input id="current_password" name="current_password" type="password" class="form-input"
                                autocomplete="current-password">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="form-label">Password Baru</label>
                            <input id="password" name="password" type="password" class="form-input"
                                autocomplete="new-password">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-input" autocomplete="new-password">
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                            @if (session('status') === 'password-updated')
                                <p class="text-sm text-gray-600">Tersimpan.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Hapus Akun
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
                    </p>

                    <div class="mt-6">
                        <button type="button" class="btn btn-danger" x-data
                            @click="$dispatch('open-modal', 'confirm-user-deletion')">
                            Hapus Akun
                        </button>
                    </div>

                    <div x-data="{ show: false, name: '' }" x-show="show"
                        x-on:open-modal.window="show = ($event.detail === 'confirm-user-deletion')" x-cloak
                        class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen p-4">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="show"
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
                                x-show="show" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        Apakah Anda yakin ingin menghapus akun Anda?
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara
                                        permanen. Silakan masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin
                                        menghapus akun Anda secara permanen.
                                    </p>

                                    <div class="mt-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" name="password" type="password" class="form-input"
                                            placeholder="Password" x-ref="password">
                                        @error('password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <button type="button" class="btn btn-secondary mr-3" @click="show = false">
                                            Batal
                                        </button>

                                        <button type="submit" class="btn btn-danger">
                                            Hapus Akun
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
