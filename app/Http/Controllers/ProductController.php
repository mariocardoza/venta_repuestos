<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:200',
          'image' => 'nullable|image|max:2048',
        ]);
        $product = new Product();
        $product->name = $request->name;
        if($request->code != "")
        {
            $this->validate($request,['code'=>'unique:products']);
        }
        $product->code = $request->code;
        $product->price = $request->price;
        $product->category_id = 1;
        if($request->has('image')){
            $product->image = $this->uploadImage($request);
        }
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'name' => 'required|max:200',
          'image' => 'nullable|image|max:2048',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        if($request->code != "")
        {
            $this->validate($request,['code'=>'unique:products']);
        }
        $product->code = $request->code;
        $product->price = $request->price;
        $product->category_id = 1;
        if($request->has('image')){
            $product->image = $this->uploadImage($request);
        }
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return array(1,"exito",$product);
    }

    private function uploadImage($request){
        $imageSize = getimagesize($request->image);
        $avatarExtension = image_type_to_extension($imageSize[2]);
        $filename = Storage::putFile('images/products', $request->image, 'public');
        return $filename;
    }

}
