<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $this->validateProduct($request);

        $infoProduct = [
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'value'       => $request->input('value')
        ];
        
        $product = Product::create($infoProduct);

        return response()->json([
            "message"=>'Ok',
            "id_product"=>$product->id
        ]);        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validateProduct($request);
        $product->update($request->all());

        return new ProductResource($product);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            "message"=>'Ok'
        ]);
    }


    function validateProduct(Request $request){

        return $request->validate([
            'description' => 'required',
            'value' => 'required|numeric|gt:0',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);

    }

}
