<?php

namespace App\Http\Controllers\Prodect;

use App\Prodect;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProdectController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prodects = Prodect::all();

        return $this->showAll($prodects);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prodect  $prodect
     * @return \Illuminate\Http\Response
     */
    public function show(Prodect $prodect)
    {
        return $this->showOne($prodect);
    }
}
