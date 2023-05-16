<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {        
        return view('items.index');
    }

    public function create()
    {
        return view('items.create');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function destroy(Request $request)
    {
        $item = Item::find($request->data_id);
        if($item)
        {
            $item->delete();
            return redirect()->route('items.index')->with('delete', 'Item deleted successfully.');
        }
        else
        {
            return redirect()->route('items.index')->with('delete', 'No Item found!.');
        }
    }
}
