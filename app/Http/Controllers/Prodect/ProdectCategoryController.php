<?php

namespace App\Http\Controllers\Prodect;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Prodect;
use Illuminate\Http\Request;

class ProdectCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prodect $prodect)
    {
        $categorys = $prodect->categories;

        return $this->showAll($categorys);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prodect  $prodect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodect $prodect , Category $category)
    {
        // attach , sync , syncWithoutDetaching
        $prodect->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($prodect->categories);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prodect  $prodect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodect $prodect , Category $category)
    {
        if (!$prodect->categories()->find($category->id)) {
            
                return $this->errorResponse('The specific category is not a category of this prodect' , 404);
        }

        $prodect->categories()->detach($category->id);

        return $this->showAll($prodect->categories);

    }
}
