<?php
use App\Configuration;
function datos_negocio()
{
	$shop = Configuration::first();
	return $shop;
}
?>