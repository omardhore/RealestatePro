@extends('layouts.dashboard')

@section('content')
    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Overview
                </h2>
                <p class="mt-1 text-sm text-slate-500 font-medium">
                    Welcome back, <span
                        class="text-blue-600 font-bold">{{ explode(' ', Auth::user()->full_name ?? Auth::user()->email)[0] }}</span>.
                    Here's what's happening today.
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('properties.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Property
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-6 mb-10 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-2xl">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Properties</p>
                        <h4 class="text-2xl font-black text-slate-900">Explore</h4>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('properties.index') }}" class="text-blue-600 text-sm font-bold hover:underline">View
                        All &rarr;</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-50 rounded-2xl">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Community</p>
                        <h4 class="text-2xl font-black text-slate-900">Manage</h4>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('admin.users') }}" class="text-purple-600 text-sm font-bold hover:underline">Users
                        &rarr;</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-amber-50 rounded-2xl">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Resources</p>
                        <h4 class="text-2xl font-black text-slate-900">Insights</h4>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('kb.index') }}" class="text-amber-600 text-sm font-bold hover:underline">Knowledge
                        Base &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Secondary Section: Recent Activity / Announcements -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-50 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <a href="{{ route('properties.index') }}"
                                class="flex flex-col items-center p-4 bg-slate-50 rounded-2xl hover:bg-blue-50 transition-colors group">
                                <div class="p-3 bg-white rounded-xl shadow-sm mb-3 group-hover:text-blue-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-600">Search</span>
                            </a>
                            <a href="{{ route('admin.properties') }}"
                                class="flex flex-col items-center p-4 bg-slate-50 rounded-2xl hover:bg-purple-50 transition-colors group">
                                <div class="p-3 bg-white rounded-xl shadow-sm mb-3 group-hover:text-purple-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-600">Requests</span>
                            </a>
                            <a href="{{ route('admin.users') }}"
                                class="flex flex-col items-center p-4 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-colors group">
                                <div class="p-3 bg-white rounded-xl shadow-sm mb-3 group-hover:text-emerald-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-600">Add User</span>
                            </a>
                            <a href="#"
                                class="flex flex-col items-center p-4 bg-slate-50 rounded-2xl hover:bg-rose-50 transition-colors group">
                                <div class="p-3 bg-white rounded-xl shadow-sm mb-3 group-hover:text-rose-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-600">Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-slate-900 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-4">Go Mobile</h3>
                        <p class="text-slate-400 text-sm mb-6 leading-relaxed">Access your real estate portfolio from
                            anywhere. Download the EstatePro agent app.</p>
                        <button
                            class="w-full bg-white text-slate-900 py-3 rounded-2xl font-bold text-sm hover:bg-slate-100 transition-colors">
                            Get the App
                        </button>
                    </div>
                    <div class="absolute -right-10 -bottom-10 h-40 w-40 bg-blue-600 rounded-full blur-3xl opacity-20"></div>
                </div>
            </div>
        </div>
    </div>
@endsection