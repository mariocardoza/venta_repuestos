<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Sale;
use App\Receipt;
use App\Product;
use App\ProductDetail;
use Storage;
use DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::whereState(1)->get();
        return view('sales.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $receipts = Receipt::all();
        $products = Product::all();
        return view('sales.create', compact('customers','receipts','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sale::find($request->sale_id);
        try{
            $sale->state = 1;
            foreach($sale->detail as $detail){
                $this->update_inventory($detail,$sale->id);
            }
            $sale->save();
            DB::commit();
            return array(1,"exito",$sale->id);
        }catch(\Exception $e){
            DB::rollback();
            return array(-1,"error",$e->getMessage());
        }
        return $sale;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $customers = Customer::all();
        return view('sales.detail.show',compact('sale','customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('sales.edit',compact('sale'));
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
        //
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

    public function previews($id)
    {
        $retorno=Sale::obtenerprevias($id);
        return $retorno;
    }

    public function pdf($id)
    {
        $sale=Sale::find($id);
        //dd($cotizacion->repuestodetalle);
        $pdf = \PDF::loadView('sales.prueba',compact('sale'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('venta.pdf');
    }

    public function day(Request $request){
        if($request->has('fecha') && $request->filled('fecha')){
            $fecha = invertir_fecha($request->fecha);
            $sales = Sale::where('created_at','<=', $fecha.' 23:59:59')->where('created_at','>=',$fecha.' 00:00:00')->where('state',1)->get();
            return view('sales.day',compact('sales'));
        }else{
            $sales = Sale::where('created_at','<=',date('Y-m-d 23:59:59'))->where('created_at','>=',date('Y-m-d 00:00:00'))->where('state',1)->get();
            return view('sales.day',compact('sales'));
        }
    }

    public function dayly(Request $request)
    {
        $sales=Sale::get();
        //dd($cotizacion->repuestodetalle);
        $pdf = \PDF::loadView('sales.reporte_diario',compact('sales'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('ventas.pdf');
    }

    private function update_inventory($detail,$sale_id){
        $product = Product::find($detail->product_id);
        $cuantos = $detail->amount;
        //dd($cuantos);
        $t=[];
        for($i=0;$i<$cuantos;$i++){
            $t++;
            $product_detail = ProductDetail::where('product_id',$product->id)->where('state',1)->orderBy('id','asc')->first();
            $product_detail->product_id = $product->id;
            $product_detail->table = 'Product';
            $product_detail->sale_id = $sale_id;
            $product_detail->type =0;
            $product_detail->state =0;
            $product_detail->save();
        }
    }
}
