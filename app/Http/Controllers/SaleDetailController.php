<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sale;
use App\SaleDetail;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
          'customer_id' => 'required',
          'sale_date' => 'required',
        ]);
        try{
            DB::beginTransaction();
            if($request->sale_id==0):
                $sale=new Sale();
                $sale->customer_id=$request->customer_id;
                $sale->receipt_id=$request->receipt_id;
                $sale->sale_date=invertir_fecha($request->sale_date);
                $sale->iva=0;
                $sale->ivar=0;
                $sale->subtotal=0;
                $sale->total=0;
                $sale->state = 0;
                $sale->correlative=Sale::correlativo($request->receipt_id);
                $sale->save();

                //$rrr=Repuesto::find($request->repuesto_id);

                $detail= new SaleDetail();
                $detail->product_id=$request->product_id;
                //'nombre'=>$rrr->nombre,
                $detail->price=$request->precio;
                $detail->amount=$request->cantidad;
                $detail->sale_id=$sale->id;
                $detail->save();

                if($sale->receipt_id==3){
                    $sub=$sale->subtotal;
                    $toti=$sale->total;
                    $nuevosubto=$sub+($request->precio*$request->cantidad);
                    $nuevoiva=$nuevosubto*\App\Percentage::retornar_porcentaje('iva');
                    $nuevotot=$nuevoiva+$nuevosubto;
                    $sale->subtotal=$nuevosubto;
                    $sale->iva=$nuevoiva;
                    $sale->total=$nuevotot;
                    $sale->save();
                }else{
                    $sub=$sale->subtotal;
                    $toti=$sale->total;
                    $nuevosubto=$sub+($request->precio*$request->cantidad);
                    $sale->subtotal=$nuevosubto;
                    $sale->total=$nuevosubto;
                    $sale->iva=0;
                    $sale->save();
                }

            else:
                $sale=Sale::find($request->sale_id);
                $detail= new SaleDetail();
                $detail->product_id=$request->product_id;
                //'nombre'=>$rrr->nombre,
                $detail->price=$request->precio;
                $detail->amount=$request->cantidad;
                $detail->sale_id=$sale->id;
                $detail->save();
                if($sale->receipt_id==3){
                    $sub=$sale->subtotal;
                    $toti=$sale->total;
                    $nuevosubto=$sub+($request->precio*$request->cantidad);
                    $nuevoiva=$nuevosubto*\App\Percentage::retornar_porcentaje('iva');
                    $nuevotot=$nuevoiva+$nuevosubto;
                    $sale->subtotal=$nuevosubto;
                    $sale->iva=$nuevoiva;
                    $sale->total=$nuevotot;
                    $sale->save();
                }else{
                    $sub=$sale->subtotal;
                    $toti=$sale->total;
                    $nuevosubto=$sub+($request->precio*$request->cantidad);
                    $sale->subtotal=$nuevosubto;
                    $sale->total=$nuevosubto;
                    $sale->iva=0;
                    $sale->save();
                }  
            endif;
                DB::commit();
                return array(1,"exito",$sale->id);
        }catch(\Exception $e){
            DB::rollback();
            return array(-1,"error",$e->getMessage());
        }
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
        $retorno=SaleDetail::modal_edit($id);
        return $retorno;
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
        try{
            DB::beginTransaction();
            $sale=Sale::find($request->sale_id);
            $repuesto=SaleDetail::find($id);
            //quitar ala salezacion lo que tiene en el repuesto
            $totalante=$repuesto->amount*$repuesto->price;
            $saletot=$sale->subtotal;
            $sale->subtotal=$saletot-$totalante;
            $sale->save();
            //edito el repuesto
            $repuesto->price=$request->precio;
            $repuesto->amount=$request->cantidad;
            //$repuesto->nombre=$request->nombre;
            $repuesto->sale_id=$request->sale_id;
            $repuesto->save();
            if($sale->receipt_id==3){
                $tot=$request->precio*$request->cantidad;
                $subto=$sale->subtotal;
                $n=$subto+$tot;
                $iva=$n*\App\Percentage::retornar_porcentaje('iva');
                $nt=$n+$iva;
                $sale->subtotal=$n;
                $sale->iva=$iva;
                $sale->total=$nt;
                $sale->save();
                //Sale::carcular_ivar($sale->id);
            }else{
                $tot=$request->precio*$request->cantidad;
                $subto=$sale->subtotal;
                $n=$subto+$tot;
                $sale->subtotal=$n;
                $sale->total=$n;
                $sale->iva=0;
                $sale->save();
                //salezacione::quitar_ivar($sale->id);
            }

            DB::commit();
            return array(1,"exito",$sale->id);
        }catch(Exception $e){
          DB::rollback();
            return array(-1,"error",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try{
            DB::beginTransaction();
            $sale=Sale::find($request->sale_id);
            $deta=SaleDetail::find($id);
            
            if($sale->receipt_id==3){
                $tot=$deta->price*$deta->amount;
                $subto=$sale->subtotal;
                $n=$subto-$tot;
                $iva=$n*\App\Percentage::retornar_porcentaje('iva');
                $nt=$n+$iva;
                $sale->subtotal=$n;
                $sale->iva=$iva;
                $sale->total=$nt;
                $sale->save();
                $deta->delete();
                //Sale::carcular_ivar($sale->id);
            }else{
                $tot=$deta->price*$deta->amount;
                $subto=$sale->subtotal;
                $n=$subto-$tot;
                $sale->subtotal=$n;
                $sale->total=$n;
                $sale->iva=0;
                $sale->save();
                $deta->delete();
                //Sale::quitar_ivar($sale->id);
            }

            DB::commit();
            if(count($sale->detail) == 0){
                $sale->delete();
                return array(1,"exito",0);
            }else{
                return array(1,"exito",$sale->id);
            }
        }catch(Exception $e){
          DB::rollback();
            return array(-1,"error",$e->getMessage());
        }
    }
}
