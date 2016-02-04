<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UpdateItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request)    
    {
        $items = array();
        foreach($request->all() as $key=>$item)
        {
            if(preg_match('/^item[\d]+/', $key))
            {
                array_push($items, $item);
            }
        }
        Session::forget('items');
        Session::set('items', $item);

        return redirect()->route('summary');
    }
}
