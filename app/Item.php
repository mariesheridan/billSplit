<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['transaction_id', 'name', 'price'];
    
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
