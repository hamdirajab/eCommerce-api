<?php

namespace App;

use App\Category;
use App\Seller;
use App\Transaction;
use App\Transformers\ProdectTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodect extends Model
{
    use SoftDeletes;

	const AVAILABLE_PRODECT = 'available';
	const UNAVAILABLE_PRODECT = 'unavailable';

    public $transformer = ProdectTransformer::class;
    protected $dates = ["deleted_at"];
    protected $fillable = [

    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id',
    ];

    protected $hidden = [
        'pivot'
    ];


    public function isAvailable()
    {
    	return $this->status == Prodect::AVAILABLE_PRODECT;
    }


    // relation
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
