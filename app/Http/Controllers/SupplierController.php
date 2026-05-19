<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $suppliers = Supplier::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
        })->latest()->get();

        return view('suppliers.index', compact('suppliers', 'search'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name'     => 'required|string|max:100',
            'contact'  => 'required|string|max:20',
            'email'    => 'required|email|max:100',
            'category' => 'required|string|max:50',
            'address'  => 'required|string',
            'status'   => 'required|in:Active,Inactive',
        ]);

        Supplier::create([
            'user_id'  => Auth::id(),
            'name'     => $request->name,
            'contact'  => $request->contact,
            'email'    => $request->email,
            'category' => $request->category,
            'address'  => $request->address,
            'status'   => $request->status,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully!');
    }

    public function edit(Supplier $supplier)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name'     => 'required|string|max:100',
            'contact'  => 'required|string|max:20',
            'email'    => 'required|email|max:100',
            'category' => 'required|string|max:50',
            'address'  => 'required|string',
            'status'   => 'required|in:Active,Inactive',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted.');
    }
}