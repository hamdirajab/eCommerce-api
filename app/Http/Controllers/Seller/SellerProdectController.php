<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Prodect;
use App\Seller;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Transformers\ProdectTransformer;

class SellerProdectController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.inputs:' . ProdectTransformer::class)->only(['store' , 'update']);
        $this->middleware('scope:manage-products')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        if (request()->user()->tokenCan('read-general') || request()->user()->tokenCan('manage-products')){

            $prodects = $seller->prodects;

            return $this->showAll($prodects);
        }

        throw new AuthorizationException("Invalid scope(s)");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , User $seller)
    {
        $rules = [

            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',

        ];

        $this->validate($request , $rules);

        $data = $request->all();

        $data['status'] = Prodect::UNAVAILABLE_PRODECT;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;

        $prodect = Prodect::create($data);

        return $this->showOne($prodect);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller , Prodect $prodect)
    {
        
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Prodect::AVAILABLE_PRODECT . ',' . Prodect::UNAVAILABLE_PRODECT,
            'image' => 'image',
        ];

        $this->validate($request , $rules);

        $this->checkSeller($seller,$prodect);

        $prodect->fill($request->only([

            'name',
            'description',
            'quantity',

        ]));

        if ($request->has('status')) {
            
            $prodect->status = $request->status;

            if ($prodect->isAvailable() && $prodect->categories()->count() == 0) {
                
                return $this->errorResponse('An active product must have at least one category' , 409);
                
            }

        }

        if ($request->has('image')) {
            
            Storage::delete($prodect->image);

            $prodect->image = $request->image->store('');

        }

        if ($prodect->isClean()) {
            
            return $this->errorResponse('You need to specify a different value to update' , 422);
        }

        $prodect->save();

        return $this->showOne($prodect);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller , Prodect $prodect)
    {
        
        $this->checkSeller($seller,$prodect);

        $prodect->delete();
        Storage::delete($prodect->image);

        return $this->showOne($prodect);

    }

    
    public function checkSeller(Seller $seller , Prodect $prodect)
    {
       if ($seller->id != $prodect->seller_id) {
           
           throw new HttpException(422, 'The specified seller is not the actual seller of the product');

       }
    }
}
