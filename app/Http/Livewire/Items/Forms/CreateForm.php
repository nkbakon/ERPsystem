<?php

namespace App\Http\Livewire\Items\Forms;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class CreateForm extends Component
{
    public $code;
    public $name;
    public $category;
    public $subcategory;
    public $quantity;
    public $price;

    public function mount()
    {
        $this->category = '';
        $this->subcategory = '';
    }

    protected $rules = [
        'code' => 'required|unique:items,code',
        'name' => 'required',
        'category' => 'required',
        'subcategory' => 'required',
        'quantity' => 'required',
        'price' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {   
        $data['code'] = $this->code;
        $data['name'] = $this->name;
        $data['category_id'] = $this->category;
        $data['subcategory_id'] = $this->subcategory;
        $data['quantity'] = $this->quantity;
        $data['price'] = $this->price;
        $data['add_by'] = Auth::user()->id;

        $item = Item::create($data);
        if($item){
            return redirect()->route('items.index')->with('status', 'Item added successfully.');  
        }
        return redirect()->route('items.index')->with('delete', 'Item adding faild, try again.');       
        
    }    

    public function render()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('items.components.create-form', compact('categories', 'subcategories'));
    }

}
