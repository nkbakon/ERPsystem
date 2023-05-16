<?php

namespace App\Http\Livewire\Items;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;

class ItemTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = false;

    public function render()
    {
        $items = Item::search($this->search)
        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);
        return view('items.components.item-table', [
            'items' => $items
        ]);
    }
}

