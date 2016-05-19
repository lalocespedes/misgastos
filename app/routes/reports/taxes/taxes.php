<?php

$app->get('/reports/month-tax', function() use($app) {

	$app->render('reports/month-tax.twig', [
		'title'	=> 'Reporte Impuestos'
	]);

})->name('tax-report');

$app->post('/reports/tax-report', function() use($app) {

	$request = $app->request();

	$fromDate = $request->post('fromDate'); 
	$toDate = $request->post('toDate'); 

	$v = $app->validation;

	$v->validate([
		'fromDate'		=> [$fromDate, 'required|date'],
		'toDate'		=> [$toDate, 'required|date']
	]);

	if ($v->passes()) {

			$taxes = $app->expense_taxes->selectRaw('*, sum(tax_amount) as sum')
						 ->groupBy('tax_rate_id')
						 ->with('tax_rates')
						 ->whereHas('expense', function($q) use($fromDate, $toDate)
							{
			    				$q->where('expense_date_entered', '>=', $fromDate.' 00:00:00')
			      				  ->where('expense_date_entered', '<=', $toDate.' 23:59:59');

							})
						 ->get()
						 ->toArray();

			//dd($taxes);

			if ((count($taxes))) {
				
				$app->render('reports/taxes/html.twig', [
					'taxes'	=> $taxes,
					'request'	=> $request
				]);

			} else {

				$app->flash('Danger', 'No hay resultados');
				$app->response->redirect($app->urlFor('month-tax'));

			}


	} else {

		$app->render('reports/month-tax.twig', [
			'errors' => $v->errors()
		]);
	}

})->name('tax-report-post');