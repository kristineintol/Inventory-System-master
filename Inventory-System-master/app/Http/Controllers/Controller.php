<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Requisition;
use App\Models\Product;
use App\Models\User;
use App\Models\Technician;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function report(Request $request)
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
        // })->get();

        if(auth()->user()->is_admin){
            $requisitions = Requisition::where('status', 1)->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('product_id', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('quantity', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%');
                }
            })->paginate($row);
            // })->get();
        }

        foreach ($requisitions as $key => $requisition) {
            $product = Product::find($requisition->product_id);
            $technician = Technician::find($requisition->technician_id);
            $customer = User::find($requisition->user_id);
            $requisition->product = $product;
            $requisition->customer = $customer;
            $requisition->technician = $technician;
        }

        return view('purchases.purchases', compact('requisitions'));
    }
}
