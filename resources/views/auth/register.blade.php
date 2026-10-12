@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full flex flex-col">
            <!-- Logo Area -->
            <div class="mx-auto mb-6">
                <div class="bg-white rounded-full p-3 shadow-md">
                    <div class="h-12 w-12 flex items-center justify-center rounded-full bg-primary-600">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Card Header -->
                <div class="bg-primary-600 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white text-center">
                        Daftar Akun Baru
                    </h2>
                </div>

                <!-- Card Body -->
                <div class="p-8">
                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-green-500">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input id="name" name="name" type="text" autocomplete="name" required
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 sm:text-sm"
                                        placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 sm:text-sm"
                                        placeholder="nama@perusahaan.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input id="password" name="password" type="password" autocomplete="new-password"
                                        required
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 sm:text-sm"
                                        placeholder="Minimal 8 karakter">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" onclick="togglePassword('password', 'password-toggle-icon')"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                            <i class="fas fa-eye" id="password-toggle-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        autocomplete="new-password" required
                                        class="pl-10 block w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 sm:text-sm"
                                        placeholder="Ulangi password">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button"
                                            onclick="togglePassword('password_confirmation', 'confirm-toggle-icon')"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                            <i class="fas fa-eye" id="confirm-toggle-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                Saya menyetujui <a href="#" class="text-primary-600 hover:text-primary-700">Syarat &
                                    Ketentuan</a> dan <a href="#"
                                    class="text-primary-600 hover:text-primary-700">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-200 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <i
                                        class="fas fa-user-plus text-primary-300 group-hover:text-primary-200 transition-colors duration-200"></i>
                                </span>
                                Daftar Sekarang
                            </button>
                        </div>


                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 text-center">
                            <p class="text-sm text-gray-600">
                                Sudah memiliki akun?
                                <a href="{{ route('login') }}"
                                    class="font-medium text-primary-600 hover:text-primary-700 transition-colors duration-200">
                                    Login sekarang
                                </a>
                            </p>
                        </div>
                </div>

                <!-- Footer Links -->
                <div class="mt-6 flex justify-center space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <span class="text-sm">Bantuan</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <span class="text-sm">Kebijakan Privasi</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                        <span class="text-sm">Syarat & Ketentuan</span>
                    </a>
                </div>
            </div>
        </div>

        <script>
            function togglePassword(inputId, iconId) {
                const passwordInput = document.getElementById(inputId);
                const passwordToggleIcon = document.getElementById(iconId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggleIcon.classList.remove('fa-eye');
                    passwordToggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggleIcon.classList.remove('fa-eye-slash');
                    passwordToggleIcon.classList.add('fa-eye');
                }
            }
        </script>
    @endsection
