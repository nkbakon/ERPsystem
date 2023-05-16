<?php

namespace App\Http\Livewire\Reports\Forms;

use Livewire\Component;

class Selectdate extends Component
{
    public $start_date;
    public $end_date;
    public $selected_date1;
    public $selected_date2;

    public function select()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);
        $this->selected_date1 = $this->start_date;
        $this->selected_date2 = $this->end_date;
        session([
            'selected_date1' => $this->selected_date1,
            'selected_date2' => $this->selected_date2,
        ]);

        return redirect()->route('reports.index');
    }

    public function mount()
    {
        $this->selected_date1 = session('selected_date1');
        $this->selected_date2 = session('selected_date2');
    }

    public function render()
    {    
        return view('reports.components.selectdate');
    }
}
