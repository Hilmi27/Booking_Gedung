<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Booking Gedung Kesenian</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>

    <!-- Animation library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-in-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        slideIn: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            },
                        }
                    },
                    transitionProperty: {
                        'width': 'width',
                        'height': 'height',
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
            @apply block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 transition-all duration-200;
        }

        .btn {
            @apply inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200;
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

        /* Sidebar animation */
        .sidebar-enter-active {
            animation: slideInRight 0.3s;
        }

        .sidebar-leave-active {
            animation: slideOutLeft 0.3s;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Hover animation for nav items */
        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background-color: currentColor;
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        /* Pulse notification */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen font-sans">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar backdrop -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
        </div>

        <!-- Sidebar -->
        <div x-show="sidebarOpen || window.innerWidth >= 1024"
            class="fixed inset-y-0 left-0 w-64 z-30 bg-gradient-to-b from-gray-900 to-gray-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
            @resize.window="sidebarOpen = window.innerWidth >= 1024">

            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="px-6 py-5 bg-gray-900 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center group">
                        <i
                            class="fas fa-theater-masks text-primary-400 text-2xl mr-3 transition-transform duration-300 group-hover:scale-110"></i>
                        <span class="font-bold text-lg text-white tracking-wide">Admin Panel</span>
                    </a>
                    <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white lg:hidden">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <div class="flex-1 flex flex-col overflow-y-auto scrollbar-thin py-4">
                    <nav class="flex-1 px-2">
                        <div class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('admin.venues.index') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.venues.*') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-building w-5 h-5 mr-3"></i>
                                <span>Gedung</span>
                            </a>

                            <a href="{{ route('admin.facilities.index') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.facilities.*') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-list-ul w-5 h-5 mr-3"></i>
                                <span>Fasilitas</span>
                            </a>

                            <a href="{{ route('admin.bookings.index') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.bookings.*') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                                <span>Booking</span>
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.users.*') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-users w-5 h-5 mr-3"></i>
                                <span>Pengguna</span>
                            </a>

                            <a href="{{ route('admin.payment-details.index') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm {{ request()->routeIs('admin.payment-details.*') ? 'bg-primary-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200">
                                <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                                <span>Rekening Pembayaran</span>
                            </a>
                        </div>

                        <div class="border-t border-gray-700 my-5 opacity-30"></div>

                        <div class="space-y-1">
                            <a href="{{ route('home') }}"
                                class="nav-item flex items-center px-4 py-3 rounded-lg text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-200">
                                <i class="fas fa-home w-5 h-5 mr-3"></i>
                                <span>Kembali ke Website</span>
                            </a>
                        </div>
                    </nav>
                </div>

                <!-- User profile card -->
                <div class="p-4 bg-gray-800 bg-opacity-50 border-t border-gray-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="h-9 w-9 rounded-full bg-primary-700 flex items-center justify-center text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-3 min-w-0 flex-1">
                            <div class="text-sm font-medium text-white truncate">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-xs text-gray-400 truncate">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="text-gray-400 hover:text-white transition duration-150">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="origin-bottom-right absolute right-0 bottom-10 mb-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-10"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                                {{-- <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i> Profil Saya
                                </a> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top header -->
            <header class="bg-white shadow-sm z-10">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="text-gray-500 hover:text-gray-600 lg:hidden focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 rounded-md p-2">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-3 text-lg font-semibold text-gray-900 truncate">@yield('title')</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="p-1 text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-full">
                                <span class="sr-only">View notifications</span>
                                <i class="fas fa-bell text-lg"></i>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-10"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h3 class="text-sm font-medium text-gray-700">Notifikasi</h3>
                                </div>
                                <div class="max-h-60 overflow-y-auto">
                                    <div class="p-4 text-center text-sm text-gray-500">
                                        Tidak ada notifikasi baru
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 rounded-full">
                                <span class="sr-only">Open user menu</span>
                                <span
                                    class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                                <span class="ml-2 hidden md:flex">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-xs hidden md:block"></i>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-10"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" x-cloak>
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm text-gray-900 font-medium">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                {{-- <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-circle mr-2"></i> Profil Saya
                                </a> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 px-4 sm:px-6 lg:px-8 py-6">
                <!-- Alerts -->
                @if (session('success'))
                    <div class="animate__animated animate__fadeIn mb-6">
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm"
                            role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="animate__animated animate__fadeIn mb-6">
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm"
                            role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Page content -->
                <div class="animate__animated animate__fadeIn animate__faster">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} Booking Gedung Kesenian. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
