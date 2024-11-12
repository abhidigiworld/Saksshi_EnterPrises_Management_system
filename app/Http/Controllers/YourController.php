<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YourController extends Controller
{
    public function newBill(){
        return redirect()->route('newbill');
    }

    public function existingBills()
    {
        $invoices = DB::select('select * from invoices');

        return view('index', compact('invoices'));
    }
}
