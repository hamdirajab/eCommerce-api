<?php

namespace App;

use App\Buyer;
use App\Prodect;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionTransformer::class;
    protected $dates = ["deleted_at"];

    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'prodect_id',
    ];

    // relation
    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    public function prodect()
    {
    	return $this->belongsTo(Prodect::class);
    }

}
