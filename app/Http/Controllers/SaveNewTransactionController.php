<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction;
use App\Person;
use App\Item;
use App\Order;
use Session;

class SaveNewTransactionController extends Controller
{
   public function update(Request $request)    
    {
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = Session::get('persons');
        $items = Session::get('items');
        $totalServiceCharge = Session::get('svcCharge');

        echo ($store . "<br>");
        echo ($date . "<br>");
        print_r($persons);
        echo ("<br>");
        print_r($items);
        echo ("<br>");
        echo ($totalServiceCharge . "<br>");


        $dbTransaction = Transaction::create(array('user_id' => $request->user()->id,
                                                   'date' => $date,
                                                   'store' => $store));
        $dbServiceCharge = Item::create(array('transaction_id' => $dbTransaction->id,
                                              'name' => 'SvcCharge',
                                              'price' => $totalServiceCharge));
        foreach ($persons as $person)
        {
            $dbPerson = Person::create(array('transaction_id' => $dbTransaction->id,
                                             'name' => $person));
            $svcCharge = $request->input($person . 'SvcCharge' . 'UnitPrice');
            Order::create(array('transaction_id' => $dbTransaction->id,
                                'person_id' => $dbPerson->id,
                                'item_id' => $dbServiceCharge->id,
                                'quantity' => 1,    
                                'price' => $svcCharge));
        }

        foreach ($items as $key=>$item)
        {
            $dbItem = Item::create(array('transaction_id' => $dbTransaction->id,
                                         'name' => $key,
                                         'price' => $item['itemPrice']));

            foreach ($item['buyers'] as $buyer)
            {
                $dbPerson = Person::where('transaction_id', '=', $dbTransaction->id)
                                  ->where('name', '=', $buyer['name'])
                                  ->first();
                echo ("transaction_id: " . $dbTransaction->id . "<br>");
                echo ("person_name: " . $buyer['name'] . "<br>");
                echo ("person_id: " . $dbPerson->id . "<br>");
                echo ("item_id: " . $dbItem->id . "<br>");
                $unitPrice = $request->input($buyer['name'] . $key . 'UnitPrice');
                Order::create(array('transaction_id' => $dbTransaction->id,
                                    'person_id' => $dbPerson->id,
                                    'item_id' => $dbItem->id,
                                    'quantity' => $buyer['qty'],
                                    'price' => $unitPrice));
            }
        }

        if ($request->__get('next'))
        {
            echo "Next";
            //return redirect()->route('home');
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
