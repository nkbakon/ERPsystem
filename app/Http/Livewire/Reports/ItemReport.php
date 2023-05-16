<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemReport extends Component
{
    public $selected_date1;
    public $selected_date2;
    public $totalQuantities = [];

    public function render()
    {
        $startDate = Carbon::parse($this->selected_date1)->format('Y-m-d');
        $endDate = Carbon::parse($this->selected_date2)->format('Y-m-d');

        $invoices = Invoice::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();

        $items = Item::all();
        foreach($items as $item_index => $item){
            foreach($invoices as $invoice){
                $item_ids = json_decode($invoice->item_ids);
                foreach($item_ids as $index => $item_id){
                    if($item->id == $item_id){
                        $quantities = json_decode($invoice->quantities);
                        if (!isset($this->totalQuantities[$item_index])) {
                            $this->totalQuantities[$item_index] = 0;
                        }
                        $this->totalQuantities[$item_index] += $quantities[$index];
                    }
                }                
            }            
        }

        
        return view('reports.components.item-report', [
            'items' => $items,
            'totalQuantities' => $this->totalQuantities,
        ]);
    }
}
