<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier'   => (int) $buyer->id,
            'name'         => (string) $buyer->name,
            'email'        => (string) $buyer->email,
            'isVerified'   => (int) $buyer->verified,
            'creationDate' => (string) $buyer->created_at,
            'lastChange'   => (string) $buyer->updated_at,
            'deletedDate'  => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,
            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('sellers.show' , $buyer->id),
                ],
                [
                    'rel'  => 'buyer.sellers',
                    'href' => route('buyers.sellers.index' , $buyer->id),
                ],
                [
                    'rel'  => 'buyer.categorys',
                    'href' => route('buyers.categorys.index' , $buyer->id),
                ],
                [
                    'rel'  => 'buyer.prodects',
                    'href' => route('buyers.prodects.index' , $buyer->id),
                ],
                [
                    'rel'  => 'buyer.transactions',
                    'href' => route('buyers.transactions.index' , $buyer->id),
                ],
                [
                    'rel'  => 'user',
                    'href' => route('users.show' , $buyer->id),
                ]
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attribute =  [
            'identifier'   => 'id',
            'name'         => 'name',
            'email'        => 'email',
            'isVerified'   => 'verified',
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
            'name'       => 'name',
            'email'      => 'email',
            'verified'   => 'isVerified',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;

    }
}
