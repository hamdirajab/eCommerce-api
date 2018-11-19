<?php

namespace App\Transformers;

use App\Prodect;
use League\Fractal\TransformerAbstract;

class ProdectTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Prodect $prodect)
    {
        return [
            'identifier'   => (int) $prodect->id,
            'title'        => (string) $prodect->name,
            'details'      => (string) $prodect->description,
            'stock'        => (int) $prodect->quantity,
            'situation'    => (string) $prodect->status,
            'picture'      => url("img/{$prodect->image}"),
            'seller'       => (int) $prodect->seller_id,
            'creationDate' => (string) $prodect->created_at,
            'lastChange'   => (string) $prodect->updated_at,
            'deletedDate'  => isset($prodect->deleted_at) ? (string) $prodect->deleted_at : null,
            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('prodects.show' , $prodect->id),
                ],
                [
                    'rel'  => 'prodect.buyers',
                    'href' => route('prodects.buyers.index' , $prodect->id),
                ],
                [
                    'rel'  => 'prodect.categorys',
                    'href' => route('prodects.categorys.index' , $prodect->id),
                ],
                [
                    'rel'  => 'prodect.transactions',
                    'href' => route('prodects.transactions.index' , $prodect->id),
                ],
                [
                    'rel'  => 'seller',
                    'href' => route('sellers.show' , $prodect->seller_id),
                ],
            ]
        ];
    }
    public static function originalAttribute($index)
    {
        $attribute =  [
            'identifier'   => 'id',
            'title'        => 'name',
            'details'      => 'description',
            'stock'        => 'quantity',
            'situation'    => 'status',
            'picture'      => 'image',
            'seller'       => 'seller_id',
            'creationDate' => 'created_at',
            'lastChange'   => 'updated_at',
            'deletedDate'  => 'deleted_at',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }
}
