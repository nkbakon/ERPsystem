<?php

namespace App\Http\Livewire\Invoices\Forms;

use Livewire\Component;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class EditForm extends Component
{
    public $invoice;
    public $all_items;
    public $rows = [''];
    public $index;
    public $quantity;
    public $item;
    public $customers;
    public $totalquantity;
    public $total;
    public $showtotal;

    public function rules()
    {
        return [
            'invoice.customer_id' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required',
        ];
    }

    public function mount($invoice)
    {
        $this->all_items = Item::all();
        $this->invoice = $invoice;
        $quantities = json_decode($invoice->quantities);
        foreach($quantities as $quantity) {
            $this->quantity[] = $quantity;
        }
        $item_ids = json_decode($invoice->item_ids);
        foreach($item_ids as $item_id) {
            $this->item[] = $item_id;
        }
        foreach($item_ids as $index => $item_id) {
            $this->rows[$index] = '';
        }
        $this->customers = Customer::all();
        $this->customer = '';
        $this->calculateTotal();
    }

    public function updatedItem()
    {
        $this->calculateTotal();
    }

    public function updatedQuantity()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $total = 0;
        $totalquantity = 0;
        if ($this->item && $this->quantity) {
            foreach ($this->item as $index => $item) {
                $item_ids = json_decode($this->invoice->item_ids);
                foreach($item_ids as $itemindex => $item_id){
                    if ($item == $item_id && isset($this->quantity[$index])) {                    
                        $quantity = $this->quantity[$index];
                        $prices = json_decode($this->invoice->prices);
                        $unittotal = floatval($prices[$itemindex]) * floatval($quantity);
                        $total += intval($unittotal);
                        $totalquantity += intval($quantity);
                    }
                }              
            }
        }
        $this->showtotal = number_format($total, 2);
        $this->total = $total;
        $this->totalquantity = $totalquantity;
    }

    public function update()
    {
        $this->resetErrorBag('quantity');
        $validatedData = $this->validate($this->rules());
        $validatedData['edit_by'] = Auth::user()->id;
        $totalquantity = $this->invoice->totalquantity;

        $data['customer_id'] = $validatedData['invoice']['customer_id'];
        $data['item_ids'] = json_encode($validatedData['item']);
        $data['quantities'] = json_encode($validatedData['quantity']);
        $data['totalquantity'] = array_sum($validatedData['quantity']);
        $data['total'] = $this->total;
        $data['edit_by'] = $validatedData['edit_by'];     
        
        $allItemsHaveEnoughQuantity = true;
        $tempquantity = [];

        foreach ($this->item as $index => $item_id) {
            $quantity = $this->quantity[$index];
            $oldquantities = json_decode($this->invoice->quantities);
            $oldquantity = $oldquantities[$index];
            $qtychange = $quantity - $oldquantity;
            $tempquantity[$item_id] = isset($tempquantity[$item_id]) ? $tempquantity[$item_id] + $qtychange : $qtychange;
        }

        $invoice = Invoice::find($this->invoice->id);
        if ($invoice){
            $item_ids = json_decode($invoice->item_ids);                        
            if ($item_ids){
                foreach($item_ids as $index => $item_id){
                    $item = Item::find($item_id);                    
                    foreach($this->item as $item_index => $itemid){                                                
                        if($item_id == $itemid){ 
                            $quantity = $this->quantity[$item_index];
                            $oldquantities = json_decode($this->invoice->quantities);
                            $oldquantity = $oldquantities[$item_index];
                            $qtychange = $quantity - $oldquantity;
                            if ($item->quantity < $qtychange || $item->quantity < $tempquantity[$item_id]) {
                                $this->addError("quantity", "Not enough quantity for item: {$item->code} - {$item->name} - {$item->category->name} - {$item->subcategory->name} (Available $item->quantity only).");
                                $allItemsHaveEnoughQuantity = false; // set the flag variable to false
                                break;
                            }
                        } 
                    }
                           
                }
            }           
        }

        if ($allItemsHaveEnoughQuantity) {
            // update the quantity for all items
            foreach($validatedData['item'] as $index => $item_id){
                $item = Item::find($item_id);
    
                if($item){
                    foreach($validatedData['quantity'] as $quantity_index => $quantity){
                        $quantities = json_decode($this->invoice->quantities);
                        foreach($quantities as $currentquantity_index => $currentquantity) {
                            if ($quantity_index === $currentquantity_index){
                                $difference = $quantity - $currentquantity;
                                if ($index == $quantity_index) {
                                    $item->update([
                                        'quantity' => $item->quantity - $difference,
                                    ]);           
                                }
                            }
                        }
                    }
                }
            }    
    
            $this->invoice->update($data);
            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
        } else {
            return back()->withInput()->withErrors(['error' => 'Not enough quantity for one or more item.']);
        }
    }

    public function render()
    {
        return view('invoices.components.edit-form');
    }
}
