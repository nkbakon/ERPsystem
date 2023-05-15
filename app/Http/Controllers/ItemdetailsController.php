<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class ItemdetailsController extends Controller
{
    public function index()
    {   $categories = Category::paginate(5); 
        $subcategories = Subcategory::paginate(5);    
        return view('itemdetails.index', ['categories' => $categories, 'subcategories' => $subcategories]);
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('itemdetails.index')->with('status', 'New category added successfully.');
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::find($request->id);
        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('itemdetails.index')->with('success', 'Category edited successfully.');
    }

    public function categoryDestroy(Request $request)
    {
        $category = Category::find($request->id);
        if($category)
        {
            $category->delete();
            return redirect()->route('itemdetails.index')->with('delete', 'Category deleted successfully.');
        }
        else
        {
            return redirect()->route('itemdetails.index')->with('delete', 'No category found!.');
        }
    }

    public function subcategory(Request $request)
    {
        Subcategory::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('itemdetails.index')->with('status', 'New sub-category created successfully.');
    }

    public function subcategoryUpdate(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        $subcategory->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('itemdetails.index')->with('success', 'Sub-Category edited successfully.');
    }

    public function subcategoryDestroy(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        if($subcategory)
        {
            $subcategory->delete();
            return redirect()->route('itemdetails.index')->with('delete', 'Sub-Category deleted successfully.');
        }
        else
        {
            return redirect()->route('itemdetails.index')->with('delete', 'No sub-category found!.');
        }
    }
}
