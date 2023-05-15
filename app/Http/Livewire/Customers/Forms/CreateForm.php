<?php

namespace App\Http\Livewire\Customers\Forms;

use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use Illuminate\Support\Facades\Auth;

class CreateForm extends Component
{
    public $district;
    public $fname;
    public $lname;
    public $contact;
    public $title;

    public function mount()
    {
        $this->district = '';
        $this->title = '';
    }

    protected $rules = [
        'title' => 'required',
        'fname' => 'required',
        'lname' => 'required',
        'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:customers,contact',
        'district' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {   
        $data['title'] = $this->title;
        $data['fname'] = $this->fname;
        $data['lname'] = $this->lname;
        $data['contact'] = $this->contact;
        $data['district_id'] = $this->district;
        $data['add_by'] = Auth::user()->id;

        $customer = Customer::create($data);
        if($customer){
            return redirect()->route('customers.index')->with('status', 'Customer added successfully.');  
        }
        return redirect()->route('customers.index')->with('delete', 'Customer registration faild, try again.');       
        
    }    

    public function render()
    {
        $districts = District::all();
        return view('customers.components.create-form', compact('districts'));
    }

}
