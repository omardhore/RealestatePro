@extends('layouts.dashboard')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Property Approvals</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all properties requiring action.</p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Agent
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($properties as $property)
                                                        <tr>
                                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                {{ $property['title'] }}
                                                                <br>
                                                                <span class="text-xs text-gray-500">{{ $property['location'] }}</span>
                                                            </td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{-- Basic agent info if join worked, else ID --}}
                                                                {{ $property['agent_id'] }}
                                                            </td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                ${{ number_format($property['price']) }}</td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                    {{ $property['status'] === 'available' ? 'bg-green-100 text-green-800' :
                                    ($property['status'] === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                                    {{ ucfirst($property['status']) }}
                                                                </span>
                                                            </td>
                                                            <td
                                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                <a href="{{ route('properties.show', $property['id']) }}"
                                                                    class="text-blue-600 hover:text-blue-900 mr-4">View</a>

                                                                <form action="{{ route('admin.properties.approve', $property['id']) }}"
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                                                </form>

                                                                <form action="{{ route('admin.properties.reject', $property['id']) }}" method="POST"
                                                                    class="inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                                                </form>
                                                                <form action="{{ route('admin.properties.delete', $property['id']) }}" method="POST"
                                                                    class="inline ml-2">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-gray-600 hover:text-gray-900"
                                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-4 text-sm text-gray-500 text-center">No properties found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection