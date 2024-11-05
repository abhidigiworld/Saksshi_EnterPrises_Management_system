<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YourController extends Controller
{
    public function newBill(){
        return redirect()->route('newbill');
    }
}
