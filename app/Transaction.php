<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'date', 'store'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function persons()
    {
        return $this->hasMany('App\Person');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
