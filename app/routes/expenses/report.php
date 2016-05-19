<?php

$app->get('/expenses/report', $authenticated(), function() use($app) {

	$app->render('expenses/reports/report.twig');

})->name('expenses-report');

$app->post('/expenses/report', $authenticated(), function() use($app) {

	$request = $app->request();

	$fromDate = $request->post('fromDate');
	$toDate = $request->post('toDate');

	$v = $app->validation;

	$v->validate([
		'fromDate'		=> [$fromDate, 'required|date'],
		'toDate'		=> [$toDate, 'required|date']
	]);

	if ($v->passes()) {
		
			$expenses = $app->expense->with('category', 'user')
							 ->where('expense_date_entered', '>=', $fromDate.'00:00:01')
            				 ->where('expense_date_entered', '<=', $toDate.'23:59:59')
							 ->where('user_id', $app->auth->id)
							 ->get();

			if ((count($expenses))) {
				
				$app->render('expenses/reports/html.twig', [
					'expenses'	=> $expenses,
					'request'	=> $request
				]);

			} else {

				$app->flash('Danger', 'No hay resultados');
				$app->response->redirect($app->urlFor('expenses-report'));

			}


	} else {

		$app->render('expenses/reports/report.twig', [
			'errors' => $v->errors()
		]);
	}

})->name('expenses-report-post');