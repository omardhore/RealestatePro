@extends('layouts.dashboard')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">User Management</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all registered users and their roles.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                    Add User
                </a>
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
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Joined
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($users as $user)
                                                        <tr>
                                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                                <div class="flex items-center">
                                                                    <div class="h-10 w-10 flex-shrink-0">
                                                                        <img class="h-10 w-10 rounded-full"
                                                                            src="{{ $user['avatar_url'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['full_name'] ?? 'User') }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="ml-4">
                                                                        <div class="font-medium text-gray-900">{{ $user['full_name'] ?? 'N/A' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ $user['email'] ?? 'N/A' }}</td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                    {{ ($user['role'] ?? '') === 'admin' ? 'bg-purple-100 text-purple-800' :
                                    (($user['role'] ?? '') === 'agent' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                                                    {{ ucfirst($user['role'] ?? 'User') }}
                                                                </span>
                                                            </td>
                                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                                {{ isset($user['created_at']) ? \Carbon\Carbon::parse($user['created_at'])->format('M d, Y') : 'N/A' }}
                                                            </td>
                                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                                <a href="{{ route('admin.users.edit', $user['id']) }}" class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                                                                
                                                                @if($user['id'] !== Auth::user()->id)
                                                                <form action="{{ route('admin.users.delete', $user['id']) }}" method="POST" class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                                </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-4 text-sm text-gray-500 text-center">No users found.</td>
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