<?php

use lalocespedes\CfdiMx\Parser;

$app->get('/expenses/xml', function() use($app) {

	$xml = INC_ROOT . '/AOM920820BEA_FAC_FAa723f86b-f3da-40b8-8c90-5439c10de809_20150331.xml';

	$parse = new Parser($xml);

	$result = $parse->jsonSerialize();

	$uuid = $result["Comprobante"]["Complemento"]["TimbreFiscalDigital"]["@atributos"]['UUID'];

	echo $result["Comprobante"]["@atributos"]['fecha'];

	echo $result["Comprobante"]["@atributos"]['total'];

});
