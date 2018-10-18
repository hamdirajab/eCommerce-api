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

    protected $hidden = [
        'pivot'
    ];

    // relation
    public function prodects()
    {
    	return $this->belongsToMany(Prodect::class);
    }

}
