<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceReport extends Component
{
    public $selected_date1;
    public $selected_date2;

    public function render()
    {
        $startDate = Carbon::parse($this->selected_date1)->format('Y-m-d');
        $endDate = Carbon::parse($this->selected_date2)->format('Y-m-d');

        $invoices = Invoice::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();

        return view('reports.components.invoice-report', [
            'invoices' => $invoices,
        ]);
    }
}
