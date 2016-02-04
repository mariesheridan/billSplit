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
}
