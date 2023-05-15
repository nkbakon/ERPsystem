<?php

namespace App\Http\Livewire\Customers\Forms;

use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class EditForm extends Component
{
    public $customer;
    public $districts;
    public $district;
    public $title;
    public $fname;
    public $lname;
    public $contact;

    public function mount($customer)
    {
        $this->districts = District::all();
        $this->customer = $customer;
        $this->district = $this->customer->district_id;
    }

    public function rules()
    {
        return [
            'customer.title' => 'required',
            'customer.fname' => 'required',
            'customer.lname' => 'required',
            'customer.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:customers,contact,' . $this->customer->id,
            'district' => 'required',
        ];
    }    

    public function update()
    {
        $validatedData = $this->validate($this->rules());
        $validatedData['edit_by'] = Auth::user()->id;
        $data['title'] = $validatedData['customer']['title'];
        $data['fname'] = $validatedData['customer']['fname'];
        $data['lname'] = $validatedData['customer']['lname'];
        $data['contact'] = $validatedData['customer']['contact'];
        $data['district_id'] = $validatedData['district'];
        $data['edit_by'] = $validatedData['edit_by'];

        $this->customer->update($data);        
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function render()
    {
        return view('customers.components.edit-form');
    }
}

