<?php
use App\Configuration;
function datos_negocio()
{
	$shop = Configuration::first();
	return $shop;
}

function invertir_fecha($fecha)
{
	$inicio = $fecha; //dd-mm-yyyy
	if($inicio==null){
		return "";
	}else{
		$invert = explode("-",$inicio);
        $nueva = $invert[2]."-".$invert[1]."-".$invert[0];
        return $nueva;
  }
}
?>