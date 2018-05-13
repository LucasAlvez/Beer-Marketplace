<?php

/**
*
*  @author: Lucas Alves
*
*/

namespace App\Http\Controllers;

use App\Nationality;
use App\Vendor;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this-> validate($request, [
        'image'           =>  'required',
        'maker'           =>  'required',
        'name'            =>  'required',
        'ml'              =>  'required',
        'price'           =>  'required',
        'ibu'             =>  'required',
        'abv'             =>  'required',
        'category'        =>  'required',
        'nationality'     =>  'required',
        'ingredients'     =>  'required',
        'stock'           =>  'required',
        'desc'            =>  'required',
      ]);


    if($request->hasFile('image')){
        $imgname = $request->file('image')->getClientOriginalName();
        $img = $request->file('image')->storeAs('public/ProductImage', $imgname);


      $product = new Product([
        'id_vendor'       =>   1, //pegar o user logado
        'maker'           =>   $request->get('maker'),
        'name'            =>   $request->get('name'),
        'price'           =>   $request->get('price'),
        'id_category'     =>   $request->get('category'),
        'ml'              =>   $request->get('ml'),
        'IBU'             =>   $request->get('ibu'),
        'ABV'             =>   $request->get('abv'),
        'id_nationality'  =>   $request->get('nationality'),
        'stock'           =>   $request->get('stock'),
        'ingredients'     =>   $request->get('ingredients'),
        'introduction'    =>   $request->get('introduction'),
        'descr'           =>   $request->get('desc'),
        'img'             =>   $imgname
      ]);

      $product->save();

      \Session::flash('msg_sucess', 'Produto cadastrado com sucesso!');

      return Redirect::to('register-products');


   }



  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $product = Product::findOrFail($id);

        $vendor = Vendor::find($product->id_vendor);
        $category = Category::find($product->id_category);
        $nationality = Nationality::find($product->id_nationality);


        return view('product-page',['product' => $product, 'vendor' => $vendor,
         'category' => $category, 'nationality' => $nationality]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
