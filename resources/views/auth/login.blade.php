<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EstatePro</title>
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex">
    <!-- Left: Branding & Visual (Desktop) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0 opacity-50">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 alt="Luxury Property" 
                 class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 z-10 bg-gradient-to-tr from-slate-950 via-slate-900/60 to-transparent"></div>
        
        <div class="relative z-20 w-full p-16 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 text-white">
                    <svg class="h-10 w-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-3xl font-extrabold tracking-tight">Estate<span class="text-blue-500">Pro</span></span>
                </div>
            </div>

            <div class="max-w-md">
                <h1 class="text-5xl font-extrabold text-white leading-tight mb-6">
                    Manage your <span class="text-blue-500">real estate</span> empire with precision.
                </h1>
                <p class="text-xl text-slate-300 leading-relaxed italic">
                    "The simplest way for professionals to track properties, manage users, and deliver excellence."
                </p>
            </div>

            <div class="flex items-center space-x-2 text-slate-400 text-sm">
                <span>&copy; {{ date('Y') }} EstatePro Management Systems. All rights reserved.</span>
            </div>
        </div>
    </div>

    <!-- Right: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white lg:bg-slate-50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center justify-center space-x-3 mb-12">
                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-2xl font-bold text-slate-900 tracking-tight text-center">EstatePro</span>
            </div>

            <div class="text-center lg:text-left mb-10">
                <h2 class="text-3xl font-black text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-slate-500 font-medium">Please enter your credentials to access the portal.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-100 flex items-start space-x-3">
                    <svg class="h-5 w-5 text-rose-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-sm font-semibold text-rose-600">
                        {{ $errors->first() }}
                    </span>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2 ml-1">Work Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="w-full pl-11 pr-4 py-4 bg-white border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400" 
                               placeholder="name@company.com" required>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-widest leading-none">Password</label>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="w-full pl-11 pr-4 py-4 bg-white border border-slate-200 rounded-2xl text-slate-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400" 
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 block text-sm font-medium text-slate-600">Remember me for 30 days</label>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-2xl shadow-xl shadow-blue-200 bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    Sign In to Portal
                </button>
            </form>

            <!-- Footer Link -->
            <p class="mt-10 text-center text-sm text-slate-500 font-medium">
                New to the platform? <a href="#" class="text-blue-600 font-bold hover:text-blue-800">Contact Admin</a>
            </p>
        </div>
    </div>
</body>

</html>