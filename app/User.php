<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function payables()
    {
        return $this->hasMany('App\Person');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend');
    }

    public function scopeWithEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeWithConfirmationCode($query, $confirmationCode)
    {
        return $query->where('confirmation_code', $confirmationCode);
    }
}
