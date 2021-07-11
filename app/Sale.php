<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $dates = ['sale_date'];

    public function detail()
    {
        return $this->hasMany('App\SaleDetail');
    }

    public function receipt()
    {
    	return $this->belongsTo('App\Receipt');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public static function correlativo($tipo_documento)
    {
        if($tipo_documento==1){
            $numero=Sale::where('receipt_id',$tipo_documento)->count();
            return $numero+1;  
        }
        if($tipo_documento==2){
            $numero=Sale::where('receipt_id',$tipo_documento)->count();
            return $numero+1;  
        }
        if($tipo_documento==3){
            $numero=Sale::where('receipt_id',$tipo_documento)->count();
            return $numero+1;
        }
    }

    public static function obtenerprevias($id)
    {
        $sale=Sale::find($id);
        $details=SaleDetail::where('sale_id',$id)->get();
        $total=0.0;
        $html='';
        $tfoot="";
        foreach ($details as $i=> $r) {
            $html.='<tr>
                
                <td>'.$r->product->code.'</td>
                <td>'.$r->product->name.'</td>
                <td>'.number_format($r->price,2).'</td>
                <td>'.$r->amount.'</td>
                <td>'.number_format($r->price*$r->amount,2).'</td>
                <td>
                    <button title="Editar repuesto" type="button" data-id="'.$r->id.'" class="btn btn-warning btn-sm editar_repuesto"><i class="fas fa-edit"></i></button>
                    <button title="Eliminar repuesto" type="button" data-id="'.$r->id.'" class="btn btn-danger btn-sm eliminar_repuesto"><i class="fas fa-trash"></i></button>
                </td>
            </tr>';
            $total=$total+($r->amount*$r->price);
        }
        if($sale):
        $tfoot.='
            <tr>
                <th  colspan="4">NETO</th>
                <th class="trr">$'.number_format($sale->subtotal,2).'</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="4">IVA</th>
                <th class="thiva">$'.number_format($sale->iva,2).'</th>
                <th></th>
            </tr>
            <tr>
                <th  colspan="4">SUBTOTAL</th>
                <th class="thst">$'.number_format($sale->subtotal+$sale->iva,2).'</th>
                <th></th>
            </tr>
             <tr>
                <th  colspan="4">1% RET</th>
                <th class="thivar">$'.number_format($sale->ivar,2).'</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="4">TOTAL</th>
                <th class="thtotal">$'.number_format($sale->total,2).'</th>
                <th></th>
            </tr>
            ';
        endif;

        return array(1,"exito",$html,$tfoot,$total);
    }
}
