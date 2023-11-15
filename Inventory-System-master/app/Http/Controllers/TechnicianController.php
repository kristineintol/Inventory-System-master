<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician;

class TechnicianController extends Controller
{
    public function index(Request $request)
    {
        $row = $request->input('row', 10);
        $search = $request->input('search', '');

        $technicians = Technician::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where('fname', 'like', '%' . $search . '%')
                    ->orWhere('mname', 'like', '%' . $search . '%')
                    ->orWhere('lname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            }
        })->paginate($row);

        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('technicians.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'nullable',
            'email' => 'required|email|unique:technicians',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Technician::create($validatedData);

        return redirect()->route('technicians.index')->with('success', 'Technician created successfully.');
    }

    public function show(Technician $technician)
    {
        return view('technicians.show', compact('technician'));
    }

    public function edit(Technician $technician)
    {
        return view('technicians.edit', compact('technician'));
    }

    public function update(Request $request, Technician $technician)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'nullable',
            'email' => 'required|unique:technicians,email,' . $technician->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $technician->update($validatedData);

        return redirect()->route('technicians.index')->with('success', 'Technician updated successfully.');
    }

    public function destroy(Technician $technician)
    {
        $technician->delete();

        return redirect()->route('technicians.index')->with('success', 'Technician deleted successfully.');
    }
}
