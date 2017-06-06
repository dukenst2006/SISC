<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductInfo;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(15);

        return view('product/list')->withModel($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $product_id)
    {
        $product = Product::find($product_id);
        return view('product/edit')->with('product', collect($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProductInfo|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductInfo $request)
    {
        $id = (int) $request->input('id');
        $product = Product::find($id);
        if (!$product) {
            return back()->with('error', 'The product does not exist.');
        }

        $res = $product->update($request->all());
        if ($res) {
            return back()->with('success', 'The product has been updated.');
        } else {
            return back()->with('error', 'The product has not been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
