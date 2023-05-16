<?php

namespace App\Http\Livewire\Items\Forms;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class EditForm extends Component
{
    public $item;
    public $categories;
    public $subcategories;
    public $category;
    public $subcategory;
    public $code;
    public $name;
    public $quantity;
    public $price;

    public function mount($item)
    {
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
        $this->item = $item;
        $this->category = $this->item->category_id;
        $this->subcategory = $this->item->subcategory_id;
    }

    public function rules()
    {
        return [                     
            'item.code' => 'required|unique:items,code,' . $this->item->id,
            'item.name' => 'required',   
            'category' => 'required',
            'subcategory' => 'required',
            'item.quantity' => 'required',
            'item.price' => 'required',
        ];
    }    

    public function update()
    {
        $validatedData = $this->validate($this->rules());
        $validatedData['edit_by'] = Auth::user()->id;
        $data['code'] = $validatedData['item']['code'];
        $data['name'] = $validatedData['item']['name'];
        $data['category_id'] = $validatedData['category'];
        $data['subcategory_id'] = $validatedData['subcategory'];
        $data['quantity'] = $validatedData['item']['quantity'];
        $data['price'] = $validatedData['item']['price'];
        $data['edit_by'] = $validatedData['edit_by'];

        $this->item->update($data);        
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function render()
    {
        return view('items.components.edit-form');
    }
}
