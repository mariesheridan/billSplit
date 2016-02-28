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
use App\MyLibrary\ItemBuilder;
use App\MyLibrary\TransactionDetails;
use App\MyLibrary\PersonListBuilder;

class SaveNewTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function update(Request $request)
    {
        if ($request->__get('next'))
        {
            $this->saveToDB($request);
            return redirect()->route('home');
        }
        else if ($request->__get('back'))
        {
            return redirect()->route('order_details');
        }
        else
        {
            echo "Ooops.. Please go back";
        }
    }

    private function saveToDB(Request $request)
    {
        $transactionId = Session::get('transactionId', 0);
        $store = Session::get('store');
        $date = Session::get('date');
        $persons = new PersonListBuilder;
        $persons->copyArrayWithEmail(Session::get('persons'));
        $items = ItemBuilder::copyArray(Session::get('items'));
        $totalServiceCharge = Session::get('svcCharge');
        $personsWithEmail = array();

        if ($transactionId == 0)
        {
            $dbTransaction = Transaction::create(array('user_id' => $request->user()->id,
                                                   'date' => $date,
                                                   'store' => $store));
        }
        else
        {
            // If transaction exists because this is just the edit page,
            //     we should delete the existing relations from db and create new ones.
            $dbTransaction = Transaction::find($transactionId);
            $transaction = new TransactionDetails($transactionId);
            $personsWithEmail = $transaction->getPersonsEmailList();
            foreach ($dbTransaction->orders as $order)
            {
                $order->delete();
            }
            foreach ($dbTransaction->persons as $person)
            {
                $person->delete();
            }
            foreach ($dbTransaction->items as $item)
            {
                $item->delete();
            }
        }

        $dbServiceCharge = Item::create(array('transaction_id' => $dbTransaction->id,
                                              'name' => 'SvcCharge',
                                              'price' => $totalServiceCharge));
        foreach ($persons->getEmailArray() as $key=>$person)
        {
            // Use email set from friends list if available, otherwise, use the one from Tag page
            $email = $person['email'];
            $status = $person['status'];

            if (array_key_exists($key, $personsWithEmail))
            {
                $status = $personsWithEmail[$key]['status'];

                // If email was not set using the friends list, then we will use the one from the tag page
                if ($email == "")
                {
                   $email = $personsWithEmail[$key]['email'];
                }
            }

            $dbPerson = Person::create(array('transaction_id' => $dbTransaction->id,
                                             'name' => $person['name'],
                                             'email' => $email,
                                             'status' => $status));
            // We need to check if service charge exists for a user or not
            $svChargeKey = $key . 'SvcCharge' . 'UnitPrice';
            if (array_key_exists($svChargeKey, $request->all()))
            {
                $svcCharge = $request->input($key . 'SvcCharge' . 'UnitPrice');
                Order::create(array('transaction_id' => $dbTransaction->id,
                                    'person_id' => $dbPerson->id,
                                    'item_id' => $dbServiceCharge->id,
                                    'quantity' => 1,
                                    'price' => $svcCharge));
            }
        }

        foreach ($items->getArray() as $key=>$item)
        {
            $dbItem = Item::create(array('transaction_id' => $dbTransaction->id,
                                         'name' => $item['itemName'],
                                         'price' => $item['itemPrice']));

            foreach ($item['buyers'] as $buyerKey=>$buyer)
            {
                $dbPerson = Person::where('transaction_id', '=', $dbTransaction->id)
                                  ->where('name', '=', $buyer['name'])
                                  ->first();
                $unitPrice = $request->input($buyerKey . $key . 'UnitPrice');
                Order::create(array('transaction_id' => $dbTransaction->id,
                                    'person_id' => $dbPerson->id,
                                    'item_id' => $dbItem->id,
                                    'quantity' => $buyer['qty'],
                                    'price' => $unitPrice));
            }
        }
    }
}
