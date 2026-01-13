<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden bg-gray-50">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <!-- Sidebar components, swap this element with another sidebar if you like -->
                <div class="flex flex-col h-0 flex-1 bg-slate-900 shadow-xl">
                    <div class="flex-1 flex flex-col pt-8 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-6 mb-8">
                            <svg class="h-8 w-8 text-blue-500 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="text-2xl font-extrabold text-white tracking-tight">Estate<span
                                    class="text-blue-500">Pro</span></span>
                        </div>
                        <nav class="mt-2 flex-1 px-4 space-y-2">
                            <a href="{{ route('dashboard') }}"
                                class="group flex items-center px-4 py-3 text-sm font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-900/50' : 'text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl' }}">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-blue-400' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>

                            @if(Auth::user()->isAdmin())
                                <div class="pt-6 pb-2">
                                    <h3
                                        class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-4 mb-2">
                                        Administration
                                    </h3>
                                    <div class="space-y-1">
                                        <a href="{{ route('admin.users') }}"
                                            class="group flex items-center px-4 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-slate-800 text-white rounded-xl' : 'text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl' }}">
                                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users') ? 'text-blue-400' : 'text-slate-500 group-hover:text-blue-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                                </path>
                                            </svg>
                                            User Management
                                        </a>
                                        <a href="{{ route('admin.properties') }}"
                                            class="group flex items-center px-4 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.properties') ? 'bg-slate-800 text-white rounded-xl' : 'text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl' }}">
                                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.properties') ? 'text-blue-400' : 'text-slate-500 group-hover:text-blue-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                            Property Control
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="pt-6 pb-2">
                                <h3
                                    class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-4 mb-2">
                                    General
                                </h3>
                                <div class="space-y-1">
                                    <a href="{{ route('properties.index') }}"
                                        class="group flex items-center px-4 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition-all duration-200">
                                        <svg class="mr-3 h-5 w-5 text-slate-500 group-hover:text-blue-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        Properties
                                    </a>
                                    <a href="{{ route('kb.index') }}"
                                        class="group flex items-center px-4 py-2.5 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition-all duration-200">
                                        <svg class="mr-3 h-5 w-5 text-slate-500 group-hover:text-blue-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        Resources
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <!-- User Profile section in sidebar -->
                    <div class="flex-shrink-0 flex bg-slate-800/50 p-4 m-4 rounded-2xl border border-slate-700/50">
                        <div class="flex items-center w-full">
                            <div class="relative">
                                <img class="h-10 w-10 rounded-xl border-2 border-blue-500/30"
                                    src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&bold=true&name=' . urlencode(Auth::user()->full_name ?? Auth::user()->email) }}"
                                    alt="">
                                <div
                                    class="absolute -bottom-1 -right-1 h-3 w-3 bg-green-500 border-2 border-slate-800 rounded-full">
                                </div>
                            </div>
                            <div class="ml-3 flex-1 overflow-hidden">
                                <p class="text-sm font-bold text-white truncate">
                                    {{ Auth::user()->full_name ?? 'User' }}
                                </p>
                                <p class="text-[10px] font-medium text-slate-500 tracking-wider uppercase">
                                    {{ Auth::user()->role ?? 'Client' }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="ml-2">
                                @csrf
                                <button type="submit"
                                    class="p-2 text-slate-500 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors"
                                    title="Logout">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>