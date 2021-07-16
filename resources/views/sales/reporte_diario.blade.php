<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de compras diaria</title>
</head>
<style>
	.encabezado{
border-radius: 15px;
border : 0.1px solid #000000;
font-family : Arial, Verdana, Helvetica, sans-serif;
font-size : 15px;
padding-left : 5px;
padding-right : 5px;
}

.titulo{
	font-family : Arial, Verdana, Helvetica, sans-serif;
}

.tablita{
border-radius: 15px;
border : 0.1px solid #000000;
font-family : Arial, Verdana, Helvetica, sans-serif;
font-size : 12px;
padding-left : 5px;
padding-right : 5px;
}

.tablita2{
font-family : Arial, Verdana, Helvetica, sans-serif;
font-size : 12px;
padding-left : 5px;
padding-right : 5px;
}
.page-break {
    page-break-after: always;
}
.fecha{
	font-family : Arial, Verdana, Helvetica, sans-serif;
	font-size : 10px;
	font-weight: bold;
}
</style>
<body>
<script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $pdf->text(502, 10, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
        ');
    }

</script>
	<div style="text-align: right;" class="fecha">FECHA Y HORA DE IMPRESIÓN: {{date("d/m/Y H:i:s")}}</div>
	<div>
		@if(datos_negocio()->logo != '')
		<img  width="150" height="150" src="{{ public_path("storage/".datos_negocio()->logo) }}" alt="">
		@endif
	</div>

	<div style="text-align:center; font-size: 20px; font-weight: bold;" class="titulo">{{datos_negocio()->shop_name}}</div>
	<div style="text-align:center;" class="titulo">REPORTE DE VENTAS DEL DÍA</div><br>

	<br><br>
	<?php $eltotal=0.0; ?>
	@foreach($sales as $c)
	<?php $eltotal=$eltotal+$c->subtotal; ?>
	<table class="tablita" width="40%">
		<tr>
			<td>COMPROBANTE N°: {{$c->correlative}}</td>
		</tr>
		<tr>
			<td>FECHA: {{$c->created_at->format("d/m/Y")}}</td>
		</tr>
		<tr>
			<td>Cliente: {{$c->customer->name}}</td>
		</tr>
		<tr>
			<td>Teléfono: {{$c->customer->phone}}</td>
		</tr>
		<tr>
			<td>Correo electrónico: {{$c->customer->email}}</td>
		</tr>
	</table>
	<table class="tablita" width="100%" style="background: #F0E9EA">
		<tr>
			<td width="10%" >#</td>
			<td width="45%" >PRODUCTO</td>
			<td width="15%"  style="text-align: center;">CANTIDAD</td>
			<td width="15%" style="text-align: right;" >P. UNITARIO</td>
			<td width="15%" style="text-align: right;" >TOTAL </td>
		</tr>
	</table>
	</table>
	<?php $correlativo=0; ?>
		@foreach($c->detail as $i=> $t)
		<?php $correlativo++; ?>
			<table class="tablita2" width="100%" rules="">
				<tr>
					<td width="10%" rowspan="1">{{$correlativo}}</td>
					<td width="45%" style="text-align: left;">{{$t->product->name}}</td>
					<td width="15%" style="text-align: center;">{{ $t->amount }}</td>
					<td width="15%" style="text-align: right;">${{number_format($t->price,2)}}</td>
					<td width="15%" style="text-align: right;">${{number_format($t->price*$t->amount,2)}}</td>
				</tr>
			</table>
		@endforeach
		<table class="tablita" width="100%" rules="">
			<tr>
				<td  style="text-align: right;" >TOTAL: ${{number_format($c->subtotal,2)}}</td>
			</tr>
		</table>
	<br><br>
	@endforeach
	<br>
	<table class="tablita" width="100%" rules="">
		<tr>
			<td  style="text-align: right; font-size: 15px; font-weight: bold;" >TOTAL GENERAL: ${{number_format($eltotal,2)}}</td>
		</tr>
	</table>
</body>
</html>

