<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identifier'   => (int) $transaction->id,
            'quantity'     => (int) $transaction->quantity,
            'buyer'     => (int) $transaction->buyer_id,
            'prodect'   => (int) $transaction->prodect_id,
            'creationDate' => (string) $transaction->created_at,
            'lastChange'   => (string) $transaction->updated_at,
            'deletedDate'  => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,
            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('transactions.show' , $transaction->id),
                ],
                [
                    'rel'  => 'transaction.categorys',
                    'href' => route('transactions.categorys.index' , $transaction->id),
                ],
                [
                    'rel'  => 'transaction.seller',
                    'href' => route('transactions.sellers.index' , $transaction->id),
                ],
                [
                    'rel'  => 'buyer',
                    'href' => route('buyers.show' , $transaction->buyer_id),
                ],
                [
                    'rel'  => 'prodect',
                    'href' => route('prodects.show' , $transaction->prodect_id),
                ]
            ]
        ];
    }
    public static function originalAttribute($index)
    {
        $attribute =  [
            'identifier'   => 'id',
            'quantity'     => 'quantity',
            'buyer'        => 'buyer_id',
            'prodect'      => 'prodect_id',
            'creationDate' => 'created_at',
            'lastChange'   => 'updated_at',
            'deletedDate'  => 'deleted_at',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }

    public static function transformerAttribute($index)
    {
        $attribute =  [
            'id'         => 'identifier',
            'quantity'   => 'quantity',
            'buyer_id'   => 'buyer',
            'prodect_id' => 'prodect',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }
}
