@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                Find Your Dream Home
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Browse our exclusive listings and find the perfect property for you.
            </p>
        </div>

        <!-- Search/Filter Placeholder -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-8 flex flex-col md:flex-row gap-4">
            <input type="text" placeholder="Search by location..."
                class="flex-1 border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select class="border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>All Types</option>
                <option>Apartment</option>
                <option>House</option>
            </select>
            <button
                class="bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700 transition">Search</button>
        </div>

        @if(empty($properties))
            <div class="text-center py-20 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg">No properties found.</p>
                @auth
                    <a href="{{ route('properties.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">List the
                        first property!</a>
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($properties as $property)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 bg-gray-200 relative">
                            @if(!empty($property['images']))
                                <!-- Assuming first image is the main one -->
                                <img src="{{ $property['images'][0] }}" alt="{{ $property['title'] }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                                {{ $property['status'] }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">
                                    {{ $property['property_type'] }}
                                </span>
                                <div class="ml-2 text-gray-600 text-xs uppercase font-semibold tracking-wide">
                                    {{ $property['location'] }}
                                </div>
                            </div>
                            <h4 class="mt-2 text-xl font-bold text-gray-900 leading-tight truncate">
                                {{ $property['title'] }}
                            </h4>
                            <div class="mt-1">
                                <span class="text-gray-900 font-bold text-lg">${{ number_format($property['price']) }}</span>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <a href="{{ route('properties.show', $property['id']) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold text-sm">View Details &rarr;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection