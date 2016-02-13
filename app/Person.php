<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['transaction_id', 'name'];

    protected $table = "persons";
    
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
