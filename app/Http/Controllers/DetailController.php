<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class DetailController extends Controller
{
    public function index()
    {
        $districts = District::paginate(5);         
        return view('details.index', ['districts' => $districts]);
    }

    public function store(Request $request)
    {
        District::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('details.index')->with('status', 'New district added successfully.');
    }

    public function districtUpdate(Request $request)
    {
        $district = District::find($request->id);
        $district->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('details.index')->with('success', 'District edited successfully.');
    }

    public function districtDestroy(Request $request)
    {
        $district = District::find($request->id);
        if($district)
        {
            $district->delete();
            return redirect()->route('details.index')->with('delete', 'District deleted successfully.');
        }
        else
        {
            return redirect()->route('details.index')->with('delete', 'No district found!.');
        }
    }
}
