<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Booking Gedung Kesenian</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom styles */
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }

        .form-input {
            @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500;
        }

        .btn {
            @apply inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2;
        }

        .btn-primary {
            @apply bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500;
        }

        .btn-secondary {
            @apply bg-gray-200 text-gray-700 hover:bg-gray-300 focus:ring-gray-500;
        }

        .btn-danger {
            @apply bg-red-600 text-white hover:bg-red-700 focus:ring-red-500;
        }

        .btn-success {
            @apply bg-green-600 text-white hover:bg-green-700 focus:ring-green-500;
        }

        .btn-white {
            @apply bg-white text-primary-700 hover:bg-gray-50 focus:ring-primary-500;
        }

        .btn-outline-primary {
            @apply bg-white text-primary-600 border-primary-600 hover:bg-primary-50 focus:ring-primary-500;
        }

        .btn-outline-white {
            @apply bg-transparent text-white border-white hover:bg-white hover:text-primary-700 focus:ring-white;
        }

        .btn-lg {
            @apply px-6 py-3 text-base;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-primary-600 font-bold text-xl">
                            <i class="fas fa-theater-masks mr-2"></i> Booking Gedung Kesenian
                        </a>
                    </div>
                    <nav class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            Beranda
                        </a>
                        {{-- <a href="{{ route('venues.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('venues.*') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            Gedung
                        </a> --}}
                        @auth
                            <a href="{{ route('bookings.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('bookings.*') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Booking Saya
                            </a>
                        @endauth
                    </nav>
                </div>

                <div class="hidden md:ml-6 md:flex md:items-center">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary ml-4">Daftar</a>
                    @else
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open"
                                    class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                </button>
                            </div>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-10"
                                x-cloak>
                                @if (Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Dashboard Admin
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <div class="-mr-2 flex items-center md:hidden" x-data="{ open: false }">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500"
                        aria-controls="mobile-menu" aria-expanded="false" @click="open = !open">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars" x-show="!open"></i>
                        <i class="fas fa-times" x-show="open" x-cloak></i>
                    </button>

                    <!-- Mobile menu -->
                    <div class="md:hidden absolute top-16 left-0 right-0 bg-white shadow-lg z-50" id="mobile-menu">
                        <div class="pt-2 pb-3 space-y-1" x-show="open" x-cloak>
                            <a href="{{ route('home') }}"
                                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                                Beranda
                            </a>
                            <a href="{{ route('venues.index') }}"
                                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('venues.*') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                                Gedung
                            </a>
                            @auth
                                <a href="{{ route('bookings.index') }}"
                                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('bookings.*') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                                    Booking Saya
                                </a>
                            @endauth
                        </div>

                        <div class="pt-4 pb-3 border-t border-gray-200" x-show="open" x-cloak>
                            @guest
                                <div class="flex items-center px-4">
                                    <a href="{{ route('login') }}"
                                        class="block text-gray-500 hover:text-gray-700">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-primary ml-auto">Daftar</a>
                                </div>
                            @else
                                <div class="flex items-center px-4">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                            <span
                                                class="text-primary-700 font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                                <div class="mt-3 space-y-1">
                                    @if (Auth::user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                            Dashboard Admin
                                        </a>
                                    @endif

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-4 mt-4 sm:mx-6 lg:mx-8"
                role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-4 mt-4 sm:mx-6 lg:mx-8"
                role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Booking Gedung Kesenian</h3>
                    <p class="text-gray-400">
                        Platform booking gedung kesenian terbaik untuk berbagai acara seni dan budaya Anda.
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Tautan</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('venues.index') }}" class="text-gray-400 hover:text-white">Gedung</a>
                        </li>
                        @guest
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Daftar</a></li>
                        @else
                            <li><a href="{{ route('bookings.index') }}" class="text-gray-400 hover:text-white">Booking
                                    Saya</a></li>
                        @endguest
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">Jl. Imam Bonjol No.207, Pendrikan Kidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50131</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">+62 11-1704-2207</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Booking Gedung Kesenian. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
