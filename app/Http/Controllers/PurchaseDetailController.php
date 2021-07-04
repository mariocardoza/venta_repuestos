<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseDetail;
use App\ProductDetail;
use App\Product;
use Storage;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchases.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $purchase=Purchase::find($request->purchase_id);
        $products = Product::all();
        return view('purchases.detail.create',compact('purchase','products'));
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
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric',
        ]);
        $purchase = new PurchaseDetail();
        $purchase->product_id = $request->product_id;
        $purchase->quantity = $request->quantity;
        $purchase->purchase_id = $request->purchase_id;
        $purchase->price = $request->price;
        $purchase->save();
        $purchase->purchase->total = $purchase->purchase->total+($request->price*$request->quantity);
        $purchase->purchase->save();
        $this->update_inventory($request);
        return redirect()->route('purchases.edit',$purchase->purchase_id)->with('success','Ítem registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::findorFail($id);

        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $purchase_detail = PurchaseDetail::find($id);
        $purchase = Purchase::find($request->purchase_id);
        $products = Product::all();
        return view('purchases.detail.edit',compact('purchase_detail','purchase','products'));
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
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric',
        ]);
        $detail = PurchaseDetail::find($id);
        $total = $detail->price*$detail->quantity;
        $inventory = ProductDetail::where('purchase_id',$detail->purchase_id)->where('product_id',$detail->product_id)->delete();
        $detail->product_id = $request->product_id;
        $detail->price = $request->price;
        $detail->quantity = $request->quantity;
        $detail->purchase->total = $detail->purchase->total - $total;
        $detail->purchase->save();
        $newTotal = $request->price*$request->quantity;
        $detail->purchase->total = $detail->purchase->total + $newTotal;
        $detail->purchase->save();
        $detail->save();
        $this->update_inventory($request);
        return redirect()->route('purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = PurchaseDetail::find($id);
        $purchase_id = $detail->purchase_id;
        $inventory = ProductDetail::where('purchase_id',$detail->purchase_id)->where('product_id',$detail->product_id)->delete();
        $total = $detail->price*$detail->quantity;
        $detail->purchase->total = $detail->purchase->total - $total;
        $detail->purchase->save();
        $detail->delete();
        return redirect()->route('purchases.edit',$purchase_id)->with('success','Ítem eliminado satisfactoriamente');
    }

    private function update_inventory(Request $request){
        $product = Product::find($request->product_id);
        $cuantos = $request->quantity;
        for($i=0;$i<$cuantos;$i++){
            $product_detail = new ProductDetail();
            $product_detail->product_id = $product->id;
            $product_detail->table = 'Product';
            $product_detail->purchase_id = $request->purchase_id;
            $product_detail->type =1;
            $product_detail->code =Product::retornar_code($product->id,$product->code);
            $product_detail->save();
        }
    }
}
