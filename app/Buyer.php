<?php

namespace App;

use App\Transaction;
use App\User;
use App\scopes\BuyerScope;

class Buyer extends User
{
 	
 	public static function boot()
 	{
 		parent::boot();

 		static::addGlobalScope(new BuyerScope);
 	}

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }

}
