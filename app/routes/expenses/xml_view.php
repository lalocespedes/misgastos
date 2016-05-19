<?php

use lalocespedes\CfdiMx\Parser;

$xml_view = function($file) use($app) {

		$parse = new Parser($file);

		$data = $parse->jsonSerialize();

		$documento = $data['Comprobante']['@atributos'];
		$emisor = $data['Comprobante']['Emisor']['@atributos'];
		$emisor_domicilio = $data['Comprobante']['Emisor']['DomicilioFiscal']['@atributos'];
		$regimenfiscal = $data['Comprobante']['Emisor']['RegimenFiscal']['@atributos']['Regimen'];
		$receptor = $data['Comprobante']['Receptor']['@atributos'];
		$receptor_domicilio = $data['Comprobante']['Receptor']['DomicilioFiscal']['@atributos'];

		$uuid = $data['Comprobante']['Complemento']['TimbreFiscalDigital']['@atributos']['UUID'];
		$importe_letra = $data['Comprobante']['importe_letra'];
		$codigobarra = $data['Comprobante']['codigobarra'];
		$cadenaOriginalTFD = $data['Comprobante']['cadenaOriginalTFD'];
		$conceptos = $data['Comprobante']['Conceptos']['Concepto']['@atributos'];

		$impuestos = [];

		if (isset($data['Comprobante']['Impuestos']['Traslados'])) {
			
			$impuestos['traslado'] = $data['Comprobante']['Impuestos']['Traslados']['Traslado']['@atributos'];

		}

		if (isset($data['Comprobante']['Impuestos']['Retenciones'])) {
			
			$impuestos['retencion'] = $data['Comprobante']['Impuestos']['Retenciones']['Retencion']['@atributos'];

		}


		$selloCFD = $data['Comprobante']['Complemento']['TimbreFiscalDigital']['@atributos']['selloCFD'];
		$selloSAT = $data['Comprobante']['Complemento']['TimbreFiscalDigital']['@atributos']['selloSAT'];
		$noCertificadoSAT = $data['Comprobante']['Complemento']['TimbreFiscalDigital']['@atributos']['noCertificadoSAT'];
		$FechaTimbrado = $data['Comprobante']['Complemento']['TimbreFiscalDigital']['@atributos']['FechaTimbrado'];

		$qr = new Endroid\QrCode\QrCode();

        $qr->setText($codigobarra);
        $qr->setSize(140);
        $qr->setPadding(5);
        $qr = base64_encode($qr->get());

		return $app->view()->fetch('expenses/templates/default.twig', [
			'documento' 			=> $documento,
			'emisor'				=> $emisor,
			'emisor_domicilio'		=> $emisor_domicilio,
			'regimenfiscal'			=> $regimenfiscal,
			'receptor'				=> $receptor,
			'receptor_domicilio'	=> $receptor_domicilio,
			'uuid'					=> $uuid,
			'importe_letra'			=> $importe_letra,
			'cadenaOriginalTFD'		=> $cadenaOriginalTFD,
			'conceptos'				=> $conceptos,
			'selloCFD'				=> $selloCFD,
			'selloSAT'				=> $selloSAT,
			'noCertificadoSAT'		=> $noCertificadoSAT,
			'FechaTimbrado'			=> $FechaTimbrado,
			'qr'					=> $qr,
			'impuestos'				=> $impuestos
		]);

};