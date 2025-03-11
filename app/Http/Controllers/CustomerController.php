<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\City;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;

class CustomerController extends Controller
{
    // Function untuk menampilkan halaman utama dengan data pelanggan
    public function index(Request $request)
    {
        $query = Customer::with('city'); // Relasi dengan tabel `cities`
        
        // Menambahkan pencarian
        if ($request->search) {
            $query = $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Paging data pelanggan
        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    // Function untuk menampilkan form tambah data
    public function create()
    {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    // Function untuk menyimpan data pelanggan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'address' => 'required',
            'city_id' => 'required',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    // Function untuk menampilkan data pelanggan untuk diedit
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities = City::all();
        return view('customers.edit', compact('customer', 'cities'));
    }

    // Function untuk memperbarui data pelanggan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'address' => 'required',
            'city_id' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    // Function untuk menghapus pelanggan
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    // Function untuk mengekspor data pelanggan ke file Excel
    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
