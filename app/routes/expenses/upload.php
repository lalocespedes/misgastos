<?php

use lalocespedes\CfdiMx\Parser;

$valid_xml = function($file) use($app) {

	    libxml_use_internal_errors(TRUE);
		$dom = new DOMDocument('1.0', 'utf-8');
		$dom->load($file);
		$errors = libxml_get_errors();

		if($errors){

			$app->flash('Danger', 'Xml no valido');
			$app->redirect($app->urlFor('expenses-upload'));
		}

		return true;

};

$app->get('/expenses/upload', $authenticated(), function() use($app) {

	$categories = $app->category->get();

	$app->render('expenses/upload.twig', [
		'title'			=> 'Subir XML',
		'categories'	=> $categories
	]);

})->name('expenses-upload');

$app->post('/expenses/upload', $authenticated(), function() use($app, $valid_xml) {

	$request = $app->request;

	$storage = new \Upload\Storage\FileSystem('/home/sat/xml/'); //Lugar a donde se moverán los archivos
 
	$file = new \Upload\File('file',$storage); //proporcionas el nombre del campo

	$file->addValidations(array(
	        new \Upload\Validation\Extension(array('jpg','png','gif','jpeg', 'xml')), //validas que sea una extensión valida
	        new \Upload\Validation\Mimetype(array('image/jpeg','image/png','image/gif', 'text/xml', 'application/xml', 'application/octet-stream')), //validas el tipo de imagen
	        new \Upload\Validation\Size('5M'), //validas que no exceda el tamaño
	));

	if($valid_xml($file)){

		$parse = new Parser($file);

		$parse = $parse->jsonSerialize();  //parsear el xml

		$uuid = $parse["Comprobante"]["Complemento"]["TimbreFiscalDigital"]["@atributos"]['UUID'];

		//validar q no este previamente ya capturado

		if (count($app->expense->where('expense_uuid', $uuid)->get())) {
			

			$app->flash('Danger', 'xml ya almacenado');
			$app->redirect($app->urlFor('expenses'));
			$app->stop();
		};

		//validar si se tiene el impuesto capturado antes de avanzar

		$taxid_receptor = $parse["Comprobante"]['Receptor']['@atributos']['rfc'];
		//validar si el xml es para el rfc de la company
		$company_tax_id = $app->company->tax_id();

		if($company_tax_id != $taxid_receptor) {

			$app->flash('Danger', 'RFC incorrecto');
			$app->redirect($app->urlFor('expenses'));
			$app->stop();

		}

		//obtener taxid para ver si el proveedor existe o agregarlo

		$taxid_supplier = $parse["Comprobante"]['Emisor']['@atributos']['rfc'];

		$supplier = $app->supplier->where('supplier_tax_id', $taxid_supplier)->first();

		if(!$supplier) {

			$supplier = $app->supplier->create([

				'supplier_name'		=> $parse["Comprobante"]['Emisor']['@atributos']['nombre'],
				'supplier_tax_id'	=> $parse["Comprobante"]['Emisor']['@atributos']['rfc'],
				'supplier_active'	=> 1

			]);

		}

		//guardar en la base de datos

		$expense = $app->expense->create([

		'category_id' 				=> $request->post('category'),
		'supplier_id'				=> $supplier->id,
		'expense_date_entered'		=> $parse["Comprobante"]["@atributos"]['fecha'],
		'expense_amount'			=> $parse["Comprobante"]["@atributos"]['total'],
		'expense_subtotal'			=> $parse["Comprobante"]["@atributos"]['subtotal'],
		'expense_descuento'			=> $parse["Comprobante"]["@atributos"]['descuento'],
		'expense_folio'				=> $parse["Comprobante"]["@atributos"]['folio'],
		'expense_serie'				=> $parse["Comprobante"]["@atributos"]['serie'],
		'expense_moneda'			=> $parse["Comprobante"]["@atributos"]['moneda'],
		'expense_TipoCambio'		=> $parse["Comprobante"]["@atributos"]['TipoCambio'],
		'expense_condicionesDePago'	=> $parse["Comprobante"]["@atributos"]['condicionesDePago'],
		'expense_noCertificado'		=> $parse["Comprobante"]["@atributos"]['noCertificado'],
		'expense_certificado'		=> $parse["Comprobante"]["@atributos"]['certificado'],
		'expense_formaDePago'		=> $parse["Comprobante"]["@atributos"]['formaDePago'],
		'expense_metodoDePago'		=> $parse["Comprobante"]["@atributos"]['metodoDePago'],
		'expense_NumCtaPago'		=> $parse["Comprobante"]["@atributos"]['NumCtaPago'],
		'expense_LugarExpedicion'	=> $parse["Comprobante"]["@atributos"]['LugarExpedicion'],
		'expense_sello'				=> $parse["Comprobante"]["@atributos"]['sello'],
		'expense_uuid'				=> $parse["Comprobante"]["Complemento"]["TimbreFiscalDigital"]["@atributos"]['UUID'],
		'user_id'					=> $app->auth->id

		]);

		//guardar items
			
		$items = $parse["Comprobante"]["Conceptos"]['Concepto']['@atributos'];

		foreach ($items as $key => $item) {
			
			$expense_items = $app->expense_items->create([

				'expense_id'		=> $expense->id,
				'item_name'			=> $item['noIdentificacion'],
				'item_description'	=> $item['descripcion'],
				'item_qty'			=> $item['cantidad'],
				'item_price'		=> $item['importe'],
				'item_unidad'		=> $item['unidad']

			]);

		}

		//save taxes
		
		if (isset($parse['Comprobante']['Impuestos']['Traslados']['Traslado']['@atributos'])) {
		    
			//save traslados
			foreach ($parse['Comprobante']['Impuestos']['Traslados']['Traslado']['@atributos'] as $key => $traslado) {
				
				$tax_rate_id = $app->tax_rates->where('tax_type', 'T')->where('tax_rate_name', $traslado['impuesto'])->first()->id;

				$expense_taxes = $app->expense_taxes->create([

					'expense_id'	=> $expense->id,
					'tax_rate_id'	=> $tax_rate_id,
					'tax_amount' 	=> $traslado['importe']	
				]);
			}

		}

		if (isset($parse['Comprobante']['Impuestos']['Retenciones']['Retencion']['@atributos'])) {
		    				
		    //save retenciones
			foreach ($parse['Comprobante']['Impuestos']['Retenciones']['Retencion']['@atributos'] as $key => $retencion) {
				
				$tax_rate_id = $app->tax_rates->where('tax_type', 'R')->where('tax_rate_name', $retencion['impuesto'])->first()->id;

				$expense_taxes = $app->expense_taxes->create([

					'expense_id'	=> $expense->id,
					'tax_rate_id'	=> $tax_rate_id,
					'tax_amount' 	=> $retencion['importe']
				]);
			}
		}

		//impuestos locales

		if (isset($parse['Comprobante']['Complemento']['ImpuestosLocales'])) {
			
			$traslado_local = $parse['Comprobante']['Complemento']['ImpuestosLocales']['TrasladosLocales']['@atributos']['ImpLocTrasladado'];
			$traslado_local_importe = $parse['Comprobante']['Complemento']['ImpuestosLocales']['TrasladosLocales']['@atributos']['Importe'];
					
			$tax_rate_id = $app->tax_rates->where('tax_type', 'TL')->where('tax_rate_name', $traslado_local)->first()->id;

			$expense_taxes = $app->expense_taxes->create([

				'expense_id'	=> $expense->id,
				'tax_rate_id'	=> $tax_rate_id,
				'tax_amount' 	=> $traslado_local_importe
		]);

		}




	} // database store end 
	
	try{

		$file->setName($uuid);

		$file->upload(); // mover el archivo

		$app->flash('Success', 'Xml Guardado');
		$app->redirect($app->urlFor('expenses-edit', array('id' => $expense->id)));
 
	}catch (\Exception $e){
	   	
	   	//$app->errors = $file->getErrors();

	    $errors = $file->getErrors();

	    $categories = $app->category->get();

	    $app->render('expenses/upload.twig', [
	    	'categories'	=> $categories,
	    	'errors'		=> $errors
	    ]);
	}

})->name('expenses-upload-post');
