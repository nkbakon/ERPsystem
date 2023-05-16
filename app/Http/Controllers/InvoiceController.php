<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Item;

class InvoiceController extends Controller
{
    public function index()
    {        
        return view('invoices.index');
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    public function destroy(Request $request)
    {
        $invoice = Invoice::find($request->data_id);
        if($invoice)
        {
            $item_ids = json_decode($invoice->item_ids);
            foreach($item_ids as $index => $item_id){
                $item = Item::find($item_id);
    
                if($item){
                    $quantities = json_decode($invoice->quantities);
                    foreach($quantities as $quantity_index => $quantity) {
                        if ($index == $quantity_index) {
                            $item->update([
                                'quantity' => $item->quantity + $quantity,
                            ]);                     
                        }
                    }
                }
            }
            
            $invoice->delete();
            return redirect()->route('invoices.index')->with('delete', 'Invoice deleted successfully.');
        }
        else
        {
            return redirect()->route('invoices.index')->with('delete', 'No Invoice found!.');
        }
    }
}
