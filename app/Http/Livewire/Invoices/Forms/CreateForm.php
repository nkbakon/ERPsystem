<?php

namespace App\Http\Livewire\Invoices\Forms;

use Livewire\Component;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CreateForm extends Component
{
    public $index;
    public $rows = [''];
    public $items = [];
    public $all_items;
    public $quantities;
    public $salesrep_id;
    public $x = 0;
    public $total;
    public $totalqty;
    public $showtotal;
    public $customers;
    public $customer;
    public $prices = [];

    public function mount()
    {
        $this->all_items = Item::all();
        $this->items[$this->x] = '';
        $this->customers = Customer::all();
        $this->customer = '';
        $this->calculateTotal();
    }

    public function addRow()
    {
        $this->rows[] = '';
        $x = $this->x + 1;
        $this->items[$x] = '';
        $this->x = $x;
        $this->render();
    }

    public function removeRow($index)
    {
        if($index != 0)
        {
            unset($this->rows[$index]);
            $this->rows = array_values($this->rows);
            $index = $index - 1;
            $x = $this->x - 1;
            $this->x = $x;
            $this->quantities[$index+1] = '';
            $this->items[$index+1] = '';
            $this->calculateTotal();
            $this->render();
        }
    }

    public function updatedItems()
    {
        $this->calculateTotal();
    }

    public function updatedQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $total = 0;
        $subtotal = 0;
        $totalqty = 0;
        if ($this->items && $this->quantities) {
            foreach ($this->items as $index => $item_id) {
                $item = Item::find($item_id);
                if ($item && isset($this->quantities[$index])) {                    
                    $quantity = $this->quantities[$index];
                    $unittotal = floatval($item->price) * floatval($quantity);                    
                    $total += intval($unittotal);
                    $totalqty += intval($quantity);
                }              
            }
        }
        $this->showtotal = number_format($total, 2);
        $this->total = $total;
        $this->totalqty = $totalqty;
    }

    protected $rules = [
        'customer' => 'required',
        'items' => 'required|array',
        'items.*' => 'required',
        'quantities' => 'required|array',
        'quantities.*' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->resetErrorBag('quantities');
        foreach($this->items as $pricecheck){
            $itemprice = Item::find($pricecheck);
            if($itemprice){
                $prices[] = $itemprice->price;
            }
        }
        $data['prices'] = json_encode($prices);
        $data['customer_id'] = $this->customer;
        $data['item_ids'] = json_encode($this->items);
        $data['quantities'] = json_encode($this->quantities);
        $data['totalquantity'] = $this->totalqty;
        $data['total'] = $this->total;
        $data['add_by'] = Auth::user()->id;

        $itemQuantities  = [];
        
        $allItemsHaveEnoughQuantity = true;
        $tempquantity = [];

        foreach ($this->items as $index => $item_id) {
            $tempquantity[$item_id] = isset($tempquantity[$item_id]) ? $tempquantity[$item_id] + $this->quantities[$index] : $this->quantities[$index];
        }
        
        foreach($this->items as $index => $item_id){
            $item = Item::find($item_id);

            if($item){
                $quantity = $this->quantities[$index];                
                if ($item->quantity < $quantity || $item->quantity < $tempquantity[$item_id]) {
                    $this->addError("quantities", "Not enough quantity for item: {$item->code} - {$item->name} - {$item->category->name} - {$item->subcategory->name} (Available $item->quantity only).");
                    $allItemsHaveEnoughQuantity = false; // set the flag variable to false
                    break;
                }

                // add the item ID and quantity to the array
                $key = array_search($item_id, array_column($itemQuantities, 'id'));

                if ($key !== false) { // if the item ID exists, add the quantity to its existing value
                    $itemQuantities[$key]['quantity'] += $quantity;
                }
                else { // if the item ID does not exist, add it to the array with its quantity
                    $itemQuantities[] = [
                        'id' => $item_id,
                        'quantity' => $quantity,
                        'price' => $item->price,
                    ];
                }             
            }
        }

        if ($allItemsHaveEnoughQuantity) {
            // update the quantity for all items
            foreach($itemQuantities as $itemQuantity) {
                $item = Item::find($itemQuantity['id']);
        
                if($item){
                    $item->update([
                        'quantity' => $item->quantity - $itemQuantity['quantity'],
                    ]);                        
                }
            }
        
            // update the $data array with the unique item IDs and quantities
            $data['item_ids'] = json_encode(array_column($itemQuantities, 'id'));
            $data['quantities'] = json_encode(array_column($itemQuantities, 'quantity'));
            $data['prices'] = json_encode(array_column($itemQuantities, 'price'));
        
            $invoice = Invoice::create($data);
        }
   
    
        if($this->getErrorBag()->any()){
            return; // do not redirect if there are errors
        }

        

        if($invoice){
            return redirect()->route('invoices.index')->with('status', 'Invoice created successfully.');  
        }
        return redirect()->route('invoices.index')->with('delete', 'Invoice creating failed, try again.');       
        
    }

    public function render()
    {
        return view('invoices.components.create-form');
    }
}
