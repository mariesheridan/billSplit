<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['user_id', 'name', 'email'];

    protected $table = "friends";
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeWithName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeWithEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
