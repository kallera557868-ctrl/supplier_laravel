<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Add New Supplier
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        @foreach($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Supplier Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Contact Number</label>
                        <input type="text" name="contact" value="{{ old('contact') }}" class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Category</label>
                        <select name="category" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Select Category --</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Raw Materials">Raw Materials</option>
                            <option value="Office Supply">Office Supply</option>
                            <option value="Logistics">Logistics</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Address</label>
                        <textarea name="address" class="w-full border rounded px-3 py-2" rows="2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex gap-2 mt-4">
                       <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded font-semibold">Save Supplier</button>
                        <a href="{{ route('suppliers.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded font-semibold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>