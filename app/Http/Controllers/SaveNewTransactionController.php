<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaveNewTransactionController extends Controller
{
   public function update(Request $request)    
    {
        if ($request->__get('next'))
        {
            echo "Next";
            return redirect()->route('home');
        }
        else if ($request->__get('back'))
        {
            echo "Back";
            return redirect()->route('order_details');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
