@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Image Section -->
                <div class="md:w-1/2 bg-gray-200">
                    @if(!empty($property['images']))
                        <img src="{{ $property['images'][0] }}" alt="{{ $property['title'] }}" class="w-full h-96 object-cover">
                    @else
                        <div class="flex items-center justify-center h-96 text-gray-500 text-xl">No Image Available</div>
                    @endif
                </div>

                <!-- Details Section -->
                <div class="md:w-1/2 p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <span
                                class="text-blue-600 font-bold tracking-wide uppercase text-sm">{{ $property['property_type'] }}</span>
                            <h1 class="mt-2 text-3xl font-extrabold text-gray-900">{{ $property['title'] }}</h1>
                            <p class="text-gray-500 mt-1 flex items-center">
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $property['location'] }}
                            </p>
                        </div>
                        <span
                            class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">{{ ucfirst($property['status']) }}</span>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-gray-900 text-2xl font-bold">${{ number_format($property['price']) }}</h2>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                        <div class="mt-2 text-gray-600 space-y-2">
                            {{ $property['description'] }}
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Agent</h3>
                        @auth
                            <form action="" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property['id'] }}">
                                <textarea name="message" rows="3"
                                    class="w-full border rounded p-3 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="I'm interested in this property..."></textarea>
                                <button type="button" onclick="alert('Inquiry feature coming soon!')"
                                    class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition">Send
                                    Inquiry</button>
                            </form>
                        @else
                            <div class="bg-blue-50 p-4 rounded text-center">
                                <p class="text-blue-800">Please <a href="{{ route('login') }}" class="font-bold underline">log
                                        in</a> to contact the agent.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection