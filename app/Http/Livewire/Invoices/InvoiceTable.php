<?php

namespace App\Http\Livewire\Invoices;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Invoice;

class InvoiceTable extends Component
{
    use WithPagination;

    public $perPage = 15;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = false;

    public function render()
    {
        $invoices = Invoice::search($this->search)
        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);

        return view('invoices.components.invoice-table', [
            'invoices' => $invoices
        ]);
    }
}
