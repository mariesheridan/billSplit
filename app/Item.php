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

    public function scopeSvcCharge($query)
    {
        return $query->where('name', 'svcCharge');
    }

    public function scopeForTransaction($query, $id)
    {
        return $query->where('transaction_id', $id);
    }

    public function scopeExcludeSvcCharge($query)
    {
        return $query->where('name', '!=', 'svcCharge');
    }
}
