<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['transaction_id', 'person_id', 'item_id', 'quantity', 'price'];
    
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function item()
    {
        return $this->belongsTo('App\item');
    }
}
