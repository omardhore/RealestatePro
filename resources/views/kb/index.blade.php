@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center py-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Knowledge Base
            </h1>
            <p class="mt-4 text-lg text-gray-500">
                Find answers to common questions and guides for buying/selling.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="inline-flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </span>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">{{ $article['title'] }}</h3>
                        </div>
                        <p class="text-gray-500 h-20 overflow-hidden">
                            {{ \Illuminate\Support\Str::limit($article['content'], 100) }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('kb.show', $article['id']) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Read Article &rarr;</a>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <span
                            class="text-xs text-gray-500 uppercase tracking-wide font-bold">{{ $article['category'] ?? 'General' }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-lg border-2 border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" class="h-6 w-6" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No Articles Found</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for updates.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection