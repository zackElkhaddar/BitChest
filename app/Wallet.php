<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'currency_id',
    ];

    public function user(){

        return $this->hasMany('App\User');

    }
    
    public function currency(){

        return $this->hasOne('App\Currency');

    }

}
