<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Supplier List
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">All Suppliers ({{ count($suppliers) }})</h3>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('suppliers.create') }}"
                           class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded font-semibold">
                            + Add Supplier
                        </a>
                    @endif
                </div>

                <!-- Search -->
                <form method="GET" action="{{ route('suppliers.index') }}" class="mb-4">
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Search by name, category, status..."
                               class="border rounded px-3 py-2 w-80"/>
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Search</button>
                        @if($search)
                            <a href="{{ route('suppliers.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Clear</a>
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-left">Contact</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Category</th>
                                <th class="px-4 py-3 text-left">Address</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                @if(Auth::user()->role === 'admin')
                                    <th class="px-4 py-3 text-left">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $supplier)
                            <tr class="border-b hover:bg-pink-50">
                                <td class="px-4 py-3">{{ $supplier->id }}</td>
                                <td class="px-4 py-3 font-semibold">{{ $supplier->name }}</td>
                                <td class="px-4 py-3">{{ $supplier->contact }}</td>
                                <td class="px-4 py-3">{{ $supplier->email }}</td>
                                <td class="px-4 py-3">{{ $supplier->category }}</td>
                                <td class="px-4 py-3">{{ $supplier->address }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold
                                        {{ $supplier->status === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $supplier->status }}
                                    </span>
                                </td>
                                @if(Auth::user()->role === 'admin')
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                       class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                          onsubmit="return confirm('Delete this supplier?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded text-sm">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-400">
                                    No suppliers found. 
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('suppliers.create') }}" class="text-pink-500">Add one!</a>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>