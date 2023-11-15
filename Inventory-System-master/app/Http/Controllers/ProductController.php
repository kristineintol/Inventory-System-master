<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $products = Product::with([])
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        foreach ($products as $key => $product) {
            $requisitions = Requisition::where('product_id', $product->id)->get();
            $total_deduct = 0;
            foreach ($requisitions as $key => $requisition) {
                $total_deduct += $requisition->quantity;
            }
            $product->sap_qty = $product->sap_qty - $total_deduct;
        }

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'sloc_code' => 'required|string',
            'material_code' => 'required|string',
            'sloc_name' => 'required|string',
            'uom' => 'required|string',
            'sap_qty' => 'nullable|integer',
            'ac_qty' => 'nullable|integer',
            'rec_qty' => 'nullable|integer',
            'variance_qty' => 'nullable|integer',
            'description' => 'nullable',
        ];

        $validatedData = $request->validate($rules);

        Product::create($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'sloc_code' => 'required|string',
            'material_code' => 'required|string',
            'sloc_name' => 'required|string',
            'uom' => 'required|string',
            'sap_qty' => 'nullable|integer',
            'ac_qty' => 'nullable|integer',
            'rec_qty' => 'nullable|integer',
            'variance_qty' => 'nullable|integer',
            'description' => 'nullable',
        ];

        $validatedData = $request->validate($rules);

        Product::where('id', $product->id)->update($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return Redirect::route('products.index')->with('success', 'Product has been deleted!');
    }
}
