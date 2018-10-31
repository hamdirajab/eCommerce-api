<?php

namespace App\Http\Controllers\Prodect;

use App\Prodect;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProdectTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prodect $prodect)
    {
        $transactions = $prodect->transactions;


        return $this->showAll($transactions);

    }
}
