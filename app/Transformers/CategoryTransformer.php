<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier'   => (int) $category->id,
            'title'         => (string) $category->name,
            'details'  => (string) $category->description,
            'creationDate' => (string) $category->created_at,
            'lastChange'   => (string) $category->updated_at,
            'deletedDate'  => isset($category->deleted_at) ? (string) $category->deleted_at : null,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('categorys.show' , $category->id),
                ],
                [
                    'rel'  => 'category.buyers',
                    'href' => route('categorys.buyers.index' , $category->id),
                ],
                [
                    'rel'  => 'category.prodects',
                    'href' => route('categorys.prodects.index' , $category->id),
                ],
                [
                    'rel'  => 'category.sellers',
                    'href' => route('categorys.sellers.index' , $category->id),
                ],
                [
                    'rel'  => 'category.transactions',
                    'href' => route('categorys.transactions.index' , $category->id),
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
            'creationDate' => 'created_at',
            'lastChange'   => 'updated_at',
            'deletedDate'  => 'deleted_at',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }

    public static function transformerAttribute($index)
    {
        $attribute =  [
            'id'          => 'identifier',
            'name'        => 'title',
            'description' => 'details',
            'created_at'  =>  'creationDate',
            'updated_at'  => 'lastChange',
            'deleted_at'  => 'deletedDate',
        ];

        return isset($attribute[$index]) ? $attribute[$index] : null ;
    }
}
