@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('kb.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Knowledge Base
            </a>
        </div>

        <article class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-900">{{ $article['title'] }}</h1>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mr-2">
                        {{ $article['category'] ?? 'Guide' }}
                    </span>
                    <span>Published on {{ \Carbon\Carbon::parse($article['created_at'])->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 prose max-w-none text-gray-900">
                {!! nl2br(e($article['content'])) !!}
            </div>
        </article>
    </div>
@endsection