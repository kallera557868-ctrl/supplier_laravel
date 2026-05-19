<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Supplier
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

                <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Supplier Name</label>
                        <input type="text" name="name" value="{{ $supplier->name }}"
                               class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Contact Number</label>
                        <input type="text" name="contact" value="{{ $supplier->contact }}"
                               class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Email</label>
                        <input type="email" name="email" value="{{ $supplier->email }}"
                               class="w-full border rounded px-3 py-2" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Category</label>
                        <select name="category" class="w-full border rounded px-3 py-2" required>
                            @foreach(['Electronics','Hardware','Raw Materials','Office Supply','Logistics'] as $cat)
                                <option value="{{ $cat }}" {{ $supplier->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Address</label>
                        <textarea name="address" class="w-full border rounded px-3 py-2" rows="2" required>{{ $supplier->address }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="Active" {{ $supplier->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $supplier->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold">
                            Update Supplier
                        </button>
                        <a href="{{ route('suppliers.index') }}"
                           class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded font-semibold">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>