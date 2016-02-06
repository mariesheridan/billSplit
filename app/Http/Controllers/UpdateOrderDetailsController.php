<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdateOrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $prices = array();
        $index = 0;
        $items = Session::get('items');

        if ($request->__get('next'))
        {
            echo "Next";
//            return redirect()->route('summary');
        }
        else if ($request->__get('back'))
        {
            echo "Back";
            return redirect()->route('create_items');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }
}
