<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{
    public function __construct()
    {
//        parent::__construct();
        $this->middleware('client.credential')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        
        $categores = $transaction->prodect->categories;

        return $this->showAll($categores);

    }
}
