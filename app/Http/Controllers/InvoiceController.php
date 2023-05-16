<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

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
}
