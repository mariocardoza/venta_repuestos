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
        //
    }

    private function uploadImage($request)
    {   
        $filename = null;
        if ($request->image !== null) {
            $imageSize = getimagesize($request->image);
            $avatarExtension = image_type_to_extension($imageSize[2]);
            $filename = Storage::putFile('public/products', $request->image, 'public');

            // We'll make it square
            /*$img = Image::make("storage/{$filename}");
            $width = $imageSize[0];
            $height = $imageSize[1];

            if ($width > $height) {
                $height = $width * 0.85;
            } else {
                $width = $height / 0.85;
            }
            $img->crop((int)$width, (int)$height);
            $img->save();*/
        } 
        return $filename;
    }

}
