<?php

namespace App;

use App\Prodect;
use App\Transformers\SellerTransformer;
use App\User;
use App\scopes\SellerScope;

class Seller extends User
{
	 public $transformer = SellerTransformer::class;
	public static function boot()
 	{
 		parent::boot();

 		static::addGlobalScope(new SellerScope);
 	}

    // relation
    public function prodects()
    {
    	return $this->hasMany(Prodect::class);
    }
}
