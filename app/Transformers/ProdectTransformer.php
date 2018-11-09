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
        ];
    }
}
