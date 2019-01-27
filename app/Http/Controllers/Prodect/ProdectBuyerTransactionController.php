<?php

namespace App\Http\Controllers\Prodect;

use App\Http\Controllers\ApiController;
use App\Prodect;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\ProdectTransformer;
use App\Transformers\TransactionTransformer;

class ProdectBuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.inputs:' . TransactionTransformer::class)->only(['store']);
        $this->middleware('scope:purchase-product')->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Prodect $prodect , User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1',
        ];

        $this->validate($request , $rules);


        if ($prodect->id == $prodect->seller_id) {
            
            return $this->errorResponse('The buyer must be different from seller' , 409);
        }

        if (!$buyer->isVerified()) {
            
            return $this->errorResponse('The buyer must be verified user' , 409);
        }

        if (!$prodect->seller->isVerified()) {
            
            return $this->errorResponse('The seller must be verified user' , 409);
        }

        if (!$prodect->isAvailable()) {
            
            return $this->errorResponse('The prodect is not Available to use' , 409);
        }
        
        if ($prodect->quantity < $request->quantity) {
            
            return $this->errorResponse('The prodect dose not have enougth units for this transaction' , 409);
        }


        return DB::transaction(function() use ($request , $prodect , $buyer){
            $prodect->quantity -= $request->quantity;
            $prodect->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'prodect_id' => $prodect->id,

            ]);

            return $this->showOne($transaction , 201);
        });


    }

}
