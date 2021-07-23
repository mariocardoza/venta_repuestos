<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use Storage;

class PurchaseController extends Controller
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
    public function create()
    {
        return view('purchases.create');
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
            'supplier' => 'required|max:200',
            'date' => 'required',
            //'bill_number' => 'required',
        ]);
        $purchase = new Purchase();
        $purchase->supplier = $request->supplier;
        $purchase->date = invertir_fecha($request->date);
        $purchase->bill_number = $request->bill_number;
        $purchase->total = $request->total;
        $purchase->save();
        return redirect()->route('purchases.edit',$purchase->id)->with('success','Compra registrada satisfactoriamente');
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
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        return view('purchases.edit',compact('purchase'));
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
            'supplier' => 'required|max:200',
            'total' => 'required|numeric|min:0.00',
        ]);
        $purchase = Purchase::find($id);
        $purchase->supplier = $request->supplier;
        $purchase->bill_number = $request->bill_number;
        $purchase->total = $request->total;
        $purchase->save();
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
        //
    }
}
