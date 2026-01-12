@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">List New Property</h2>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title"
                        class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                    <input type="text" name="location"
                        class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price ($)</label>
                    <input type="number" name="price"
                        class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select name="property_type"
                        class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500">
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Villa">Villa</option>
                        <option value="Commercial">Commercial</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status"
                        class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500">
                        <option value="available">Available</option>
                        <option value="rented">Rented</option>
                        <option value="sold">Sold</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                    <input type="file" name="image" class="w-full text-gray-700 px-3 py-2 border rounded">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-blue-500"
                    required></textarea>
            </div>

            <div class="mt-8">
                <button type="submit"
                    class="bg-blue-600 text-white font-bold py-3 px-6 rounded hover:bg-blue-700 w-full md:w-auto transition duration-300">
                    Submit Listing
                </button>
            </div>
        </form>
    </div>
@endsection