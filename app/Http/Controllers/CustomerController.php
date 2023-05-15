<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {        
        return view('customers.index');
    }

    public function create()
    {
        return view('customers.create');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function destroy(Request $request)
    {
        $customer = Customer::find($request->data_id);
        if($customer)
        {
            $customer->delete();
            return redirect()->route('customers.index')->with('delete', 'Customer deleted successfully.');
        }
        else
        {
            return redirect()->route('customers.index')->with('delete', 'No Customer found!.');
        }
    }
}
