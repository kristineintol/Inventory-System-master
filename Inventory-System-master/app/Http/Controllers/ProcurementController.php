<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisition; // Make sure to import your Requisition model
use App\Models\Product;
use App\Models\Technician;

class ProcurementController extends Controller
{
    public function index(Request $request)
    {
        $row = $request->input('row', 10);
        $search = $request->input('search', '');

        $requisitions = Requisition::where('user_id', auth()->id())->where('status', 1)->where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('product_id', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('quantity', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            }
        })->paginate($row);

        if(auth()->user()->is_admin){
            $requisitions = Requisition::where('status', 1)->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('product_id', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('quantity', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%');
                }
            })->paginate($row);
        }

        foreach ($requisitions as $key => $requisition) {
            $product = Product::find($requisition->product_id);
            $requisition->product = $product;
        }

        return view('procurements.index', compact('requisitions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('procurements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Requisition::create($request->all());

        return redirect()->route('procurements.index')
            ->with('success', 'Procurement created successfully.');
    }

    public function show($id)
    {
        $requisition = Requisition::findOrFail($id);
        $requisition->product_id = Product::find($requisition->product_id)->sloc_name;
        $requisition->technician = Technician::find($requisition->technician_id);
        return view('procurements.show', compact('requisition'));
    }

    public function edit($id)
    {
        $products = Product::all();
        $requisition = Requisition::findOrFail($id);
        $technicians = Technician::all();
        return view('procurements.edit', compact('requisition', 'products', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $requisition = Requisition::findOrFail($id);
        $requisition->update($request->all());

        return redirect()->route('procurements.index')
            ->with('success', 'Procurement updated successfully.');
    }

    public function destroy($id)
    {
        $requisition = Requisition::findOrFail($id);
        $requisition->delete();

        return redirect()->route('procurements.index')
            ->with('success', 'Procurement deleted successfully.');
    }
}
