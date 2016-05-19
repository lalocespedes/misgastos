<?php

require 'xml_view.php';

$app->get('/expenses/view-xml/(:uuid)', function($uuid) use($app) {

	$file = INC_ROOT .'/public/uploads/'.$uuid.'.xml';
	
	if ($file === FALSE) {
		$app->response->redirect($app->urlFor('expenses'));
	}

	$xml = new SimpleXMLElement(file_get_contents($file));

	$app->response->headers->set('Content-Type', 'text/xml');
	print($xml->asXML());

})->name('expenses-view-xml');

$app->get('/expenses/download-xml/(:uuid)', function($uuid) use($app) {

	$file = INC_ROOT .'/public/uploads/'.$uuid.'.xml';
	
	if ($file === FALSE) {
		$app->response->redirect($app->urlFor('expenses'));
	}

	$data = file_get_contents($file);

	$app->download->force($file, $data);


})->name('expenses-download-xml');

$app->get('/expenses/view/pdf/:uuid', function ($uuid) use ($app, $xml_view) {
   		
		$file = INC_ROOT . '/public/uploads/'.$uuid.'.xml';

		$html = $xml_view($file);

   		$mpdf = new mPDF;
        $mpdf->WriteHTML($html);
        $mpdf->Output();

        exit();

})->name('expenses-view-pdf');

$app->get('/expenses/download/pdf/:uuid', function ($uuid) use ($app, $xml_view) {
   		
		$file = INC_ROOT . '/public/uploads/'.$uuid.'.xml';

		$html = $xml_view($file);

   		$mpdf = new mPDF;
        $mpdf->WriteHTML($html);
        $mpdf->Output($uuid.'.pdf', 'D');

})->name('expenses-download-pdf');
