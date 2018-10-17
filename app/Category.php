<?php

namespace App;

use App\Prodect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ["deleted_at"];

    protected $fillable = [
    	'name', 
    	'description',
    ];

    // relation
    public function prodects()
    {
    	$this->belongsToMany(Prodect::class);
    }

}
